<?php

declare(strict_types=1);

namespace wapplersystems\References\Controller;


use TYPO3\CMS\Core\Pagination\SimplePagination;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;
use wapplersystems\References\Domain\Repository\ReferenceRepository;

/**
 * This file is part of the "Referenzen" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2024 WapplerSystems
 */

/**
 * ReferenceController
 */
class ReferenceController extends ActionController
{

    public function __construct(readonly ReferenceRepository $referenceRepository)
    {
    }


    /**
     * action list
     *
     * @param array<int, int|string> $categories One selected category uid per filter group, keyed by group uid
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAction(?array $categories = null, ?int $country = null, int $currentPage = 1): \Psr\Http\Message\ResponseInterface
    {
        $categories = $categories ?? [];

        $references = $this->referenceRepository->findByFilters($categories, $country);
        $paginator = new QueryResultPaginator($references, $currentPage, 10);
        $pagination = new SimplePagination($paginator);

        $categoryGroups = $this->referenceRepository->findCategoryGroups();
        $countryFilterOptions = $this->referenceRepository->findUsedCountries();

        $activeFilters = [];
        foreach ($categoryGroups as &$group) {
            $selectedUid = isset($categories[$group['uid']]) ? (int)$categories[$group['uid']] : null;
            $group['selectedUid'] = $selectedUid;
            $group['selectedLabel'] = $this->findOptionLabel($group['options'], $selectedUid, 'title');

            if ($selectedUid) {
                $remainingCategories = $categories;
                unset($remainingCategories[$group['uid']]);
                $activeFilters[] = [
                    'label' => $group['title'],
                    'valueLabel' => $group['selectedLabel'],
                    'removeArguments' => ['categories' => $remainingCategories, 'country' => $country],
                ];
            }
        }
        unset($group);

        $this->view->assignMultiple([
            'paginator' => $paginator,
            'pagination' => $pagination,
            'categoryGroups' => $categoryGroups,
            'countryFilterOptions' => $countryFilterOptions,
            'selectedCategories' => $categories,
            'selectedCountry' => $country,
            'selectedCountryLabel' => $this->findOptionLabel($countryFilterOptions, $country, 'cn_short_en'),
            'activeFilters' => $activeFilters,
        ]);

        return $this->htmlResponse();
    }

    /**
     * Looks up the human-readable label for a selected filter's uid within
     * its option list, so the active filter can be shown as a chip.
     */
    private function findOptionLabel(array $options, ?int $uid, string $labelField): ?string
    {
        if ($uid === null) {
            return null;
        }

        foreach ($options as $option) {
            if ((int)$option['uid'] === $uid) {
                return $option[$labelField];
            }
        }

        return null;
    }

    /**
     * action logoSlider
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function logoSliderAction(): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assignMultiple([
            'references' => $this->referenceRepository->findWithLogo(),
            'listPageId' => $this->settings['listPageId'] ?? null,
        ]);

        return $this->htmlResponse();
    }
}

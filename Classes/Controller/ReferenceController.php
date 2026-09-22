<?php

declare(strict_types=1);

namespace wapplersystems\References\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Pagination\SimplePagination;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;
use wapplersystems\References\Domain\Repository\ReferenceRepository;

class ReferenceController extends ActionController
{

    public function __construct(readonly ReferenceRepository $referenceRepository)
    {
    }

    /**
     * @param array<int, int|string> $categories One selected category uid per filter group, keyed by group uid
     */
    public function listAction(?array $categories = null, ?int $country = null, int $currentPage = 1): ResponseInterface
    {
        $categories = $categories ?? [];

        $presetCategories = $this->intList($this->settings['presetCategories'] ?? '');
        $showFilter = (bool)($this->settings['showFilter'] ?? true);
        $itemsPerPage = ((int)($this->settings['itemsPerPage'] ?? 0)) ?: 10;

        // Ohne Filterleiste darf auch kein Argument aus der URL durchschlagen.
        if (!$showFilter) {
            $categories = [];
            $country = null;
        }

        $references = $this->referenceRepository->findByFilters($categories, $country, $presetCategories);
        $paginator = new QueryResultPaginator($references, $currentPage, $itemsPerPage);
        $pagination = new SimplePagination($paginator);

        $categoryGroups = $showFilter ? $this->referenceRepository->findCategoryGroups() : [];
        $countryFilterOptions = $showFilter ? $this->referenceRepository->findUsedCountries() : [];

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
            'showFilter' => $showFilter,
        ]);

        return $this->htmlResponse();
    }

    /**
     * Turns a comma separated FlexForm value into a list of uids.
     *
     * @return int[]
     */
    private function intList(string $value): array
    {
        return array_values(array_filter(array_map('intval', GeneralUtility::trimExplode(',', $value, true))));
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

    public function logoSliderAction(): ResponseInterface
    {
        $this->view->assignMultiple([
            'references' => $this->referenceRepository->findWithLogo(),
            'listPageId' => $this->settings['listPageId'] ?? null,
        ]);

        return $this->htmlResponse();
    }
}

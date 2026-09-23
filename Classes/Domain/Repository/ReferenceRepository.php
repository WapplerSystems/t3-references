<?php

declare(strict_types=1);

namespace wapplersystems\References\Domain\Repository;

use Doctrine\DBAL\ParameterType;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

class ReferenceRepository extends Repository
{

    /**
     * @param int[] $categoryUids One selected category uid per filter group (0/empty entries are ignored)
     * @param int[] $presetCategoryUids Categories fixed in the plugin; they narrow the list before the visitor filters
     */
    public function findByFilters(array $categoryUids, ?int $country, array $presetCategoryUids = []): QueryResultInterface
    {
        $query = $this->createQuery();
        $constraints = [];

        // Die festen Kategorien stecken den Rahmen ab, in dem der Besucher dann
        // filtert. Untereinander wirken sie als ODER - "Institute und Schulen"
        // soll die Liste weiten, nicht leeren.
        $preset = [];
        foreach ($presetCategoryUids as $categoryUid) {
            if ($categoryUid) {
                $preset[] = $query->contains('categories', (int)$categoryUid);
            }
        }
        if ($preset !== []) {
            $constraints[] = count($preset) === 1 ? $preset[0] : $query->logicalOr(...$preset);
        }

        foreach ($categoryUids as $categoryUid) {
            if ($categoryUid) {
                $constraints[] = $query->contains('categories', (int)$categoryUid);
            }
        }
        if ($country && ExtensionManagementUtility::isLoaded('static_info_tables')) {
            $constraints[] = $query->equals('country', $country);
        }

        if ($constraints !== []) {
            $query->matching($query->logicalAnd(...$constraints));
        }

        $this->sortieren($query);

        return $query->execute();
    }

    /**
     * References that have a logo set, for the logo slider plugin.
     */
    public function findWithLogo(): QueryResultInterface
    {
        $query = $this->createQuery();
        $query->matching($query->logicalNot($query->equals('logo', null)));

        return $query->execute();
    }

    /**
     * Category groups (top-level categories below the "categories" field's tree root) together with
     * the child categories that are actually assigned to at least one reference, for building the
     * filter dropdowns dynamically — one per group, without any group/category being hardcoded.
     *
     * @return array<int, array{uid: int, title: string, options: array<int, array{uid: int, title: string}>}>
     */
    public function findCategoryGroups(): array
    {
        $startingPoints = (string)($GLOBALS['TCA']['tx_references_domain_model_reference']['columns']['categories']['config']['treeConfig']['startingPoints'] ?? '0');
        $rootUid = (int)explode(',', $startingPoints)[0];

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_category');

        $queryBuilder->getRestrictions()->removeAll()->add(GeneralUtility::makeInstance(DeletedRestriction::class));

        $rows = $queryBuilder
            ->select('grp.uid AS group_uid', 'grp.title AS group_title', 'child.uid AS uid', 'child.title AS title')
            ->from('sys_category', 'grp')
            ->join('grp', 'sys_category', 'child', $queryBuilder->expr()->eq('child.parent', $queryBuilder->quoteIdentifier('grp.uid')))
            ->join(
                'child',
                'sys_category_record_mm',
                'mm',
                $queryBuilder->expr()->eq('mm.uid_local', $queryBuilder->quoteIdentifier('child.uid'))
            )
            ->where(
                $queryBuilder->expr()->eq('grp.parent', $queryBuilder->createNamedParameter($rootUid, ParameterType::INTEGER)),
                $queryBuilder->expr()->eq('mm.tablenames', $queryBuilder->createNamedParameter('tx_references_domain_model_reference')),
                $queryBuilder->expr()->eq('mm.fieldname', $queryBuilder->createNamedParameter('categories'))
            )
            ->groupBy('grp.uid', 'grp.title', 'grp.sorting', 'child.uid', 'child.title')
            ->orderBy('grp.sorting')
            ->addOrderBy('child.title')
            ->executeQuery()
            ->fetchAllAssociative();

        $groups = [];
        foreach ($rows as $row) {
            $groupUid = (int)$row['group_uid'];
            if (!isset($groups[$groupUid])) {
                $groups[$groupUid] = [
                    'uid' => $groupUid,
                    'title' => $row['group_title'],
                    'options' => [],
                ];
            }
            $groups[$groupUid]['options'][] = [
                'uid' => (int)$row['uid'],
                'title' => $row['title'],
            ];
        }

        return array_values($groups);
    }

    /**
     * Countries actually assigned to a reference, for populating the country filter dropdown.
     * Returns an empty list if static_info_tables (which provides the static_countries table
     * the country field relies on) is not installed.
     */
    public function findUsedCountries(): array
    {
        if (!ExtensionManagementUtility::isLoaded('static_info_tables')) {
            return [];
        }

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_references_domain_model_reference');
        $queryBuilder->getRestrictions()->removeAll()->add(GeneralUtility::makeInstance(DeletedRestriction::class));

        return $queryBuilder
            ->select('sc.uid', 'sc.cn_short_en')
            ->distinct()
            ->from('tx_references_domain_model_reference', 'r')
            ->join('r', 'static_countries', 'sc', $queryBuilder->expr()->eq('sc.uid', $queryBuilder->quoteIdentifier('r.country')))
            ->where($queryBuilder->expr()->gt('r.country', $queryBuilder->createNamedParameter(0, ParameterType::INTEGER)))
            ->orderBy('sc.cn_short_en')
            ->executeQuery()
            ->fetchAllAssociative();
    }

    /**
     * Ohne setOrderings hat die Abfrage kein ORDER BY - dann entscheidet die
     * Datenbank, und die Reihenfolge kann sich zwischen zwei Aufrufen aendern.
     * Deshalb wird sie hier ausdruecklich festgelegt:
     *
     *   priority absteigend - was hervorgehoben werden soll, steht vorn
     *   name aufsteigend    - alles Uebrige alphabetisch, also vorhersehbar
     */
    protected function sortieren(QueryInterface $query): void
    {
        $query->setOrderings([
            'priority' => QueryInterface::ORDER_DESCENDING,
            'name' => QueryInterface::ORDER_ASCENDING,
        ]);
    }
}

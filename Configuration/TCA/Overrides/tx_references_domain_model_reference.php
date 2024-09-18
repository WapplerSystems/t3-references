<?php

use SJBR\StaticInfoTables\Hook\Backend\Form\FormDataProvider\TcaSelectItemsProcessor;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') || die();


if (ExtensionManagementUtility::isLoaded('static_info_tables')) {

    $GLOBALS['TCA']['tx_references_domain_model_reference']['columns']['country']['config'] = [
        'type' => 'select',
        'renderType' => 'selectSingle',
        'items' => [
            ['', 0],
        ],
        'foreign_table' => 'static_countries',
        'foreign_table_where' => 'ORDER BY static_countries.cn_short_en',
        'itemsProcFunc' => TcaSelectItemsProcessor::class.'->translateCountriesSelector',
        'size' => 1,
        'minitems' => 0,
        'maxitems' => 1
    ];

}

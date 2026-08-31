<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') || die();

ExtensionUtility::registerPlugin(
    'References',
    'references_list',
    'List',
    'references-plugin-list'
);

if (!is_array($GLOBALS['TCA']['tt_content']['types']['references_list'] ?? false)) {
    $GLOBALS['TCA']['tt_content']['types']['references_list'] = [];
}

ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'label' => 'List',
        'value' => 'references_list',
        'icon' => 'references-plugin-list',
        'group' => 'references',
    ]
);

$GLOBALS['TCA']['tt_content']['types']['references_list']['showitem'] = '
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        --palette--;;general,
        --palette--;;headers,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.plugin,
        pi_flexform,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
        --palette--;;frames,
        --palette--;;appearanceLinks,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
        --palette--;;language,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
        --palette--;;hidden,
        --palette--;;access,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
        categories,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
        rowDescription,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
';

$GLOBALS['TCA']['tt_content']['types']['references_list']['columnsOverrides']['pi_flexform']['config']['ds'] =
    'FILE:EXT:references/Configuration/FlexForms/flexform_list.xml';

ExtensionUtility::registerPlugin(
    'References',
    'references_logoslider',
    'LogoSlider',
    'references-plugin-logoslider'
);

if (!is_array($GLOBALS['TCA']['tt_content']['types']['references_logoslider'] ?? false)) {
    $GLOBALS['TCA']['tt_content']['types']['references_logoslider'] = [];
}

ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'label' => 'LogoSlider',
        'value' => 'references_logoslider',
        'icon' => 'references-plugin-logoslider',
        'group' => 'references',
    ]
);

$GLOBALS['TCA']['tt_content']['types']['references_logoslider']['showitem'] = '
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        --palette--;;general,
        --palette--;;headers,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.plugin,
        pi_flexform,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
        --palette--;;frames,
        --palette--;;appearanceLinks,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
        --palette--;;language,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
        --palette--;;hidden,
        --palette--;;access,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
        categories,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
        rowDescription,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
';

$GLOBALS['TCA']['tt_content']['types']['references_logoslider']['columnsOverrides']['pi_flexform']['config']['ds'] =
    'FILE:EXT:references/Configuration/FlexForms/flexform_logoslider.xml';

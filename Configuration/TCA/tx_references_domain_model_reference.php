<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'sortby' => 'sorting',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'iconfile' => 'EXT:references/Resources/Public/Icons/tx_references_domain_model_reference.gif',
        'security' => [
            'ignorePageTypeRestriction' => true,
        ],
    ],
    'types' => [
        '1' => ['showitem' => 'name, slug, teaser, description, link, categories, country, duration, green_hosting, --div--;LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tab.media, logo, screenshot_smartphone, screenshot_tablet, screenshot_laptop, screenshot_desktop, video, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language, sys_language_uid, l10n_parent, l10n_diffsource, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, hidden, starttime, endtime'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    ['label' => '', 'value' => 0],
                ],
                'foreign_table' => 'tx_references_domain_model_reference',
                'foreign_table_where' => 'AND {#tx_references_domain_model_reference}.{#pid}=###CURRENT_PID### AND {#tx_references_domain_model_reference}.{#sys_language_uid} IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        'label' => '',
                        'invertStateDisplay' => true,
                    ],
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'searchable' => false,
            'config' => [
                'type' => 'datetime',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'searchable' => false,
            'config' => [
                'type' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038),
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'categories' => [
            'exclude' => false,
            'label' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.categories',
            'config' => [
                'type' => 'category',
                'relationship' => 'manyToMany',
                'treeConfig' => [
                    'startingPoints' => '1',
                    'appearance' => [
                        'showHeader' => true,
                        'expandAll' => true,
                    ],
                ],
            ],
        ],

        'name' => [
            'exclude' => false,
            'label' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.name',
            //'description' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.name.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'required' => true,
                'default' => ''
            ],
        ],
        'slug' => [
            'exclude' => false,
            'label' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.slug',
            'config' => [
                'type' => 'slug',
                'size' => 50,
                'generatorOptions' => [
                    'fields' => ['name'],
                    'fieldSeparator' => '-',
                    'replacements' => [
                        '/' => '',
                    ],
                ],
                'fallbackCharacter' => '-',
                'eval' => 'uniqueInPid',
            ],

        ],
        'teaser' => [
            'exclude' => false,
            'label' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.teaser',
            'config' => [
                'type' => 'text',
                'rows' => 10,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'description' => [
            'exclude' => false,
            'label' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.description',
            'config' => [
                'type' => 'text',
                'enableRichtext' => 'true',
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'link' => [
            'exclude' => false,
            'label' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.link',
            'config' => [
                'type' => 'link',
            ]
        ],
        'logo' => [
            'exclude' => false,
            'label' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.logo',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-image-types',
                'maxitems' => 1,
            ],
        ],
        'screenshot_smartphone' => [
            'exclude' => false,
            'label' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.screenshot_smartphone',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-image-types',
                'maxitems' => 1,
            ],
        ],
        'screenshot_tablet' => [
            'exclude' => false,
            'label' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.screenshot_tablet',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-image-types',
                'maxitems' => 1,
            ],
        ],
        'screenshot_laptop' => [
            'exclude' => false,
            'label' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.screenshot_laptop',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-image-types',
                'maxitems' => 1,
            ],
        ],
        'screenshot_desktop' => [
            'exclude' => false,
            'label' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.screenshot_desktop',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-image-types',
                'maxitems' => 1,
            ],
        ],
        'video' => [
            'exclude' => false,
            'label' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.video',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-image-types',
                'maxitems' => 1,
            ],
        ],
        'country' => [
            'exclude' => false,
            'label' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.country',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['label' => '', 'value' => 0],
                ],
                'default' => 0,
                'size' => 1,
            ],
        ],
        'duration' => [
            'exclude' => false,
            'label' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.duration',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'green_hosting' => [
            'exclude' => false,
            'label' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.green_hosting',
            'config' => [
                'type' => 'check',
                'items' => [
                    ['label' => ''],
                ],
                'default' => 0,
            ]
        ],

    ],
];

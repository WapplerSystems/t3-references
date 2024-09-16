<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
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
        'searchFields' => 'name,slug,teaser,description,link,duration',
        'iconfile' => 'EXT:references/Resources/Public/Icons/tx_references_domain_model_reference.gif',
        'security' => [
            'ignorePageTypeRestriction' => true,
        ],
    ],
    'types' => [
        '1' => ['showitem' => 'name, slug, teaser, description, link, logo, screenshot_smartphone, screenshot_tablet, screenshot_laptop, screenshot_desktop, video, technology, industry, target_group, country, duration, green_hosting, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language, sys_language_uid, l10n_parent, l10n_diffsource, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, hidden, starttime, endtime'],
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
                    ['', 0],
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
                        0 => '',
                        1 => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],
        'categories' => [
            'config'=> [
                'type' => 'category',
            ],
        ],

        'name' => [
            'exclude' => false,
            'label' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.name',
            'description' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.name.description',
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
            'description' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.slug.description',
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
            'description' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.teaser.description',
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
            'description' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.description.description',
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
            'description' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.link.description',
            'config' => [
                'type' => 'link',
            ]
        ],
        'logo' => [
            'exclude' => false,
            'label' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.logo',
            'description' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.logo.description',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-image-types',
                'maxitems' => 1,
            ],
        ],
        'screenshot_smartphone' => [
            'exclude' => false,
            'label' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.screenshot_smartphone',
            'description' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.screenshot_smartphone.description',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-image-types',
                'maxitems' => 1,
            ],
        ],
        'screenshot_tablet' => [
            'exclude' => false,
            'label' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.screenshot_tablet',
            'description' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.screenshot_tablet.description',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-image-types',
                'maxitems' => 1,
            ],
        ],
        'screenshot_laptop' => [
            'exclude' => false,
            'label' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.screenshot_laptop',
            'description' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.screenshot_laptop.description',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-image-types',
                'maxitems' => 1,
            ],
        ],
        'screenshot_desktop' => [
            'exclude' => false,
            'label' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.screenshot_desktop',
            'description' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.screenshot_desktop.description',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-image-types',
                'maxitems' => 1,
            ],
        ],
        'video' => [
            'exclude' => false,
            'label' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.video',
            'description' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.video.description',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-image-types',
                'maxitems' => 1,
            ],
        ],
        'technology' => [
            'exclude' => false,
            'label' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.technology',
            'description' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.technology.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'items' => [
                    ['Default', 0],
                    ['TYPO3', 'TYPO3'],
                    ['WordPress', 'WordPress'],
                    ['symfony', 'symfony'],
                ],
                'size' => 4,
                'minitems' => 0,
            ],
        ],
        'industry' => [
            'exclude' => false,
            'label' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.industry',
            'description' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.industry.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'items' => [
                    ['Default', 0],
                    ['Versicherungen', 'Versicherungen'],
                    ['Forschung', 'Forschung'],
                    ['Logistik', 'Logistik'],
                    ['Handel', 'Handel'],
                    ['Energie', 'Energie'],
                ],
                'size' => 4,
                'minitems' => 0,
            ],
        ],
        'target_group' => [
            'exclude' => false,
            'label' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.target_group',
            'description' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.target_group.description',
            'config' => [
                'type' => 'tag',
                'minitems' => 0,
            ],
        ],
        'country' => [
            'exclude' => false,
            'label' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.country',
            'description' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.country.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['Default', 0],
                    ['Deutschland', 'Deutschland'],
                ],
                'size' => 30,
            ],
        ],
        'duration' => [
            'exclude' => false,
            'label' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.duration',
            'description' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.duration.description',
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
            'description' => 'LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_domain_model_reference.green_hosting.description',
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

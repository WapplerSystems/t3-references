<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Referenzen',
    'description' => 'reference extension',
    'category' => 'plugin',
    'author' => 'WapplerSystems',
    'author_email' => '',
    'state' => 'alpha',
    'clearCacheOnLoad' => 0,
    'version' => '0.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.0-13.4.99',
            'tagging' => '13.0.0',
        ],
    ],
];

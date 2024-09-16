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
            'typo3' => '12.4.0-12.4.99',
            'tagging' => '12.0.0',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];

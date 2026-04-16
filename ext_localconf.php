<?php

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use wapplersystems\References\Controller\ReferenceController;

defined('TYPO3') || die();

ExtensionUtility::configurePlugin(
    'References',
    'List',
    [
        ReferenceController::class => 'list',
    ],
    [
        ReferenceController::class => '',
    ],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);
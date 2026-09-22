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
    // Die Filterleiste schickt ihre Auswahl per GET. Bliebe list cachebar,
    // lieferte TYPO3 auf jede Auswahl die zwischengespeicherte, ungefilterte
    // Seite aus - der Filter sieht dann aus, als taete er nichts.
    [
        ReferenceController::class => 'list',
    ],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

ExtensionUtility::configurePlugin(
    'References',
    'LogoSlider',
    [
        ReferenceController::class => 'logoSlider',
    ],
    [
        ReferenceController::class => '',
    ],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

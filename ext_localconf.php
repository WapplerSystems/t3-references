<?php

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use wapplersystems\References\Controller\ReferenceController;

defined('TYPO3') || die();

// Die Filterargumente bleiben aus der cHash-Berechnung heraus. Sonst gaebe es
// das Aergernis, dass das Formular seine Felder an eine fertig signierte
// Adresse anhaengt, die Signatur damit nicht mehr passt und TYPO3 mit 404
// antwortet. Die Liste wird ohnehin unzwischengespeichert gerendert, die
// Argumente muessen also nicht in den Seitenschluessel.
// __referrer und __trustedProperties haengt f:form von sich aus an; fuer ein
// GET-Formular tragen sie nichts bei, wuerden die Signatur aber genauso
// umstossen.
$GLOBALS['TYPO3_CONF_VARS']['FE']['cacheHash']['excludedParameters'][] = '^tx_references_list[__';
$GLOBALS['TYPO3_CONF_VARS']['FE']['cacheHash']['excludedParameters'][] = '^tx_references_list[categories]';
$GLOBALS['TYPO3_CONF_VARS']['FE']['cacheHash']['excludedParameters'][] = '=tx_references_list[country]';
$GLOBALS['TYPO3_CONF_VARS']['FE']['cacheHash']['excludedParameters'][] = '=tx_references_list[currentPage]';

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

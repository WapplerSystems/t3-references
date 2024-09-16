<?php
defined('TYPO3') || die();

(static function() {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'References',
        'List',
        [
            \wapplersystems\References\Controller\ReferenceController::class => 'list'
        ],
        [
            \wapplersystems\References\Controller\ReferenceController::class => ''
        ],
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.ext-references {
                header = Referenzen
                after = common
                elements {
                    list {
                        iconIdentifier = references-plugin-list
                        title = LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_list.name
                        description = LLL:EXT:references/Resources/Private/Language/locallang_db.xlf:tx_references_list.description
                        tt_content_defValues {
                            CType = references_list
                        }
                    }
                }
                show = *
            }
       }'
    );
})();

<?php

namespace wapplersystems\References\ViewHelpers;


use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use WapplerSystems\WsT3bootstrap\Fluid\ViewHelper\TagBuilder;

/**
 */
class TagViewHelper extends AbstractViewHelper
{

    /**
     * @return void
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('tags', 'mixed', 'The tags as ObjectStorage or array', true);
        $this->registerArgument('classPrefix', 'string', '');
    }

    /**
     * @return string
     */
    public function render()
    {

        $tags = $this->arguments['tags'];
        $classPrefix = $this->arguments['classPrefix'] ?? '';

        $tagString = '';
        foreach ($tags as $tag) {
            $tagString .= $classPrefix . $tag->getUid() . ' ';
        }
        return $tagString;
    }
}

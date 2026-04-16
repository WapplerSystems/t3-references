<?php

namespace wapplersystems\References\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class TagViewHelper extends AbstractViewHelper
{

    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('tags', 'mixed', 'The tags as ObjectStorage or array', true);
        $this->registerArgument('classPrefix', 'string', '');
    }

    public function render(): string
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
<?php

declare(strict_types=1);

namespace wapplersystems\References\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Checks whether a file relation actually resolves to a file that exists
 * on disk. A sys_file_reference row can exist while the underlying file is
 * missing (e.g. incomplete fileadmin sync), in which case f:image renders
 * nothing but the surrounding markup still would.
 */
class FileExistsViewHelper extends AbstractViewHelper
{
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('file', 'mixed', 'The file or file reference to check', true);
    }

    public function render(): bool
    {
        $file = $this->arguments['file'];
        if ($file === null) {
            return false;
        }

        try {
            $originalResource = method_exists($file, 'getOriginalResource') ? $file->getOriginalResource() : $file;
            if ($originalResource === null) {
                return false;
            }

            $originalFile = method_exists($originalResource, 'getOriginalFile') ? $originalResource->getOriginalFile() : $originalResource;
            if ($originalFile === null) {
                return false;
            }

            return $originalFile->exists();
        } catch (\Throwable) {
            return false;
        }
    }
}

<?php

declare(strict_types=1);

namespace wapplersystems\References\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Detects SVG logos whose main content (the bulk of their path data) is
 * filled white, which would be invisible against the white background of
 * the references list. Logos that merely use a bit of white for small
 * accents on top of their own colored/dark shape (e.g. an icon background)
 * are left alone, since those already have enough contrast on their own.
 */
class LogoNeedsDarkBackgroundViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('file', 'mixed', 'The logo file (FileReference)', true);
    }

    public function render(): bool
    {
        $file = $this->arguments['file'];
        if ($file === null) {
            return false;
        }

        $originalResource = method_exists($file, 'getOriginalResource') ? $file->getOriginalResource() : $file;
        if ($originalResource === null || strtolower($originalResource->getExtension()) !== 'svg') {
            return false;
        }

        $contents = $originalResource->getContents();
        if (empty($contents)) {
            return false;
        }

        return self::hasDominantWhiteContent($contents);
    }

    /**
     * Estimates whether white-filled shapes make up most of the SVG's
     * visible "ink" by comparing the total length of their markup against
     * colored/dark shapes (a proxy for path complexity/area).
     */
    private static function hasDominantWhiteContent(string $svg): bool
    {
        $classFills = [];
        if (preg_match('/<style[^>]*>(.*?)<\/style>/is', $svg, $styleMatch)) {
            preg_match_all('/\.([\w-]+)\s*\{[^}]*fill\s*:\s*([^;}\s]+)/i', $styleMatch[1], $rules, PREG_SET_ORDER);
            foreach ($rules as $rule) {
                $classFills[$rule[1]] = strtolower($rule[2]);
            }
        }

        $isWhite = static fn (string $color): bool => in_array(strtolower(trim($color, "\"' ")), ['#fff', '#ffffff', 'white'], true);

        $whiteWeight = 0;
        $coloredWeight = 0;

        $addWeight = static function (string $color, int $weight) use ($isWhite, &$whiteWeight, &$coloredWeight): void {
            $color = strtolower(trim($color));
            if ($color === 'none') {
                return;
            }
            if ($isWhite($color)) {
                $whiteWeight += $weight;
            } else {
                $coloredWeight += $weight;
            }
        };

        // Groups with a fill attribute apply it to all nested shapes.
        preg_match_all('/<g\b[^>]*\bfill\s*=\s*["\']([^"\']+)["\'][^>]*>(.*?)<\/g>/is', $svg, $groups, PREG_SET_ORDER);
        foreach ($groups as $group) {
            $addWeight($group[1], strlen($group[2]));
        }

        // Shapes with their own inline fill attribute.
        preg_match_all('/<(?:path|polygon|rect|circle|ellipse)\b[^>]*\bfill\s*=\s*["\']([^"\']+)["\'][^>]*\/?>/i', $svg, $inline, PREG_SET_ORDER);
        foreach ($inline as $tag) {
            $addWeight($tag[1], strlen($tag[0]));
        }

        // Shapes referencing a CSS class defined in <style>.
        preg_match_all('/<(?:path|polygon|rect|circle|ellipse)\b[^>]*\bclass\s*=\s*["\']([\w-]+)["\'][^>]*\/?>/i', $svg, $classed, PREG_SET_ORDER);
        foreach ($classed as $tag) {
            if (isset($classFills[$tag[1]])) {
                $addWeight($classFills[$tag[1]], strlen($tag[0]));
            }
        }

        return $whiteWeight > 0 && $whiteWeight > $coloredWeight;
    }
}

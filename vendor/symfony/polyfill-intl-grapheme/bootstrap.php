<?php

namespace _PhpScoperc00d4390f333;

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use _PhpScoperc00d4390f333\Symfony\Polyfill\Intl\Grapheme as p;
if (\extension_loaded('intl')) {
    return;
}
if (!\defined('GRAPHEME_EXTR_COUNT')) {
    \define('GRAPHEME_EXTR_COUNT', 0);
}
if (!\defined('GRAPHEME_EXTR_MAXBYTES')) {
    \define('GRAPHEME_EXTR_MAXBYTES', 1);
}
if (!\defined('GRAPHEME_EXTR_MAXCHARS')) {
    \define('GRAPHEME_EXTR_MAXCHARS', 2);
}
if (!\function_exists('grapheme_extract')) {
    function grapheme_extract($haystack, $size, $extract_type = 0, $start = 0, &$next = 0)
    {
        return \_PhpScoperc00d4390f333\Symfony\Polyfill\Intl\Grapheme\Grapheme::grapheme_extract($haystack, $size, $extract_type, $start, $next);
    }
}
if (!\function_exists('grapheme_stripos')) {
    function grapheme_stripos($haystack, $needle, $offset = 0)
    {
        return \_PhpScoperc00d4390f333\Symfony\Polyfill\Intl\Grapheme\Grapheme::grapheme_stripos($haystack, $needle, $offset);
    }
}
if (!\function_exists('grapheme_stristr')) {
    function grapheme_stristr($haystack, $needle, $before_needle = \false)
    {
        return \_PhpScoperc00d4390f333\Symfony\Polyfill\Intl\Grapheme\Grapheme::grapheme_stristr($haystack, $needle, $before_needle);
    }
}
if (!\function_exists('grapheme_strlen')) {
    function grapheme_strlen($input)
    {
        return \_PhpScoperc00d4390f333\Symfony\Polyfill\Intl\Grapheme\Grapheme::grapheme_strlen($input);
    }
}
if (!\function_exists('grapheme_strpos')) {
    function grapheme_strpos($haystack, $needle, $offset = 0)
    {
        return \_PhpScoperc00d4390f333\Symfony\Polyfill\Intl\Grapheme\Grapheme::grapheme_strpos($haystack, $needle, $offset);
    }
}
if (!\function_exists('grapheme_strripos')) {
    function grapheme_strripos($haystack, $needle, $offset = 0)
    {
        return \_PhpScoperc00d4390f333\Symfony\Polyfill\Intl\Grapheme\Grapheme::grapheme_strripos($haystack, $needle, $offset);
    }
}
if (!\function_exists('grapheme_strrpos')) {
    function grapheme_strrpos($haystack, $needle, $offset = 0)
    {
        return \_PhpScoperc00d4390f333\Symfony\Polyfill\Intl\Grapheme\Grapheme::grapheme_strrpos($haystack, $needle, $offset);
    }
}
if (!\function_exists('grapheme_strstr')) {
    function grapheme_strstr($haystack, $needle, $before_needle = \false)
    {
        return \_PhpScoperc00d4390f333\Symfony\Polyfill\Intl\Grapheme\Grapheme::grapheme_strstr($haystack, $needle, $before_needle);
    }
}
if (!\function_exists('grapheme_substr')) {
    function grapheme_substr($string, $start, $length = null)
    {
        return \_PhpScoperc00d4390f333\Symfony\Polyfill\Intl\Grapheme\Grapheme::grapheme_substr($string, $start, $length);
    }
}
<?php

namespace _PhpScoperd607abf1de8e;

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use _PhpScoperd607abf1de8e\Symfony\Polyfill\Php73 as p;
if (\PHP_VERSION_ID < 70300) {
    if (!\function_exists('is_countable')) {
        function is_countable($var)
        {
            return \is_array($var) || $var instanceof \Countable || $var instanceof \ResourceBundle || $var instanceof \_PhpScoperd607abf1de8e\SimpleXmlElement;
        }
    }
    if (!\function_exists('hrtime')) {
        \_PhpScoperd607abf1de8e\Symfony\Polyfill\Php73\Php73::$startAt = (int) \microtime(\true);
        function hrtime($asNum = \false)
        {
            return \_PhpScoperd607abf1de8e\Symfony\Polyfill\Php73\Php73::hrtime($asNum);
        }
    }
    if (!\function_exists('array_key_first')) {
        function array_key_first(array $array)
        {
            foreach ($array as $key => $value) {
                return $key;
            }
        }
    }
    if (!\function_exists('array_key_last')) {
        function array_key_last(array $array)
        {
            $key = null;
            foreach ($array as $key => $value) {
            }
            return $key;
        }
    }
}

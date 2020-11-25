<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */
declare (strict_types=1);
namespace _PhpScoper3d7663d13234\Nette\Utils;

use _PhpScoper3d7663d13234\Nette;
/**
 * Validation utilities.
 */
class Validators
{
    use Nette\StaticClass;
    protected static $validators = ['bool' => 'is_bool', 'boolean' => 'is_bool', 'int' => 'is_int', 'integer' => 'is_int', 'float' => 'is_float', 'number' => [__CLASS__, 'isNumber'], 'numeric' => [__CLASS__, 'isNumeric'], 'numericint' => [__CLASS__, 'isNumericInt'], 'string' => 'is_string', 'unicode' => [__CLASS__, 'isUnicode'], 'array' => 'is_array', 'list' => [\_PhpScoper3d7663d13234\Nette\Utils\Arrays::class, 'isList'], 'object' => 'is_object', 'resource' => 'is_resource', 'scalar' => 'is_scalar', 'callable' => [__CLASS__, 'isCallable'], 'null' => 'is_null', 'email' => [__CLASS__, 'isEmail'], 'url' => [__CLASS__, 'isUrl'], 'uri' => [__CLASS__, 'isUri'], 'none' => [__CLASS__, 'isNone'], 'type' => [__CLASS__, 'isType'], 'identifier' => [__CLASS__, 'isPhpIdentifier'], 'pattern' => null, 'alnum' => 'ctype_alnum', 'alpha' => 'ctype_alpha', 'digit' => 'ctype_digit', 'lower' => 'ctype_lower', 'upper' => 'ctype_upper', 'space' => 'ctype_space', 'xdigit' => 'ctype_xdigit', 'iterable' => 'is_iterable'];
    protected static $counters = ['string' => 'strlen', 'unicode' => [\_PhpScoper3d7663d13234\Nette\Utils\Strings::class, 'length'], 'array' => 'count', 'list' => 'count', 'alnum' => 'strlen', 'alpha' => 'strlen', 'digit' => 'strlen', 'lower' => 'strlen', 'space' => 'strlen', 'upper' => 'strlen', 'xdigit' => 'strlen'];
    /**
     * Throws exception if a variable is of unexpected type (separated by pipe).
     */
    public static function assert($value, string $expected, string $label = 'variable') : void
    {
        if (!static::is($value, $expected)) {
            $expected = \str_replace(['|', ':'], [' or ', ' in range '], $expected);
            if (\is_array($value)) {
                $type = 'array(' . \count($value) . ')';
            } elseif (\is_object($value)) {
                $type = 'object ' . \get_class($value);
            } elseif (\is_string($value) && \strlen($value) < 40) {
                $type = "string '{$value}'";
            } else {
                $type = \gettype($value);
            }
            throw new \_PhpScoper3d7663d13234\Nette\Utils\AssertionException("The {$label} expects to be {$expected}, {$type} given.");
        }
    }
    /**
     * Throws exception if an array field is missing or of unexpected type (separated by pipe).
     */
    public static function assertField(array $arr, $field, string $expected = null, string $label = "item '%' in array") : void
    {
        if (!\array_key_exists($field, $arr)) {
            throw new \_PhpScoper3d7663d13234\Nette\Utils\AssertionException('Missing ' . \str_replace('%', $field, $label) . '.');
        } elseif ($expected) {
            static::assert($arr[$field], $expected, \str_replace('%', $field, $label));
        }
    }
    /**
     * Finds whether a variable is of expected type (separated by pipe).
     */
    public static function is($value, string $expected) : bool
    {
        foreach (\explode('|', $expected) as $item) {
            if (\substr($item, -2) === '[]') {
                if (\is_iterable($value) && self::everyIs($value, \substr($item, 0, -2))) {
                    return \true;
                }
                continue;
            }
            [$type] = $item = \explode(':', $item, 2);
            if (isset(static::$validators[$type])) {
                if (!static::$validators[$type]($value)) {
                    continue;
                }
            } elseif ($type === 'pattern') {
                if (\preg_match('|^' . ($item[1] ?? '') . '\\z|', $value)) {
                    return \true;
                }
                continue;
            } elseif (!$value instanceof $type) {
                continue;
            }
            if (isset($item[1])) {
                $length = $value;
                if (isset(static::$counters[$type])) {
                    $length = static::$counters[$type]($value);
                }
                $range = \explode('..', $item[1]);
                if (!isset($range[1])) {
                    $range[1] = $range[0];
                }
                if ($range[0] !== '' && $length < $range[0] || $range[1] !== '' && $length > $range[1]) {
                    continue;
                }
            }
            return \true;
        }
        return \false;
    }
    /**
     * Finds whether all values are of expected type (separated by pipe).
     */
    public static function everyIs(iterable $values, string $expected) : bool
    {
        foreach ($values as $value) {
            if (!static::is($value, $expected)) {
                return \false;
            }
        }
        return \true;
    }
    /**
     * Finds whether a value is an integer or a float.
     */
    public static function isNumber($value) : bool
    {
        return \is_int($value) || \is_float($value);
    }
    /**
     * Finds whether a value is an integer.
     */
    public static function isNumericInt($value) : bool
    {
        return \is_int($value) || \is_string($value) && \preg_match('#^-?[0-9]+\\z#', $value);
    }
    /**
     * Finds whether a string is a floating point number in decimal base.
     */
    public static function isNumeric($value) : bool
    {
        return \is_float($value) || \is_int($value) || \is_string($value) && \preg_match('#^-?[0-9]*[.]?[0-9]+\\z#', $value);
    }
    /**
     * Finds whether a value is a syntactically correct callback.
     */
    public static function isCallable($value) : bool
    {
        return $value && \is_callable($value, \true);
    }
    /**
     * Finds whether a value is an UTF-8 encoded string.
     */
    public static function isUnicode($value) : bool
    {
        return \is_string($value) && \preg_match('##u', $value);
    }
    /**
     * Finds whether a value is "falsy".
     */
    public static function isNone($value) : bool
    {
        return $value == null;
        // intentionally ==
    }
    /**
     * Finds whether a variable is a zero-based integer indexed array.
     */
    public static function isList($value) : bool
    {
        return \_PhpScoper3d7663d13234\Nette\Utils\Arrays::isList($value);
    }
    /**
     * Is a value in specified min and max value pair?
     */
    public static function isInRange($value, array $range) : bool
    {
        if ($value === null || !(isset($range[0]) || isset($range[1]))) {
            return \false;
        }
        $limit = $range[0] ?? $range[1];
        if (\is_string($limit)) {
            $value = (string) $value;
        } elseif ($limit instanceof \DateTimeInterface) {
            if (!$value instanceof \DateTimeInterface) {
                return \false;
            }
        } elseif (\is_numeric($value)) {
            $value *= 1;
        } else {
            return \false;
        }
        return (!isset($range[0]) || $value >= $range[0]) && (!isset($range[1]) || $value <= $range[1]);
    }
    /**
     * Finds whether a string is a valid email address.
     */
    public static function isEmail(string $value) : bool
    {
        $atom = "[-a-z0-9!#\$%&'*+/=?^_`{|}~]";
        // RFC 5322 unquoted characters in local-part
        $alpha = "a-z�-�";
        // superset of IDN
        return (bool) \preg_match("(^\n\t\t\t(\"([ !#-[\\]-~]*|\\\\[ -~])+\"|{$atom}+(\\.{$atom}+)*)  # quoted or unquoted\n\t\t\t@\n\t\t\t([0-9{$alpha}]([-0-9{$alpha}]{0,61}[0-9{$alpha}])?\\.)+    # domain - RFC 1034\n\t\t\t[{$alpha}]([-0-9{$alpha}]{0,17}[{$alpha}])?                # top domain\n\t\t\\z)ix", $value);
    }
    /**
     * Finds whether a string is a valid http(s) URL.
     */
    public static function isUrl(string $value) : bool
    {
        $alpha = "a-z�-�";
        return (bool) \preg_match("(^\n\t\t\thttps?://(\n\t\t\t\t(([-_0-9{$alpha}]+\\.)*                       # subdomain\n\t\t\t\t\t[0-9{$alpha}]([-0-9{$alpha}]{0,61}[0-9{$alpha}])?\\.)?  # domain\n\t\t\t\t\t[{$alpha}]([-0-9{$alpha}]{0,17}[{$alpha}])?   # top domain\n\t\t\t\t|\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}  # IPv4\n\t\t\t\t|\\[[0-9a-f:]{3,39}\\]                        # IPv6\n\t\t\t)(:\\d{1,5})?                                   # port\n\t\t\t(/\\S*)?                                        # path\n\t\t\\z)ix", $value);
    }
    /**
     * Finds whether a string is a valid URI according to RFC 1738.
     */
    public static function isUri(string $value) : bool
    {
        return (bool) \preg_match('#^[a-z\\d+\\.-]+:\\S+\\z#i', $value);
    }
    /**
     * Checks whether the input is a class, interface or trait.
     */
    public static function isType(string $type) : bool
    {
        return \class_exists($type) || \interface_exists($type) || \trait_exists($type);
    }
    /**
     * Checks whether the input is a valid PHP identifier.
     */
    public static function isPhpIdentifier(string $value) : bool
    {
        return \is_string($value) && \preg_match('#^[a-zA-Z_\\x7f-\\xff][a-zA-Z0-9_\\x7f-\\xff]*\\z#', $value);
    }
}

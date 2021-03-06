<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */
declare (strict_types=1);
namespace _PhpScoper36281e29f54f\Nette\Utils;

use _PhpScoper36281e29f54f\Nette;
/**
 * Provides objects to work as array.
 */
class ArrayHash extends \stdClass implements \ArrayAccess, \Countable, \IteratorAggregate
{
    /**
     * @return static
     */
    public static function from(array $arr, bool $recursive = \true)
    {
        $obj = new static();
        foreach ($arr as $key => $value) {
            if ($recursive && \is_array($value)) {
                $obj->{$key} = static::from($value, \true);
            } else {
                $obj->{$key} = $value;
            }
        }
        return $obj;
    }
    /**
     * Returns an iterator over all items.
     */
    public function getIterator() : \RecursiveArrayIterator
    {
        return new \RecursiveArrayIterator((array) $this);
    }
    /**
     * Returns items count.
     */
    public function count() : int
    {
        return \count((array) $this);
    }
    /**
     * Replaces or appends a item.
     */
    public function offsetSet($key, $value) : void
    {
        if (!\is_scalar($key)) {
            // prevents null
            throw new \_PhpScoper36281e29f54f\Nette\InvalidArgumentException(\sprintf('Key must be either a string or an integer, %s given.', \gettype($key)));
        }
        $this->{$key} = $value;
    }
    /**
     * Returns a item.
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->{$key};
    }
    /**
     * Determines whether a item exists.
     */
    public function offsetExists($key) : bool
    {
        return isset($this->{$key});
    }
    /**
     * Removes the element from this list.
     */
    public function offsetUnset($key) : void
    {
        unset($this->{$key});
    }
}

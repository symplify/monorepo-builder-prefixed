<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */
declare (strict_types=1);
namespace _PhpScoper36281e29f54f\Nette\Neon;

/**
 * Simple parser & generator for Nette Object Notation.
 */
final class Neon
{
    public const BLOCK = \_PhpScoper36281e29f54f\Nette\Neon\Encoder::BLOCK;
    public const CHAIN = '!!chain';
    /**
     * Returns the NEON representation of a value.
     */
    public static function encode($var, int $flags = 0) : string
    {
        $encoder = new \_PhpScoper36281e29f54f\Nette\Neon\Encoder();
        return $encoder->encode($var, $flags);
    }
    /**
     * Decodes a NEON string.
     * @return mixed
     */
    public static function decode(string $input)
    {
        $decoder = new \_PhpScoper36281e29f54f\Nette\Neon\Decoder();
        return $decoder->decode($input);
    }
}

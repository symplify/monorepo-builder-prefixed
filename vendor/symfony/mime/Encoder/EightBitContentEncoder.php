<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperc86a79e2d6b2\Symfony\Component\Mime\Encoder;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @experimental in 4.3
 */
final class EightBitContentEncoder implements \_PhpScoperc86a79e2d6b2\Symfony\Component\Mime\Encoder\ContentEncoderInterface
{
    public function encodeByteStream($stream, int $maxLineLength = 0) : iterable
    {
        while (!\feof($stream)) {
            (yield \fread($stream, 16372));
        }
    }
    public function getName() : string
    {
        return '8bit';
    }
    public function encodeString(string $string, ?string $charset = 'utf-8', int $firstLineOffset = 0, int $maxLineLength = 0) : string
    {
        return $string;
    }
}

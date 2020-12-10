<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperc53cafc6ca57\Symfony\Component\Mime\Tests;

use _PhpScoperc53cafc6ca57\Symfony\Component\Mime\FileBinaryMimeTypeGuesser;
use _PhpScoperc53cafc6ca57\Symfony\Component\Mime\MimeTypeGuesserInterface;
class FileBinaryMimeTypeGuesserTest extends \_PhpScoperc53cafc6ca57\Symfony\Component\Mime\Tests\AbstractMimeTypeGuesserTest
{
    protected function getGuesser() : \_PhpScoperc53cafc6ca57\Symfony\Component\Mime\MimeTypeGuesserInterface
    {
        return new \_PhpScoperc53cafc6ca57\Symfony\Component\Mime\FileBinaryMimeTypeGuesser();
    }
}

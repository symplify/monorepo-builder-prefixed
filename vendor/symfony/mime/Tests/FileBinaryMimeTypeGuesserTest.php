<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperb15c77d6bb3b\Symfony\Component\Mime\Tests;

use _PhpScoperb15c77d6bb3b\Symfony\Component\Mime\FileBinaryMimeTypeGuesser;
use _PhpScoperb15c77d6bb3b\Symfony\Component\Mime\MimeTypeGuesserInterface;
class FileBinaryMimeTypeGuesserTest extends \_PhpScoperb15c77d6bb3b\Symfony\Component\Mime\Tests\AbstractMimeTypeGuesserTest
{
    protected function getGuesser() : \_PhpScoperb15c77d6bb3b\Symfony\Component\Mime\MimeTypeGuesserInterface
    {
        return new \_PhpScoperb15c77d6bb3b\Symfony\Component\Mime\FileBinaryMimeTypeGuesser();
    }
}

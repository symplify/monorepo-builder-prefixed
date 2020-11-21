<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperb56893078f23\Symfony\Component\Mime\Tests;

use _PhpScoperb56893078f23\Symfony\Component\Mime\FileBinaryMimeTypeGuesser;
use _PhpScoperb56893078f23\Symfony\Component\Mime\MimeTypeGuesserInterface;
class FileBinaryMimeTypeGuesserTest extends \_PhpScoperb56893078f23\Symfony\Component\Mime\Tests\AbstractMimeTypeGuesserTest
{
    protected function getGuesser() : \_PhpScoperb56893078f23\Symfony\Component\Mime\MimeTypeGuesserInterface
    {
        return new \_PhpScoperb56893078f23\Symfony\Component\Mime\FileBinaryMimeTypeGuesser();
    }
}

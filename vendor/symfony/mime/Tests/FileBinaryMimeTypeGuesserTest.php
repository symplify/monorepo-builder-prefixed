<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperbb737891eded\Symfony\Component\Mime\Tests;

use _PhpScoperbb737891eded\Symfony\Component\Mime\FileBinaryMimeTypeGuesser;
use _PhpScoperbb737891eded\Symfony\Component\Mime\MimeTypeGuesserInterface;
class FileBinaryMimeTypeGuesserTest extends \_PhpScoperbb737891eded\Symfony\Component\Mime\Tests\AbstractMimeTypeGuesserTest
{
    protected function getGuesser() : \_PhpScoperbb737891eded\Symfony\Component\Mime\MimeTypeGuesserInterface
    {
        return new \_PhpScoperbb737891eded\Symfony\Component\Mime\FileBinaryMimeTypeGuesser();
    }
}

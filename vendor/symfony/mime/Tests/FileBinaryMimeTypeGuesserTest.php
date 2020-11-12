<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperb0f70d760c3d\Symfony\Component\Mime\Tests;

use _PhpScoperb0f70d760c3d\Symfony\Component\Mime\FileBinaryMimeTypeGuesser;
use _PhpScoperb0f70d760c3d\Symfony\Component\Mime\MimeTypeGuesserInterface;
class FileBinaryMimeTypeGuesserTest extends \_PhpScoperb0f70d760c3d\Symfony\Component\Mime\Tests\AbstractMimeTypeGuesserTest
{
    protected function getGuesser() : \_PhpScoperb0f70d760c3d\Symfony\Component\Mime\MimeTypeGuesserInterface
    {
        return new \_PhpScoperb0f70d760c3d\Symfony\Component\Mime\FileBinaryMimeTypeGuesser();
    }
}

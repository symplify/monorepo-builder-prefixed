<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperd607abf1de8e\Symfony\Component\Mime\Tests\Part\Multipart;

use _PhpScoperd607abf1de8e\PHPUnit\Framework\TestCase;
use _PhpScoperd607abf1de8e\Symfony\Component\Mime\Message;
use _PhpScoperd607abf1de8e\Symfony\Component\Mime\Part\MessagePart;
use _PhpScoperd607abf1de8e\Symfony\Component\Mime\Part\Multipart\DigestPart;
class DigestPartTest extends \_PhpScoperd607abf1de8e\PHPUnit\Framework\TestCase
{
    public function testConstructor()
    {
        $r = new \_PhpScoperd607abf1de8e\Symfony\Component\Mime\Part\Multipart\DigestPart($a = new \_PhpScoperd607abf1de8e\Symfony\Component\Mime\Part\MessagePart(new \_PhpScoperd607abf1de8e\Symfony\Component\Mime\Message()), $b = new \_PhpScoperd607abf1de8e\Symfony\Component\Mime\Part\MessagePart(new \_PhpScoperd607abf1de8e\Symfony\Component\Mime\Message()));
        $this->assertEquals('multipart', $r->getMediaType());
        $this->assertEquals('digest', $r->getMediaSubtype());
        $this->assertEquals([$a, $b], $r->getParts());
    }
}

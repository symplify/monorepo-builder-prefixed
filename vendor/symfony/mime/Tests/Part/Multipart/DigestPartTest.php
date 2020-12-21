<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperb397db9687c8\Symfony\Component\Mime\Tests\Part\Multipart;

use _PhpScoperb397db9687c8\PHPUnit\Framework\TestCase;
use _PhpScoperb397db9687c8\Symfony\Component\Mime\Message;
use _PhpScoperb397db9687c8\Symfony\Component\Mime\Part\MessagePart;
use _PhpScoperb397db9687c8\Symfony\Component\Mime\Part\Multipart\DigestPart;
class DigestPartTest extends \_PhpScoperb397db9687c8\PHPUnit\Framework\TestCase
{
    public function testConstructor()
    {
        $r = new \_PhpScoperb397db9687c8\Symfony\Component\Mime\Part\Multipart\DigestPart($a = new \_PhpScoperb397db9687c8\Symfony\Component\Mime\Part\MessagePart(new \_PhpScoperb397db9687c8\Symfony\Component\Mime\Message()), $b = new \_PhpScoperb397db9687c8\Symfony\Component\Mime\Part\MessagePart(new \_PhpScoperb397db9687c8\Symfony\Component\Mime\Message()));
        $this->assertEquals('multipart', $r->getMediaType());
        $this->assertEquals('digest', $r->getMediaSubtype());
        $this->assertEquals([$a, $b], $r->getParts());
    }
}

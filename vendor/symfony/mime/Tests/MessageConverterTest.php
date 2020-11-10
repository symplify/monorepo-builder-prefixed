<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper31b05558ad5c\Symfony\Component\Mime\Tests;

use _PhpScoper31b05558ad5c\PHPUnit\Framework\TestCase;
use _PhpScoper31b05558ad5c\Symfony\Component\Mime\Email;
use _PhpScoper31b05558ad5c\Symfony\Component\Mime\Message;
use _PhpScoper31b05558ad5c\Symfony\Component\Mime\MessageConverter;
class MessageConverterTest extends \_PhpScoper31b05558ad5c\PHPUnit\Framework\TestCase
{
    public function testToEmail()
    {
        $file = \file_get_contents(__DIR__ . '/Fixtures/mimetypes/test.gif');
        $email = (new \_PhpScoper31b05558ad5c\Symfony\Component\Mime\Email())->from('fabien@symfony.com');
        $this->assertSame($email, \_PhpScoper31b05558ad5c\Symfony\Component\Mime\MessageConverter::toEmail($email));
        $this->assertConversion((clone $email)->text('text content'));
        $this->assertConversion((clone $email)->html('HTML content <img src="cid:test.jpg" />'));
        $this->assertConversion((clone $email)->text('text content')->html('HTML content <img src="cid:test.jpg" />'));
        $this->assertConversion((clone $email)->text('text content')->html('HTML content <img src="cid:test.jpg" />')->embed($file, 'test.jpg', 'image/gif'));
        $this->assertConversion((clone $email)->text('text content')->html('HTML content <img src="cid:test.jpg" />')->attach($file, 'test_attached.jpg', 'image/gif'));
        $this->assertConversion((clone $email)->text('text content')->html('HTML content <img src="cid:test.jpg" />')->embed($file, 'test.jpg', 'image/gif')->attach($file, 'test_attached.jpg', 'image/gif'));
        $this->assertConversion((clone $email)->text('text content')->attach($file, 'test_attached.jpg', 'image/gif'));
        $this->assertConversion((clone $email)->html('HTML content <img src="cid:test.jpg" />')->attach($file, 'test_attached.jpg', 'image/gif'));
        $this->assertConversion((clone $email)->html('HTML content <img src="cid:test.jpg" />')->embed($file, 'test.jpg', 'image/gif'));
        $this->assertConversion((clone $email)->text('text content')->embed($file, 'test_attached.jpg', 'image/gif'));
    }
    private function assertConversion(\_PhpScoper31b05558ad5c\Symfony\Component\Mime\Email $expected)
    {
        $r = new \ReflectionMethod($expected, 'generateBody');
        $r->setAccessible(\true);
        $message = new \_PhpScoper31b05558ad5c\Symfony\Component\Mime\Message($expected->getHeaders(), $r->invoke($expected));
        $converted = \_PhpScoper31b05558ad5c\Symfony\Component\Mime\MessageConverter::toEmail($message);
        if ($expected->getHtmlBody()) {
            $this->assertStringMatchesFormat(\str_replace('cid:test.jpg', 'cid:%s', $expected->getHtmlBody()), $converted->getHtmlBody());
            $expected->html('HTML content');
            $converted->html('HTML content');
        }
        $this->assertEquals($expected, $converted);
    }
}

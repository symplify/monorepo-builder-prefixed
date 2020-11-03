<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper323d4c178bee\Symfony\Component\Mime\Tests;

use _PhpScoper323d4c178bee\PHPUnit\Framework\TestCase;
use _PhpScoper323d4c178bee\Symfony\Component\Mime\MimeTypeGuesserInterface;
abstract class AbstractMimeTypeGuesserTest extends \_PhpScoper323d4c178bee\PHPUnit\Framework\TestCase
{
    public static function tearDownAfterClass()
    {
        $path = __DIR__ . '/Fixtures/mimetypes/to_delete';
        if (\file_exists($path)) {
            @\chmod($path, 0666);
            @\unlink($path);
        }
    }
    protected abstract function getGuesser() : \_PhpScoper323d4c178bee\Symfony\Component\Mime\MimeTypeGuesserInterface;
    public function testGuessImageWithoutExtension()
    {
        if (!$this->getGuesser()->isGuesserSupported()) {
            $this->markTestSkipped('Guesser is not supported');
        }
        $this->assertEquals('image/gif', $this->getGuesser()->guessMimeType(__DIR__ . '/Fixtures/mimetypes/test'));
    }
    public function testGuessImageWithDirectory()
    {
        if (!$this->getGuesser()->isGuesserSupported()) {
            $this->markTestSkipped('Guesser is not supported');
        }
        $this->expectException('\\InvalidArgumentException');
        $this->getGuesser()->guessMimeType(__DIR__ . '/Fixtures/mimetypes/directory');
    }
    public function testGuessImageWithKnownExtension()
    {
        if (!$this->getGuesser()->isGuesserSupported()) {
            $this->markTestSkipped('Guesser is not supported');
        }
        $this->assertEquals('image/gif', $this->getGuesser()->guessMimeType(__DIR__ . '/Fixtures/mimetypes/test.gif'));
    }
    public function testGuessFileWithUnknownExtension()
    {
        if (!$this->getGuesser()->isGuesserSupported()) {
            $this->markTestSkipped('Guesser is not supported');
        }
        $this->assertEquals('application/octet-stream', $this->getGuesser()->guessMimeType(__DIR__ . '/Fixtures/mimetypes/.unknownextension'));
    }
    public function testGuessWithIncorrectPath()
    {
        if (!$this->getGuesser()->isGuesserSupported()) {
            $this->markTestSkipped('Guesser is not supported');
        }
        $this->expectException('\\InvalidArgumentException');
        $this->getGuesser()->guessMimeType(__DIR__ . '/Fixtures/mimetypes/not_here');
    }
    public function testGuessWithNonReadablePath()
    {
        if (!$this->getGuesser()->isGuesserSupported()) {
            $this->markTestSkipped('Guesser is not supported');
        }
        if ('\\' === \DIRECTORY_SEPARATOR) {
            $this->markTestSkipped('Can not verify chmod operations on Windows');
        }
        if (!\getenv('USER') || 'root' === \getenv('USER')) {
            $this->markTestSkipped('This test will fail if run under superuser');
        }
        $path = __DIR__ . '/Fixtures/mimetypes/to_delete';
        \touch($path);
        @\chmod($path, 0333);
        if ('0333' == \substr(\sprintf('%o', \fileperms($path)), -4)) {
            $this->expectException('\\InvalidArgumentException');
            $this->getGuesser()->guessMimeType($path);
        } else {
            $this->markTestSkipped('Can not verify chmod operations, change of file permissions failed');
        }
    }
}
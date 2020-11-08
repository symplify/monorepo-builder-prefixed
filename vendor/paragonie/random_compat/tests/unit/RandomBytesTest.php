<?php

namespace _PhpScoper3c46f40844ed;

class RandomBytesTest extends \_PhpScoper3c46f40844ed\PHPUnit_Framework_TestCase
{
    public function testFuncExists()
    {
        $this->assertTrue(\function_exists('random_bytes'));
    }
    public function testOutput()
    {
        $bytes = array(\random_bytes(12), \random_bytes(64), \random_bytes(64));
        $this->assertTrue(\strlen(\bin2hex($bytes[0])) === 24);
        // This should never generate identical byte strings
        $this->assertFalse($bytes[1] === $bytes[2]);
    }
}
\class_alias('_PhpScoper3c46f40844ed\\RandomBytesTest', 'RandomBytesTest', \false);

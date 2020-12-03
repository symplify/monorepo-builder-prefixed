<?php

/*
 * This file is part of PharIo\Version.
 *
 * (c) Arne Blankerts <arne@blankerts.de>, Sebastian Heuer <sebastian@phpeople.de>, Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper3a64dbb4e14f\PharIo\Version;

use _PhpScoper3a64dbb4e14f\PHPUnit\Framework\TestCase;
/**
 * @covers \PharIo\Version\AnyVersionConstraint
 */
class AnyVersionConstraintTest extends \_PhpScoper3a64dbb4e14f\PHPUnit\Framework\TestCase
{
    public function versionProvider()
    {
        return [[new \_PhpScoper3a64dbb4e14f\PharIo\Version\Version('1.0.2')], [new \_PhpScoper3a64dbb4e14f\PharIo\Version\Version('4.8')], [new \_PhpScoper3a64dbb4e14f\PharIo\Version\Version('0.1.1-dev')]];
    }
    /**
     * @dataProvider versionProvider
     *
     * @param Version $version
     */
    public function testReturnsTrue(\_PhpScoper3a64dbb4e14f\PharIo\Version\Version $version)
    {
        $constraint = new \_PhpScoper3a64dbb4e14f\PharIo\Version\AnyVersionConstraint();
        $this->assertTrue($constraint->complies($version));
    }
    public function testAsString()
    {
        $this->assertSame('*', (new \_PhpScoper3a64dbb4e14f\PharIo\Version\AnyVersionConstraint())->asString());
    }
}

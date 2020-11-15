<?php

/*
 * This file is part of PharIo\Version.
 *
 * (c) Arne Blankerts <arne@blankerts.de>, Sebastian Heuer <sebastian@phpeople.de>, Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper4ef7335528ad\PharIo\Version;

use _PhpScoper4ef7335528ad\PHPUnit\Framework\TestCase;
/**
 * @covers \PharIo\Version\AndVersionConstraintGroup
 */
class AndVersionConstraintGroupTest extends \_PhpScoper4ef7335528ad\PHPUnit\Framework\TestCase
{
    public function testReturnsFalseIfOneConstraintReturnsFalse()
    {
        $firstConstraint = $this->createMock(\_PhpScoper4ef7335528ad\PharIo\Version\VersionConstraint::class);
        $secondConstraint = $this->createMock(\_PhpScoper4ef7335528ad\PharIo\Version\VersionConstraint::class);
        $firstConstraint->expects($this->once())->method('complies')->will($this->returnValue(\true));
        $secondConstraint->expects($this->once())->method('complies')->will($this->returnValue(\false));
        $group = new \_PhpScoper4ef7335528ad\PharIo\Version\AndVersionConstraintGroup('foo', [$firstConstraint, $secondConstraint]);
        $this->assertFalse($group->complies(new \_PhpScoper4ef7335528ad\PharIo\Version\Version('1.0.0')));
    }
    public function testReturnsTrueIfAllConstraintsReturnsTrue()
    {
        $firstConstraint = $this->createMock(\_PhpScoper4ef7335528ad\PharIo\Version\VersionConstraint::class);
        $secondConstraint = $this->createMock(\_PhpScoper4ef7335528ad\PharIo\Version\VersionConstraint::class);
        $firstConstraint->expects($this->once())->method('complies')->will($this->returnValue(\true));
        $secondConstraint->expects($this->once())->method('complies')->will($this->returnValue(\true));
        $group = new \_PhpScoper4ef7335528ad\PharIo\Version\AndVersionConstraintGroup('foo', [$firstConstraint, $secondConstraint]);
        $this->assertTrue($group->complies(new \_PhpScoper4ef7335528ad\PharIo\Version\Version('1.0.0')));
    }
}

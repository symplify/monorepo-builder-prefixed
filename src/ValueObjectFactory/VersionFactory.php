<?php

declare (strict_types=1);
namespace Symplify\MonorepoBuilder\ValueObjectFactory;

use _PhpScoper3ceab9fdc42a\PharIo\Version\Version;
final class VersionFactory
{
    public function create(string $version) : \_PhpScoper3ceab9fdc42a\PharIo\Version\Version
    {
        return new \_PhpScoper3ceab9fdc42a\PharIo\Version\Version($version);
    }
}

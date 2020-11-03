<?php

declare (strict_types=1);
namespace Symplify\MonorepoBuilder\ValueObjectFactory;

use _PhpScoper0dbf6264e8b4\PharIo\Version\Version;
final class VersionFactory
{
    public function create(string $version) : \_PhpScoper0dbf6264e8b4\PharIo\Version\Version
    {
        return new \_PhpScoper0dbf6264e8b4\PharIo\Version\Version($version);
    }
}

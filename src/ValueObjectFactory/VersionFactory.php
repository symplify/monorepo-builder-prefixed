<?php

declare (strict_types=1);
namespace Symplify\MonorepoBuilder\ValueObjectFactory;

use _PhpScoper6d6fbd28d6a9\PharIo\Version\Version;
final class VersionFactory
{
    public function create(string $version) : \_PhpScoper6d6fbd28d6a9\PharIo\Version\Version
    {
        return new \_PhpScoper6d6fbd28d6a9\PharIo\Version\Version($version);
    }
}

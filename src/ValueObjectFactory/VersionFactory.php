<?php

declare (strict_types=1);
namespace Symplify\MonorepoBuilder\ValueObjectFactory;

use _PhpScoper227dea868235\PharIo\Version\Version;
final class VersionFactory
{
    public function create(string $version) : \_PhpScoper227dea868235\PharIo\Version\Version
    {
        return new \_PhpScoper227dea868235\PharIo\Version\Version($version);
    }
}

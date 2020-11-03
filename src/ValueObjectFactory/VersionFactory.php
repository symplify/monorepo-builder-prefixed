<?php

declare (strict_types=1);
namespace Symplify\MonorepoBuilder\ValueObjectFactory;

use _PhpScoper15dc67236b17\PharIo\Version\Version;
final class VersionFactory
{
    public function create(string $version) : \_PhpScoper15dc67236b17\PharIo\Version\Version
    {
        return new \_PhpScoper15dc67236b17\PharIo\Version\Version($version);
    }
}

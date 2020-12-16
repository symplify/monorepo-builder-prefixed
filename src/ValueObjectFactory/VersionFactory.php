<?php

declare (strict_types=1);
namespace Symplify\MonorepoBuilder\ValueObjectFactory;

use _PhpScoper1e8bd38a2146\PharIo\Version\Version;
final class VersionFactory
{
    public function create(string $version) : \_PhpScoper1e8bd38a2146\PharIo\Version\Version
    {
        return new \_PhpScoper1e8bd38a2146\PharIo\Version\Version($version);
    }
}

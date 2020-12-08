<?php

declare (strict_types=1);
namespace Symplify\MonorepoBuilder\ValueObjectFactory;

use _PhpScoper78864f032ec6\PharIo\Version\Version;
final class VersionFactory
{
    public function create(string $version) : \_PhpScoper78864f032ec6\PharIo\Version\Version
    {
        return new \_PhpScoper78864f032ec6\PharIo\Version\Version($version);
    }
}

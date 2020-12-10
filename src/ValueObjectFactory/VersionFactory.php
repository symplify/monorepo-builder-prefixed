<?php

declare (strict_types=1);
namespace Symplify\MonorepoBuilder\ValueObjectFactory;

use _PhpScoper9e8360c7485e\PharIo\Version\Version;
final class VersionFactory
{
    public function create(string $version) : \_PhpScoper9e8360c7485e\PharIo\Version\Version
    {
        return new \_PhpScoper9e8360c7485e\PharIo\Version\Version($version);
    }
}

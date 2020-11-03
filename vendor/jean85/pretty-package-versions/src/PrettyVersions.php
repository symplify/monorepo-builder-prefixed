<?php

namespace _PhpScoper1d3d21549513\Jean85;

use _PhpScoper1d3d21549513\PackageVersions\Versions;
class PrettyVersions
{
    const SHORT_COMMIT_LENGTH = 7;
    public static function getVersion(string $packageName) : \_PhpScoper1d3d21549513\Jean85\Version
    {
        return new \_PhpScoper1d3d21549513\Jean85\Version($packageName, \_PhpScoper1d3d21549513\PackageVersions\Versions::getVersion($packageName));
    }
    public static function getRootPackageName() : string
    {
        return \_PhpScoper1d3d21549513\PackageVersions\Versions::ROOT_PACKAGE_NAME;
    }
    public static function getRootPackageVersion() : \_PhpScoper1d3d21549513\Jean85\Version
    {
        return self::getVersion(\_PhpScoper1d3d21549513\PackageVersions\Versions::ROOT_PACKAGE_NAME);
    }
}

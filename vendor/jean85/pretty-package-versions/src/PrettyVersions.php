<?php

namespace _PhpScoper227dea868235\Jean85;

use _PhpScoper227dea868235\PackageVersions\Versions;
class PrettyVersions
{
    const SHORT_COMMIT_LENGTH = 7;
    public static function getVersion(string $packageName) : \_PhpScoper227dea868235\Jean85\Version
    {
        return new \_PhpScoper227dea868235\Jean85\Version($packageName, \_PhpScoper227dea868235\PackageVersions\Versions::getVersion($packageName));
    }
    public static function getRootPackageName() : string
    {
        return \_PhpScoper227dea868235\PackageVersions\Versions::ROOT_PACKAGE_NAME;
    }
    public static function getRootPackageVersion() : \_PhpScoper227dea868235\Jean85\Version
    {
        return self::getVersion(\_PhpScoper227dea868235\PackageVersions\Versions::ROOT_PACKAGE_NAME);
    }
}

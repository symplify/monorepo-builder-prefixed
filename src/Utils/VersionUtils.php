<?php

declare (strict_types=1);
namespace Symplify\MonorepoBuilder\Utils;

use _PhpScoper058a557299a1\PharIo\Version\Version;
use Symplify\MonorepoBuilder\ValueObject\Option;
use Symplify\MonorepoBuilder\ValueObjectFactory\VersionFactory;
use Symplify\PackageBuilder\Parameter\ParameterProvider;
/**
 * @see \Symplify\MonorepoBuilder\Tests\Utils\VersionUtilsTest
 */
final class VersionUtils
{
    /**
     * @var string
     */
    private $packageAliasFormat;
    /**
     * @var VersionFactory
     */
    private $versionFactory;
    public function __construct(\Symplify\PackageBuilder\Parameter\ParameterProvider $parameterProvider, \Symplify\MonorepoBuilder\ValueObjectFactory\VersionFactory $versionFactory)
    {
        $this->packageAliasFormat = $parameterProvider->provideStringParameter(\Symplify\MonorepoBuilder\ValueObject\Option::PACKAGE_ALIAS_FORMAT);
        $this->versionFactory = $versionFactory;
    }
    /**
     * @param Version|string $version
     */
    public function getNextAliasFormat($version) : string
    {
        $version = $this->normalizeVersion($version);
        $minor = $this->getNextMinorNumber($version);
        return \str_replace(['<major>', '<minor>'], [$version->getMajor()->getValue(), $minor], $this->packageAliasFormat);
    }
    /**
     * @param Version|string $version
     */
    public function getRequiredNextFormat($version) : string
    {
        $version = $this->normalizeVersion($version);
        $minor = $this->getNextMinorNumber($version);
        return '^' . $version->getMajor()->getValue() . '.' . $minor;
    }
    /**
     * @param Version|string $version
     */
    public function getRequiredFormat($version) : string
    {
        $version = $this->normalizeVersion($version);
        $requireVersion = '^' . $version->getMajor()->getValue() . '.' . $version->getMinor()->getValue();
        $value = $version->getPatch()->getValue();
        if ($value > 0) {
            $requireVersion .= '.' . $value;
        }
        return $requireVersion;
    }
    /**
     * @param Version|string $version
     */
    private function normalizeVersion($version) : \_PhpScoper058a557299a1\PharIo\Version\Version
    {
        if (\is_string($version)) {
            return $this->versionFactory->create($version);
        }
        return $version;
    }
    private function getNextMinorNumber(\_PhpScoper058a557299a1\PharIo\Version\Version $version) : int
    {
        if ($version->hasPreReleaseSuffix()) {
            return (int) $version->getMinor()->getValue();
        }
        return $version->getMinor()->getValue() + 1;
    }
}

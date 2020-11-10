<?php

declare (strict_types=1);
namespace _PhpScopera31d0d6ff47a\PackageVersions;

use _PhpScopera31d0d6ff47a\Composer\Composer;
use _PhpScopera31d0d6ff47a\Composer\Config;
use _PhpScopera31d0d6ff47a\Composer\EventDispatcher\EventSubscriberInterface;
use _PhpScopera31d0d6ff47a\Composer\IO\IOInterface;
use _PhpScopera31d0d6ff47a\Composer\Package\AliasPackage;
use _PhpScopera31d0d6ff47a\Composer\Package\Locker;
use _PhpScopera31d0d6ff47a\Composer\Package\PackageInterface;
use _PhpScopera31d0d6ff47a\Composer\Package\RootPackageInterface;
use _PhpScopera31d0d6ff47a\Composer\Plugin\PluginInterface;
use _PhpScopera31d0d6ff47a\Composer\Script\Event;
use _PhpScopera31d0d6ff47a\Composer\Script\ScriptEvents;
use Generator;
use RuntimeException;
use function array_key_exists;
use function array_merge;
use function chmod;
use function dirname;
use function file_exists;
use function file_put_contents;
use function iterator_to_array;
use function rename;
use function sprintf;
use function uniqid;
use function var_export;
final class Installer implements \_PhpScopera31d0d6ff47a\Composer\Plugin\PluginInterface, \_PhpScopera31d0d6ff47a\Composer\EventDispatcher\EventSubscriberInterface
{
    private static $generatedClassTemplate = <<<'PHP'
<?php

declare(strict_types=1);

namespace PackageVersions;

use OutOfBoundsException;

/**
 * This class is generated by composer/package-versions-deprecated, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 */
%s
{
    const ROOT_PACKAGE_NAME = '%s';
    /**
     * Array of all available composer packages.
     * Dont read this array from your calling code, but use the \PackageVersions\Versions::getVersion() method instead.
     *
     * @var array<string, string>
     * @internal
     */
    const VERSIONS          = %s;

    private function __construct()
    {
    }

    /**
     * @throws OutOfBoundsException If a version cannot be located.
     *
     * @psalm-param key-of<self::VERSIONS> $packageName
     * @psalm-pure
     */
    public static function getVersion(string $packageName) : string
    {
        if (isset(self::VERSIONS[$packageName])) {
            return self::VERSIONS[$packageName];
        }

        throw new OutOfBoundsException(
            'Required package "' . $packageName . '" is not installed: check your ./vendor/composer/installed.json and/or ./composer.lock files'
        );
    }
}

PHP;
    public function activate(\_PhpScopera31d0d6ff47a\Composer\Composer $composer, \_PhpScopera31d0d6ff47a\Composer\IO\IOInterface $io)
    {
        // Nothing to do here, as all features are provided through event listeners
    }
    public function deactivate(\_PhpScopera31d0d6ff47a\Composer\Composer $composer, \_PhpScopera31d0d6ff47a\Composer\IO\IOInterface $io)
    {
        // Nothing to do here, as all features are provided through event listeners
    }
    public function uninstall(\_PhpScopera31d0d6ff47a\Composer\Composer $composer, \_PhpScopera31d0d6ff47a\Composer\IO\IOInterface $io)
    {
        // Nothing to do here, as all features are provided through event listeners
    }
    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents() : array
    {
        return [\_PhpScopera31d0d6ff47a\Composer\Script\ScriptEvents::POST_AUTOLOAD_DUMP => 'dumpVersionsClass'];
    }
    /**
     * @throws RuntimeException
     */
    public static function dumpVersionsClass(\_PhpScopera31d0d6ff47a\Composer\Script\Event $composerEvent)
    {
        $composer = $composerEvent->getComposer();
        $rootPackage = $composer->getPackage();
        $versions = \iterator_to_array(self::getVersions($composer->getLocker(), $rootPackage));
        if (!\array_key_exists('composer/package-versions-deprecated', $versions)) {
            //plugin must be globally installed - we only want to generate versions for projects which specifically
            //require composer/package-versions-deprecated
            return;
        }
        $versionClass = self::generateVersionsClass($rootPackage->getName(), $versions);
        self::writeVersionClassToFile($versionClass, $composer, $composerEvent->getIO());
    }
    /**
     * @param string[] $versions
     */
    private static function generateVersionsClass(string $rootPackageName, array $versions) : string
    {
        return \sprintf(
            self::$generatedClassTemplate,
            'fin' . 'al ' . 'cla' . 'ss ' . 'Versions',
            // note: workaround for regex-based code parsers :-(
            $rootPackageName,
            \var_export($versions, \true)
        );
    }
    /**
     * @throws RuntimeException
     */
    private static function writeVersionClassToFile(string $versionClassSource, \_PhpScopera31d0d6ff47a\Composer\Composer $composer, \_PhpScopera31d0d6ff47a\Composer\IO\IOInterface $io)
    {
        $installPath = self::locateRootPackageInstallPath($composer->getConfig(), $composer->getPackage()) . '/src/PackageVersions/Versions.php';
        if (!\file_exists(\dirname($installPath))) {
            $io->write('<info>composer/package-versions-deprecated:</info> Package not found (probably scheduled for removal); generation of version class skipped.');
            return;
        }
        $io->write('<info>composer/package-versions-deprecated:</info> Generating version class...');
        $installPathTmp = $installPath . '_' . \uniqid('tmp', \true);
        \file_put_contents($installPathTmp, $versionClassSource);
        \chmod($installPathTmp, 0664);
        \rename($installPathTmp, $installPath);
        $io->write('<info>composer/package-versions-deprecated:</info> ...done generating version class');
        if (\version_compare(\_PhpScopera31d0d6ff47a\Composer\Plugin\PluginInterface::PLUGIN_API_VERSION, '2.0.0', '>=')) {
            $io->write('<info>composer/package-versions-deprecated:</info> <warning>You should rely on the Composer\\InstalledVersions class instead of this package as you are using Composer 2. You can require composer-runtime-api:^2 to ensure it is present.</warning>');
        }
    }
    /**
     * @throws RuntimeException
     */
    private static function locateRootPackageInstallPath(\_PhpScopera31d0d6ff47a\Composer\Config $composerConfig, \_PhpScopera31d0d6ff47a\Composer\Package\RootPackageInterface $rootPackage) : string
    {
        if (self::getRootPackageAlias($rootPackage)->getName() === 'composer/package-versions-deprecated') {
            return \dirname($composerConfig->get('vendor-dir'));
        }
        return $composerConfig->get('vendor-dir') . '/composer/package-versions-deprecated';
    }
    private static function getRootPackageAlias(\_PhpScopera31d0d6ff47a\Composer\Package\RootPackageInterface $rootPackage) : \_PhpScopera31d0d6ff47a\Composer\Package\PackageInterface
    {
        $package = $rootPackage;
        while ($package instanceof \_PhpScopera31d0d6ff47a\Composer\Package\AliasPackage) {
            $package = $package->getAliasOf();
        }
        return $package;
    }
    /**
     * @return Generator&string[]
     *
     * @psalm-return Generator<string, string>
     */
    private static function getVersions(\_PhpScopera31d0d6ff47a\Composer\Package\Locker $locker, \_PhpScopera31d0d6ff47a\Composer\Package\RootPackageInterface $rootPackage) : \Generator
    {
        $lockData = $locker->getLockData();
        $lockData['packages-dev'] = $lockData['packages-dev'] ?? [];
        foreach (\array_merge($lockData['packages'], $lockData['packages-dev']) as $package) {
            (yield $package['name'] => $package['version'] . '@' . ($package['source']['reference'] ?? $package['dist']['reference'] ?? ''));
        }
        foreach ($rootPackage->getReplaces() as $replace) {
            $version = $replace->getPrettyConstraint();
            if ($version === 'self.version') {
                $version = $rootPackage->getPrettyVersion();
            }
            (yield $replace->getTarget() => $version . '@' . $rootPackage->getSourceReference());
        }
        (yield $rootPackage->getName() => $rootPackage->getPrettyVersion() . '@' . $rootPackage->getSourceReference());
    }
}

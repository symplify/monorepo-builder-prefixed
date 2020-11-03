<?php

declare (strict_types=1);
namespace Symplify\MonorepoBuilder\Split\FileSystem;

use _PhpScoper437fa56c88e1\Nette\Utils\Strings;
use Symplify\MonorepoBuilder\Split\ValueObject\ConvertFormat;
use Symplify\MonorepoBuilder\ValueObject\Option;
use Symplify\PackageBuilder\Parameter\ParameterProvider;
use Symplify\PackageBuilder\Strings\StringFormatConverter;
use Symplify\SmartFileSystem\FileSystemGuard;
use Symplify\SmartFileSystem\SmartFileInfo;
/**
 * @see \Symplify\MonorepoBuilder\Split\Tests\FileSystem\DirectoryToRepositoryProvider\DirectoryToRepositoryProviderTest
 */
final class DirectoryToRepositoryProvider
{
    /**
     * @see https://regex101.com/r/BCPylL/1
     * @var string
     */
    private const ASTERISK_REGEX = '#\\*#';
    /**
     * @var FileSystemGuard
     */
    private $fileSystemGuard;
    /**
     * @var ParameterProvider
     */
    private $parameterProvider;
    /**
     * @var StringFormatConverter
     */
    private $stringFormatConverter;
    public function __construct(\Symplify\PackageBuilder\Parameter\ParameterProvider $parameterProvider, \Symplify\SmartFileSystem\FileSystemGuard $fileSystemGuard, \Symplify\PackageBuilder\Strings\StringFormatConverter $stringFormatConverter)
    {
        $this->fileSystemGuard = $fileSystemGuard;
        $this->parameterProvider = $parameterProvider;
        $this->stringFormatConverter = $stringFormatConverter;
    }
    /**
     * @return array<string, string>
     */
    public function provide() : array
    {
        $resolvedDirectoriesToRepository = [];
        $directoriesToRepositories = $this->parameterProvider->provideArrayParameter(\Symplify\MonorepoBuilder\ValueObject\Option::DIRECTORIES_TO_REPOSITORIES);
        foreach ($directoriesToRepositories as $directory => $repository) {
            if (!\_PhpScoper437fa56c88e1\Nette\Utils\Strings::contains($directory, '*')) {
                $this->ensureDirectoryExists($directory);
                $resolvedDirectoriesToRepository[$directory] = $repository;
                continue;
            }
            $fnmatchResolvedDirectoriesToRepository = $this->resolveAsteriskDirectory($directory, $repository);
            $resolvedDirectoriesToRepository = \array_merge($resolvedDirectoriesToRepository, $fnmatchResolvedDirectoriesToRepository);
        }
        return $this->relativizeDirectories($resolvedDirectoriesToRepository);
    }
    private function ensureDirectoryExists(string $directory) : void
    {
        $extractMessage = \sprintf('Check "%s" parameter in your config.', \Symplify\MonorepoBuilder\ValueObject\Option::class . '::DIRECTORIES_TO_REPOSITORIES');
        $this->fileSystemGuard->ensureDirectoryExists($directory, $extractMessage);
    }
    /**
     * @return string[]
     */
    private function resolveAsteriskDirectory(string $directory, string $repository) : array
    {
        $resolvedDirectoriesToRepository = [];
        // fnmatch
        $patternWithoutAsterisk = (string) \trim($directory, '*');
        $foundDirectories = (array) \glob($directory);
        foreach ($foundDirectories as $foundDirectory) {
            /** @var string $foundDirectory */
            $exclusiveName = (string) \_PhpScoper437fa56c88e1\Nette\Utils\Strings::after((string) $foundDirectory, $patternWithoutAsterisk);
            $exclusiveName = $this->convertRepositoryToDesiredFormat($exclusiveName);
            $targetRepository = \_PhpScoper437fa56c88e1\Nette\Utils\Strings::replace($repository, self::ASTERISK_REGEX, $exclusiveName);
            $resolvedDirectoriesToRepository[$foundDirectory] = $targetRepository;
        }
        return $resolvedDirectoriesToRepository;
    }
    /**
     * @param array<string, string> $directoriesToRepositories
     * @return array<string, string>
     */
    private function relativizeDirectories(array $directoriesToRepositories) : array
    {
        $relativeDirectoriesToRepositories = [];
        foreach ($directoriesToRepositories as $directory => $repository) {
            $directoryFileInfo = new \Symplify\SmartFileSystem\SmartFileInfo($directory);
            $relativeDirectory = $directoryFileInfo->getRelativeFilePathFromCwd();
            $relativeDirectoriesToRepositories[$relativeDirectory] = $repository;
        }
        return $relativeDirectoriesToRepositories;
    }
    private function convertRepositoryToDesiredFormat(string $repository) : string
    {
        $convertFormat = $this->parameterProvider->provideStringParameter(\Symplify\MonorepoBuilder\ValueObject\Option::DIRECTORIES_TO_REPOSITORIES_CONVERT_FORMAT);
        if ($convertFormat === \Symplify\MonorepoBuilder\Split\ValueObject\ConvertFormat::PASCAL_CASE_TO_KEBAB_CASE) {
            return $this->stringFormatConverter->camelCaseToDashed($repository);
        }
        return $repository;
    }
}

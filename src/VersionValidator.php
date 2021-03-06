<?php

declare (strict_types=1);
namespace Symplify\MonorepoBuilder;

use Symplify\ComposerJsonManipulator\FileSystem\JsonFileManager;
use Symplify\ComposerJsonManipulator\ValueObject\ComposerJsonSection;
use Symplify\MonorepoBuilder\Merge\Configuration\ModifyingComposerJsonProvider;
use Symplify\MonorepoBuilder\ValueObject\File;
use Symplify\SmartFileSystem\SmartFileInfo;
/**
 * @see \Symplify\MonorepoBuilder\Tests\VersionValidator\VersionValidatorTest
 */
final class VersionValidator
{
    /**
     * @var string[]
     */
    private const SECTIONS = [\Symplify\ComposerJsonManipulator\ValueObject\ComposerJsonSection::REQUIRE, \Symplify\ComposerJsonManipulator\ValueObject\ComposerJsonSection::REQUIRE_DEV];
    /**
     * @var JsonFileManager
     */
    private $jsonFileManager;
    /**
     * @var ModifyingComposerJsonProvider
     */
    private $modifyingComposerJsonProvider;
    public function __construct(\Symplify\ComposerJsonManipulator\FileSystem\JsonFileManager $jsonFileManager, \Symplify\MonorepoBuilder\Merge\Configuration\ModifyingComposerJsonProvider $modifyingComposerJsonProvider)
    {
        $this->jsonFileManager = $jsonFileManager;
        $this->modifyingComposerJsonProvider = $modifyingComposerJsonProvider;
    }
    /**
     * @param SmartFileInfo[] $smartFileInfos
     * @return string[][]
     */
    public function findConflictingPackageVersionsInFileInfos(array $smartFileInfos) : array
    {
        $packageVersionsPerFile = [];
        $packageVersionsPerFile = $this->appendAppendingComposerJson($packageVersionsPerFile);
        foreach ($smartFileInfos as $smartFileInfo) {
            $json = $this->jsonFileManager->loadFromFileInfo($smartFileInfo);
            foreach (self::SECTIONS as $section) {
                if (!isset($json[$section])) {
                    continue;
                }
                foreach ($json[$section] as $packageName => $packageVersion) {
                    $filePath = $smartFileInfo->getRelativeFilePathFromCwd();
                    $packageVersionsPerFile[$packageName][$filePath] = $packageVersion;
                }
            }
        }
        return $this->filterConflictingPackageVersionsPerFile($packageVersionsPerFile);
    }
    /**
     * @param mixed[] $packageVersionsPerFile
     * @return mixed[]
     */
    private function appendAppendingComposerJson(array $packageVersionsPerFile) : array
    {
        $appendingComposerJson = $this->modifyingComposerJsonProvider->getAppendingComposerJson();
        if ($appendingComposerJson === null) {
            return $packageVersionsPerFile;
        }
        $requires = $appendingComposerJson->getRequire();
        foreach ($requires as $packageName => $packageVersion) {
            $packageVersionsPerFile[$packageName][\Symplify\MonorepoBuilder\ValueObject\File::CONFIG] = $packageVersion;
        }
        $requiredevs = $appendingComposerJson->getRequireDev();
        foreach ($requiredevs as $packageName => $packageVersion) {
            $packageVersionsPerFile[$packageName][\Symplify\MonorepoBuilder\ValueObject\File::CONFIG] = $packageVersion;
        }
        return $packageVersionsPerFile;
    }
    /**
     * @param mixed[] $packageVersionsPerFile
     * @return mixed[]
     */
    private function filterConflictingPackageVersionsPerFile(array $packageVersionsPerFile) : array
    {
        $conflictingPackageVersionsPerFile = [];
        foreach ($packageVersionsPerFile as $packageName => $filesToVersions) {
            $uniqueVersions = \array_unique($filesToVersions);
            if (\count($uniqueVersions) <= 1) {
                continue;
            }
            // sort by versions to make more readable
            \asort($filesToVersions);
            $conflictingPackageVersionsPerFile[$packageName] = $filesToVersions;
        }
        return $conflictingPackageVersionsPerFile;
    }
}

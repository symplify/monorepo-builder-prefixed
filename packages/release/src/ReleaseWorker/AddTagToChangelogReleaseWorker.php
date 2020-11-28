<?php

declare (strict_types=1);
namespace Symplify\MonorepoBuilder\Release\ReleaseWorker;

use _PhpScoperbe77f3b0e77d\Nette\Utils\DateTime;
use _PhpScoperbe77f3b0e77d\Nette\Utils\Strings;
use _PhpScoperbe77f3b0e77d\PharIo\Version\Version;
use Symplify\MonorepoBuilder\Release\Contract\ReleaseWorker\ReleaseWorkerInterface;
use Symplify\SmartFileSystem\SmartFileSystem;
final class AddTagToChangelogReleaseWorker implements \Symplify\MonorepoBuilder\Release\Contract\ReleaseWorker\ReleaseWorkerInterface
{
    /**
     * @var string
     * @see https://regex101.com/r/5KOvEb/1
     */
    private const UNRELEASED_HEADLINE_REGEX = '#\\#\\# Unreleased#';
    /**
     * @var SmartFileSystem
     */
    private $smartFileSystem;
    public function __construct(\Symplify\SmartFileSystem\SmartFileSystem $smartFileSystem)
    {
        $this->smartFileSystem = $smartFileSystem;
    }
    public function work(\_PhpScoperbe77f3b0e77d\PharIo\Version\Version $version) : void
    {
        $changelogFilePath = \getcwd() . '/CHANGELOG.md';
        if (!\file_exists($changelogFilePath)) {
            return;
        }
        $newHeadline = $this->createNewHeadline($version);
        $changelogFileContent = $this->smartFileSystem->readFile($changelogFilePath);
        $changelogFileContent = \_PhpScoperbe77f3b0e77d\Nette\Utils\Strings::replace($changelogFileContent, self::UNRELEASED_HEADLINE_REGEX, '## ' . $newHeadline);
        $this->smartFileSystem->dumpFile($changelogFilePath, $changelogFileContent);
    }
    public function getDescription(\_PhpScoperbe77f3b0e77d\PharIo\Version\Version $version) : string
    {
        $newHeadline = $this->createNewHeadline($version);
        return \sprintf('Change "Unreleased" in `CHANGELOG.md` to "%s"', $newHeadline);
    }
    private function createNewHeadline(\_PhpScoperbe77f3b0e77d\PharIo\Version\Version $version) : string
    {
        $dateTime = new \_PhpScoperbe77f3b0e77d\Nette\Utils\DateTime();
        return $version->getVersionString() . ' - ' . $dateTime->format('Y-m-d');
    }
}

<?php

declare (strict_types=1);
namespace Symplify\MonorepoBuilder\Release\ReleaseWorker;

use _PhpScoper43009128da38\PharIo\Version\Version;
final class SetCurrentMutualDependenciesReleaseWorker extends \Symplify\MonorepoBuilder\Release\ReleaseWorker\AbstractMutualDependencyReleaseWorker
{
    public function work(\_PhpScoper43009128da38\PharIo\Version\Version $version) : void
    {
        $versionInString = $this->versionUtils->getRequiredFormat($version);
        $this->dependencyUpdater->updateFileInfosWithPackagesAndVersion($this->composerJsonProvider->getPackagesComposerFileInfos(), $this->packageNamesProvider->provide(), $versionInString);
        // give time to propagate values before commit
        \sleep(1);
    }
    public function getDescription(\_PhpScoper43009128da38\PharIo\Version\Version $version) : string
    {
        $versionInString = $this->versionUtils->getRequiredFormat($version);
        return \sprintf('Set packages mutual dependencies to "%s" version', $versionInString);
    }
}

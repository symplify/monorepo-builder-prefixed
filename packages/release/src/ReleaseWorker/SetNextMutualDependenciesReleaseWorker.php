<?php

declare (strict_types=1);
namespace Symplify\MonorepoBuilder\Release\ReleaseWorker;

use _PhpScoper36281e29f54f\PharIo\Version\Version;
final class SetNextMutualDependenciesReleaseWorker extends \Symplify\MonorepoBuilder\Release\ReleaseWorker\AbstractMutualDependencyReleaseWorker
{
    public function work(\_PhpScoper36281e29f54f\PharIo\Version\Version $version) : void
    {
        $versionInString = $this->versionUtils->getRequiredNextFormat($version);
        $this->dependencyUpdater->updateFileInfosWithPackagesAndVersion($this->composerJsonProvider->getPackagesComposerFileInfos(), $this->packageNamesProvider->provide(), $versionInString);
    }
    public function getDescription(\_PhpScoper36281e29f54f\PharIo\Version\Version $version) : string
    {
        $versionInString = $this->versionUtils->getRequiredNextFormat($version);
        return \sprintf('Set packages mutual dependencies to "%s" (alias of dev version)', $versionInString);
    }
}

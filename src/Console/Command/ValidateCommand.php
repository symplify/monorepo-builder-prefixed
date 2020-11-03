<?php

declare (strict_types=1);
namespace Symplify\MonorepoBuilder\Console\Command;

use _PhpScoper2a80719fd449\Symfony\Component\Console\Command\Command;
use _PhpScoper2a80719fd449\Symfony\Component\Console\Input\InputInterface;
use _PhpScoper2a80719fd449\Symfony\Component\Console\Output\OutputInterface;
use _PhpScoper2a80719fd449\Symfony\Component\Console\Style\SymfonyStyle;
use Symplify\MonorepoBuilder\Console\Reporter\ConflictingPackageVersionsReporter;
use Symplify\MonorepoBuilder\FileSystem\ComposerJsonProvider;
use Symplify\MonorepoBuilder\VersionValidator;
use Symplify\PackageBuilder\Console\Command\CommandNaming;
use Symplify\PackageBuilder\Console\ShellCode;
final class ValidateCommand extends \_PhpScoper2a80719fd449\Symfony\Component\Console\Command\Command
{
    /**
     * @var SymfonyStyle
     */
    private $symfonyStyle;
    /**
     * @var VersionValidator
     */
    private $versionValidator;
    /**
     * @var ComposerJsonProvider
     */
    private $composerJsonProvider;
    /**
     * @var ConflictingPackageVersionsReporter
     */
    private $conflictingPackageVersionsReporter;
    public function __construct(\_PhpScoper2a80719fd449\Symfony\Component\Console\Style\SymfonyStyle $symfonyStyle, \Symplify\MonorepoBuilder\FileSystem\ComposerJsonProvider $composerJsonProvider, \Symplify\MonorepoBuilder\VersionValidator $versionValidator, \Symplify\MonorepoBuilder\Console\Reporter\ConflictingPackageVersionsReporter $conflictingPackageVersionsReporter)
    {
        parent::__construct();
        $this->symfonyStyle = $symfonyStyle;
        $this->versionValidator = $versionValidator;
        $this->composerJsonProvider = $composerJsonProvider;
        $this->conflictingPackageVersionsReporter = $conflictingPackageVersionsReporter;
    }
    protected function configure() : void
    {
        $this->setName(\Symplify\PackageBuilder\Console\Command\CommandNaming::classToName(self::class));
        $this->setDescription('Validates synchronized versions in "composer.json" in all found packages.');
    }
    protected function execute(\_PhpScoper2a80719fd449\Symfony\Component\Console\Input\InputInterface $input, \_PhpScoper2a80719fd449\Symfony\Component\Console\Output\OutputInterface $output) : int
    {
        $conflictingPackageVersions = $this->versionValidator->findConflictingPackageVersionsInFileInfos($this->composerJsonProvider->getRootAndPackageFileInfos());
        if ($conflictingPackageVersions === []) {
            $this->symfonyStyle->success('All packages "composer.json" files use same package versions.');
            return \Symplify\PackageBuilder\Console\ShellCode::SUCCESS;
        }
        $this->conflictingPackageVersionsReporter->report($conflictingPackageVersions);
        return \Symplify\PackageBuilder\Console\ShellCode::ERROR;
    }
}
<?php

declare (strict_types=1);
namespace Symplify\MonorepoBuilder\Split\Process;

use _PhpScoper2a80719fd449\Nette\Utils\Strings;
use _PhpScoper2a80719fd449\Symfony\Component\Process\Process;
use Symplify\MonorepoBuilder\Split\Configuration\RepositoryGuard;
use Symplify\MonorepoBuilder\ValueObject\Option;
use Symplify\PackageBuilder\Parameter\ParameterProvider;
use Symplify\SmartFileSystem\SmartFileSystem;
/**
 * @see \Symplify\MonorepoBuilder\Split\Tests\Process\ProcessFactoryTest
 */
final class ProcessFactory
{
    /**
     * @var string
     */
    private const SUBSPLIT_BASH_FILE = __DIR__ . '/../../bash/subsplit.sh';
    /**
     * @var string
     */
    private $repository;
    /**
     * @var string
     */
    private $subsplitCacheDirectory;
    /**
     * @var RepositoryGuard
     */
    private $repositoryGuard;
    /**
     * @var SmartFileSystem
     */
    private $smartFileSystem;
    public function __construct(\Symplify\MonorepoBuilder\Split\Configuration\RepositoryGuard $repositoryGuard, \Symplify\SmartFileSystem\SmartFileSystem $smartFileSystem, \Symplify\PackageBuilder\Parameter\ParameterProvider $parameterProvider)
    {
        $this->repositoryGuard = $repositoryGuard;
        $this->subsplitCacheDirectory = $parameterProvider->provideStringParameter(\Symplify\MonorepoBuilder\ValueObject\Option::SUBSPLIT_CACHE_DIRECTORY);
        $this->repository = $parameterProvider->provideStringParameter(\Symplify\MonorepoBuilder\ValueObject\Option::REPOSITORY);
        $this->smartFileSystem = $smartFileSystem;
    }
    public function createSubsplit(?string $theMostRecentTag, string $directory, string $remoteRepository, string $branch) : \_PhpScoper2a80719fd449\Symfony\Component\Process\Process
    {
        $this->repositoryGuard->ensureIsRepository($remoteRepository);
        $commandLine = [\realpath(self::SUBSPLIT_BASH_FILE), \sprintf('--from-directory=%s', $directory), \sprintf('--to-repository=%s', $remoteRepository), \sprintf('--branch=%s', $branch), $theMostRecentTag ? \sprintf('--tag=%s', $theMostRecentTag) : '', \sprintf('--repository=%s', $this->repository)];
        return $this->createProcessFromCommandLine($commandLine, $directory);
    }
    /**
     * @param mixed[] $commandLine
     */
    private function createProcessFromCommandLine(array $commandLine, string $directory) : \_PhpScoper2a80719fd449\Symfony\Component\Process\Process
    {
        $directory = $this->subsplitCacheDirectory . \DIRECTORY_SEPARATOR . \_PhpScoper2a80719fd449\Nette\Utils\Strings::webalize($directory);
        $this->smartFileSystem->remove($directory);
        $this->smartFileSystem->mkdir($directory);
        return new \_PhpScoper2a80719fd449\Symfony\Component\Process\Process($commandLine, $directory, null, null, null);
    }
}
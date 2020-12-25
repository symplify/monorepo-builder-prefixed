<?php

declare (strict_types=1);
namespace Symplify\MonorepoBuilder\Git;

use _PhpScoperef96225926e2\Symfony\Component\Process\Process;
use Symplify\MonorepoBuilder\Utils\VersionUtils;
final class ExpectedAliasResolver
{
    /**
     * @var VersionUtils
     */
    private $versionUtils;
    public function __construct(\Symplify\MonorepoBuilder\Utils\VersionUtils $versionUtils)
    {
        $this->versionUtils = $versionUtils;
    }
    public function resolve() : string
    {
        $process = new \_PhpScoperef96225926e2\Symfony\Component\Process\Process(['git', 'describe', '--abbrev=0', '--tags']);
        $process->run();
        $output = $process->getOutput();
        return $this->versionUtils->getNextAliasFormat($output);
    }
}

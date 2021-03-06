<?php

// decoupled in own "*.php" file, so ECS, Rector and PHPStan works out of the box here
declare (strict_types=1);
namespace _PhpScoper36281e29f54f;

use _PhpScoper36281e29f54f\Symfony\Component\Console\Input\ArgvInput;
use Symplify\MonorepoBuilder\HttpKernel\MonorepoBuilderKernel;
use Symplify\MonorepoBuilder\ValueObject\File;
use Symplify\SetConfigResolver\ConfigResolver;
use Symplify\SymplifyKernel\ValueObject\KernelBootAndApplicationRun;
# 1. autoload
$possibleAutoloadPaths = [
    // after split package
    __DIR__ . '/../vendor/autoload.php',
    // dependency
    __DIR__ . '/../../../autoload.php',
    // monorepo
    __DIR__ . '/../../../vendor/autoload.php',
];
foreach ($possibleAutoloadPaths as $possibleAutoloadPath) {
    if (\file_exists($possibleAutoloadPath)) {
        require_once $possibleAutoloadPath;
        break;
    }
}
$configFileInfos = [];
$configResolver = new \Symplify\SetConfigResolver\ConfigResolver();
$inputConfigFileInfo = $configResolver->resolveFromInputWithFallback(new \_PhpScoper36281e29f54f\Symfony\Component\Console\Input\ArgvInput(), [\Symplify\MonorepoBuilder\ValueObject\File::CONFIG]);
if ($inputConfigFileInfo !== null) {
    $configFileInfos[] = $inputConfigFileInfo;
}
$kernelBootAndApplicationRun = new \Symplify\SymplifyKernel\ValueObject\KernelBootAndApplicationRun(\Symplify\MonorepoBuilder\HttpKernel\MonorepoBuilderKernel::class, $configFileInfos);
$kernelBootAndApplicationRun->run();

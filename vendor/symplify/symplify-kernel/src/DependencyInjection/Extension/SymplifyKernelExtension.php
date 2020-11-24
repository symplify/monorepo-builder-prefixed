<?php

declare (strict_types=1);
namespace Symplify\SymplifyKernel\DependencyInjection\Extension;

use _PhpScoper674b08d66902\Symfony\Component\Config\FileLocator;
use _PhpScoper674b08d66902\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScoper674b08d66902\Symfony\Component\DependencyInjection\Extension\Extension;
use _PhpScoper674b08d66902\Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
final class SymplifyKernelExtension extends \_PhpScoper674b08d66902\Symfony\Component\DependencyInjection\Extension\Extension
{
    public function load(array $configs, \_PhpScoper674b08d66902\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder) : void
    {
        $phpFileLoader = new \_PhpScoper674b08d66902\Symfony\Component\DependencyInjection\Loader\PhpFileLoader($containerBuilder, new \_PhpScoper674b08d66902\Symfony\Component\Config\FileLocator(__DIR__ . '/../../../config'));
        $phpFileLoader->load('common-config.php');
    }
}

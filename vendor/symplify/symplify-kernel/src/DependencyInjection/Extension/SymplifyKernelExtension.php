<?php

declare (strict_types=1);
namespace Symplify\SymplifyKernel\DependencyInjection\Extension;

use _PhpScoperfec5e512f2f8\Symfony\Component\Config\FileLocator;
use _PhpScoperfec5e512f2f8\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScoperfec5e512f2f8\Symfony\Component\DependencyInjection\Extension\Extension;
use _PhpScoperfec5e512f2f8\Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
final class SymplifyKernelExtension extends \_PhpScoperfec5e512f2f8\Symfony\Component\DependencyInjection\Extension\Extension
{
    public function load(array $configs, \_PhpScoperfec5e512f2f8\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder) : void
    {
        $phpFileLoader = new \_PhpScoperfec5e512f2f8\Symfony\Component\DependencyInjection\Loader\PhpFileLoader($containerBuilder, new \_PhpScoperfec5e512f2f8\Symfony\Component\Config\FileLocator(__DIR__ . '/../../../config'));
        $phpFileLoader->load('common-config.php');
    }
}

<?php

declare (strict_types=1);
namespace Symplify\SymplifyKernel\DependencyInjection\Extension;

use _PhpScopere2a14c1f9852\Symfony\Component\Config\FileLocator;
use _PhpScopere2a14c1f9852\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScopere2a14c1f9852\Symfony\Component\DependencyInjection\Extension\Extension;
use _PhpScopere2a14c1f9852\Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
final class SymplifyKernelExtension extends \_PhpScopere2a14c1f9852\Symfony\Component\DependencyInjection\Extension\Extension
{
    public function load(array $configs, \_PhpScopere2a14c1f9852\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder) : void
    {
        $phpFileLoader = new \_PhpScopere2a14c1f9852\Symfony\Component\DependencyInjection\Loader\PhpFileLoader($containerBuilder, new \_PhpScopere2a14c1f9852\Symfony\Component\Config\FileLocator(__DIR__ . '/../../../config'));
        $phpFileLoader->load('common-config.php');
    }
}

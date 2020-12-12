<?php

declare (strict_types=1);
namespace Symplify\SymplifyKernel\DependencyInjection\Extension;

use _PhpScoperd72531165ef5\Symfony\Component\Config\FileLocator;
use _PhpScoperd72531165ef5\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScoperd72531165ef5\Symfony\Component\DependencyInjection\Extension\Extension;
use _PhpScoperd72531165ef5\Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
final class SymplifyKernelExtension extends \_PhpScoperd72531165ef5\Symfony\Component\DependencyInjection\Extension\Extension
{
    public function load(array $configs, \_PhpScoperd72531165ef5\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder) : void
    {
        $phpFileLoader = new \_PhpScoperd72531165ef5\Symfony\Component\DependencyInjection\Loader\PhpFileLoader($containerBuilder, new \_PhpScoperd72531165ef5\Symfony\Component\Config\FileLocator(__DIR__ . '/../../../config'));
        $phpFileLoader->load('common-config.php');
    }
}

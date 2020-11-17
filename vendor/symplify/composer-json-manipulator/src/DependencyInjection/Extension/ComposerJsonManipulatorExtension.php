<?php

declare (strict_types=1);
namespace Symplify\ComposerJsonManipulator\DependencyInjection\Extension;

use _PhpScoper55b61aca61e8\Symfony\Component\Config\FileLocator;
use _PhpScoper55b61aca61e8\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScoper55b61aca61e8\Symfony\Component\DependencyInjection\Extension\Extension;
use _PhpScoper55b61aca61e8\Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
final class ComposerJsonManipulatorExtension extends \_PhpScoper55b61aca61e8\Symfony\Component\DependencyInjection\Extension\Extension
{
    public function load(array $configs, \_PhpScoper55b61aca61e8\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder) : void
    {
        $phpFileLoader = new \_PhpScoper55b61aca61e8\Symfony\Component\DependencyInjection\Loader\PhpFileLoader($containerBuilder, new \_PhpScoper55b61aca61e8\Symfony\Component\Config\FileLocator(__DIR__ . '/../../../config'));
        $phpFileLoader->load('config.php');
    }
}

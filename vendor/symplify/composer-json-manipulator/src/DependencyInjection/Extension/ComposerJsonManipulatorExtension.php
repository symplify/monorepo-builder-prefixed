<?php

declare (strict_types=1);
namespace Symplify\ComposerJsonManipulator\DependencyInjection\Extension;

use _PhpScoperf0aae7819675\Symfony\Component\Config\FileLocator;
use _PhpScoperf0aae7819675\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScoperf0aae7819675\Symfony\Component\DependencyInjection\Extension\Extension;
use _PhpScoperf0aae7819675\Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
final class ComposerJsonManipulatorExtension extends \_PhpScoperf0aae7819675\Symfony\Component\DependencyInjection\Extension\Extension
{
    public function load(array $configs, \_PhpScoperf0aae7819675\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder) : void
    {
        $phpFileLoader = new \_PhpScoperf0aae7819675\Symfony\Component\DependencyInjection\Loader\PhpFileLoader($containerBuilder, new \_PhpScoperf0aae7819675\Symfony\Component\Config\FileLocator(__DIR__ . '/../../../config'));
        $phpFileLoader->load('config.php');
    }
}

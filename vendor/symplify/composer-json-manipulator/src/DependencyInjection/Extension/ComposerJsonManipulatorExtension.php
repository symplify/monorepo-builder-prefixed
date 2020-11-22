<?php

declare (strict_types=1);
namespace Symplify\ComposerJsonManipulator\DependencyInjection\Extension;

use _PhpScoper29aa9f1ba53d\Symfony\Component\Config\FileLocator;
use _PhpScoper29aa9f1ba53d\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScoper29aa9f1ba53d\Symfony\Component\DependencyInjection\Extension\Extension;
use _PhpScoper29aa9f1ba53d\Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
final class ComposerJsonManipulatorExtension extends \_PhpScoper29aa9f1ba53d\Symfony\Component\DependencyInjection\Extension\Extension
{
    public function load(array $configs, \_PhpScoper29aa9f1ba53d\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder) : void
    {
        $phpFileLoader = new \_PhpScoper29aa9f1ba53d\Symfony\Component\DependencyInjection\Loader\PhpFileLoader($containerBuilder, new \_PhpScoper29aa9f1ba53d\Symfony\Component\Config\FileLocator(__DIR__ . '/../../../config'));
        $phpFileLoader->load('config.php');
    }
}

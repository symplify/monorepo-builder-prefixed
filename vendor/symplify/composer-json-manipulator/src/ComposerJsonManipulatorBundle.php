<?php

declare (strict_types=1);
namespace Symplify\ComposerJsonManipulator;

use _PhpScoper8a4bdaafa6ec\Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use _PhpScoper8a4bdaafa6ec\Symfony\Component\HttpKernel\Bundle\Bundle;
use Symplify\ComposerJsonManipulator\DependencyInjection\Extension\ComposerJsonManipulatorExtension;
final class ComposerJsonManipulatorBundle extends \_PhpScoper8a4bdaafa6ec\Symfony\Component\HttpKernel\Bundle\Bundle
{
    protected function createContainerExtension() : ?\_PhpScoper8a4bdaafa6ec\Symfony\Component\DependencyInjection\Extension\ExtensionInterface
    {
        return new \Symplify\ComposerJsonManipulator\DependencyInjection\Extension\ComposerJsonManipulatorExtension();
    }
}

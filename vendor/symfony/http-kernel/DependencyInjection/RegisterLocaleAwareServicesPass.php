<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper540e5a7ff813\Symfony\Component\HttpKernel\DependencyInjection;

use _PhpScoper540e5a7ff813\Symfony\Component\DependencyInjection\Argument\IteratorArgument;
use _PhpScoper540e5a7ff813\Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use _PhpScoper540e5a7ff813\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScoper540e5a7ff813\Symfony\Component\DependencyInjection\Reference;
/**
 * Register all services that have the "kernel.locale_aware" tag into the listener.
 *
 * @author Pierre Bobiet <pierrebobiet@gmail.com>
 */
class RegisterLocaleAwareServicesPass implements \_PhpScoper540e5a7ff813\Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface
{
    private $listenerServiceId;
    private $localeAwareTag;
    public function __construct(string $listenerServiceId = 'locale_aware_listener', string $localeAwareTag = 'kernel.locale_aware')
    {
        $this->listenerServiceId = $listenerServiceId;
        $this->localeAwareTag = $localeAwareTag;
    }
    public function process(\_PhpScoper540e5a7ff813\Symfony\Component\DependencyInjection\ContainerBuilder $container)
    {
        if (!$container->hasDefinition($this->listenerServiceId)) {
            return;
        }
        $services = [];
        foreach ($container->findTaggedServiceIds($this->localeAwareTag) as $id => $tags) {
            $services[] = new \_PhpScoper540e5a7ff813\Symfony\Component\DependencyInjection\Reference($id);
        }
        if (!$services) {
            $container->removeDefinition($this->listenerServiceId);
            return;
        }
        $container->getDefinition($this->listenerServiceId)->setArgument(0, new \_PhpScoper540e5a7ff813\Symfony\Component\DependencyInjection\Argument\IteratorArgument($services));
    }
}

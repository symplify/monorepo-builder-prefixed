<?php

declare (strict_types=1);
namespace Symplify\PackageBuilder\DependencyInjection;

use _PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\Definition;
use Symplify\PackageBuilder\Exception\DependencyInjection\DefinitionForTypeNotFoundException;
use Throwable;
/**
 * @see \Symplify\PackageBuilder\Tests\DependencyInjection\DefinitionFinderTest
 */
final class DefinitionFinder
{
    /**
     * @return Definition[]
     */
    public function findAllByType(\_PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder, string $type) : array
    {
        $definitions = [];
        $containerBuilderDefinitions = $containerBuilder->getDefinitions();
        foreach ($containerBuilderDefinitions as $name => $definition) {
            $class = $definition->getClass() ?: $name;
            if (!$this->isClassExists($class)) {
                continue;
            }
            if (\is_a($class, $type, \true)) {
                $definitions[$name] = $definition;
            }
        }
        return $definitions;
    }
    public function getByType(\_PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder, string $type) : \_PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\Definition
    {
        $definition = $this->getByTypeIfExists($containerBuilder, $type);
        if ($definition !== null) {
            return $definition;
        }
        throw new \Symplify\PackageBuilder\Exception\DependencyInjection\DefinitionForTypeNotFoundException(\sprintf('Definition for type "%s" was not found.', $type));
    }
    public function getByTypeIfExists(\_PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder, string $type) : ?\_PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\Definition
    {
        $containerBuilderDefinitions = $containerBuilder->getDefinitions();
        foreach ($containerBuilderDefinitions as $name => $definition) {
            $class = $definition->getClass() ?: $name;
            if (!$this->isClassExists($class)) {
                continue;
            }
            if (\is_a($class, $type, \true)) {
                return $definition;
            }
        }
        return null;
    }
    private function isClassExists(?string $class) : bool
    {
        try {
            return \is_string($class) && \class_exists($class);
        } catch (\Throwable $throwable) {
            return \false;
        }
    }
}

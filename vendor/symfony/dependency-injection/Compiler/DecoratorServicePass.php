<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperaf523e5605cc\Symfony\Component\DependencyInjection\Compiler;

use _PhpScoperaf523e5605cc\Symfony\Component\DependencyInjection\Alias;
use _PhpScoperaf523e5605cc\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScoperaf523e5605cc\Symfony\Component\DependencyInjection\ContainerInterface;
use _PhpScoperaf523e5605cc\Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use _PhpScoperaf523e5605cc\Symfony\Component\DependencyInjection\Reference;
/**
 * Overwrites a service but keeps the overridden one.
 *
 * @author Christophe Coevoet <stof@notk.org>
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Diego Saint Esteben <diego@saintesteben.me>
 */
class DecoratorServicePass extends \_PhpScoperaf523e5605cc\Symfony\Component\DependencyInjection\Compiler\AbstractRecursivePass
{
    private $innerId = '.inner';
    public function __construct(?string $innerId = '.inner')
    {
        $this->innerId = $innerId;
    }
    public function process(\_PhpScoperaf523e5605cc\Symfony\Component\DependencyInjection\ContainerBuilder $container)
    {
        $definitions = new \SplPriorityQueue();
        $order = \PHP_INT_MAX;
        foreach ($container->getDefinitions() as $id => $definition) {
            if (!($decorated = $definition->getDecoratedService())) {
                continue;
            }
            $definitions->insert([$id, $definition], [$decorated[2], --$order]);
        }
        $decoratingDefinitions = [];
        foreach ($definitions as list($id, $definition)) {
            $decoratedService = $definition->getDecoratedService();
            list($inner, $renamedId) = $decoratedService;
            $invalidBehavior = $decoratedService[3] ?? \_PhpScoperaf523e5605cc\Symfony\Component\DependencyInjection\ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE;
            $definition->setDecoratedService(null);
            if (!$renamedId) {
                $renamedId = $id . '.inner';
            }
            $this->currentId = $renamedId;
            $this->processValue($definition);
            $definition->innerServiceId = $renamedId;
            $definition->decorationOnInvalid = $invalidBehavior;
            // we create a new alias/service for the service we are replacing
            // to be able to reference it in the new one
            if ($container->hasAlias($inner)) {
                $alias = $container->getAlias($inner);
                $public = $alias->isPublic();
                $private = $alias->isPrivate();
                $container->setAlias($renamedId, new \_PhpScoperaf523e5605cc\Symfony\Component\DependencyInjection\Alias((string) $alias, \false));
            } elseif ($container->hasDefinition($inner)) {
                $decoratedDefinition = $container->getDefinition($inner);
                $public = $decoratedDefinition->isPublic();
                $private = $decoratedDefinition->isPrivate();
                $decoratedDefinition->setPublic(\false);
                $container->setDefinition($renamedId, $decoratedDefinition);
                $decoratingDefinitions[$inner] = $decoratedDefinition;
            } elseif (\_PhpScoperaf523e5605cc\Symfony\Component\DependencyInjection\ContainerInterface::IGNORE_ON_INVALID_REFERENCE === $invalidBehavior) {
                $container->removeDefinition($id);
                continue;
            } elseif (\_PhpScoperaf523e5605cc\Symfony\Component\DependencyInjection\ContainerInterface::NULL_ON_INVALID_REFERENCE === $invalidBehavior) {
                $public = $definition->isPublic();
                $private = $definition->isPrivate();
            } else {
                throw new \_PhpScoperaf523e5605cc\Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException($inner, $id);
            }
            if (isset($decoratingDefinitions[$inner])) {
                $decoratingDefinition = $decoratingDefinitions[$inner];
                $decoratingTags = $decoratingDefinition->getTags();
                $resetTags = [];
                if (isset($decoratingTags['container.service_locator'])) {
                    // container.service_locator has special logic and it must not be transferred out to decorators
                    $resetTags = ['container.service_locator' => $decoratingTags['container.service_locator']];
                    unset($decoratingTags['container.service_locator']);
                }
                $definition->setTags(\array_merge($decoratingTags, $definition->getTags()));
                $decoratingDefinition->setTags($resetTags);
                $decoratingDefinitions[$inner] = $definition;
            }
            $container->setAlias($inner, $id)->setPublic($public)->setPrivate($private);
        }
    }
    protected function processValue($value, bool $isRoot = \false)
    {
        if ($value instanceof \_PhpScoperaf523e5605cc\Symfony\Component\DependencyInjection\Reference && $this->innerId === (string) $value) {
            return new \_PhpScoperaf523e5605cc\Symfony\Component\DependencyInjection\Reference($this->currentId, $value->getInvalidBehavior());
        }
        return parent::processValue($value, $isRoot);
    }
}

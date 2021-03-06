<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper36281e29f54f\Symfony\Component\HttpKernel\DependencyInjection;

use _PhpScoper36281e29f54f\Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use _PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\ChildDefinition;
use _PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use _PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\Compiler\ServiceLocatorTagPass;
use _PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\ContainerAwareInterface;
use _PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\ContainerInterface;
use _PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use _PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\LazyProxy\ProxyHelper;
use _PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\Reference;
use _PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\TypedReference;
use _PhpScoper36281e29f54f\Symfony\Component\HttpFoundation\Request;
/**
 * Creates the service-locators required by ServiceValueResolver.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
class RegisterControllerArgumentLocatorsPass implements \_PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface
{
    private $resolverServiceId;
    private $controllerTag;
    private $controllerLocator;
    private $notTaggedControllerResolverServiceId;
    public function __construct(string $resolverServiceId = 'argument_resolver.service', string $controllerTag = 'controller.service_arguments', string $controllerLocator = 'argument_resolver.controller_locator', string $notTaggedControllerResolverServiceId = 'argument_resolver.not_tagged_controller')
    {
        $this->resolverServiceId = $resolverServiceId;
        $this->controllerTag = $controllerTag;
        $this->controllerLocator = $controllerLocator;
        $this->notTaggedControllerResolverServiceId = $notTaggedControllerResolverServiceId;
    }
    public function process(\_PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\ContainerBuilder $container)
    {
        if (\false === $container->hasDefinition($this->resolverServiceId) && \false === $container->hasDefinition($this->notTaggedControllerResolverServiceId)) {
            return;
        }
        $parameterBag = $container->getParameterBag();
        $controllers = [];
        foreach ($container->findTaggedServiceIds($this->controllerTag, \true) as $id => $tags) {
            $def = $container->getDefinition($id);
            $def->setPublic(\true);
            $class = $def->getClass();
            $autowire = $def->isAutowired();
            $bindings = $def->getBindings();
            // resolve service class, taking parent definitions into account
            while ($def instanceof \_PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\ChildDefinition) {
                $def = $container->findDefinition($def->getParent());
                $class = $class ?: $def->getClass();
                $bindings += $def->getBindings();
            }
            $class = $parameterBag->resolveValue($class);
            if (!($r = $container->getReflectionClass($class))) {
                throw new \_PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\Exception\InvalidArgumentException(\sprintf('Class "%s" used for service "%s" cannot be found.', $class, $id));
            }
            $isContainerAware = $r->implementsInterface(\_PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\ContainerAwareInterface::class) || \is_subclass_of($class, \_PhpScoper36281e29f54f\Symfony\Bundle\FrameworkBundle\Controller\AbstractController::class);
            // get regular public methods
            $methods = [];
            $arguments = [];
            foreach ($r->getMethods(\ReflectionMethod::IS_PUBLIC) as $r) {
                if ('setContainer' === $r->name && $isContainerAware) {
                    continue;
                }
                if (!$r->isConstructor() && !$r->isDestructor() && !$r->isAbstract()) {
                    $methods[\strtolower($r->name)] = [$r, $r->getParameters()];
                }
            }
            // validate and collect explicit per-actions and per-arguments service references
            foreach ($tags as $attributes) {
                if (!isset($attributes['action']) && !isset($attributes['argument']) && !isset($attributes['id'])) {
                    $autowire = \true;
                    continue;
                }
                foreach (['action', 'argument', 'id'] as $k) {
                    if (!isset($attributes[$k][0])) {
                        throw new \_PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\Exception\InvalidArgumentException(\sprintf('Missing "%s" attribute on tag "%s" %s for service "%s".', $k, $this->controllerTag, \json_encode($attributes, \JSON_UNESCAPED_UNICODE), $id));
                    }
                }
                if (!isset($methods[$action = \strtolower($attributes['action'])])) {
                    throw new \_PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\Exception\InvalidArgumentException(\sprintf('Invalid "action" attribute on tag "%s" for service "%s": no public "%s()" method found on class "%s".', $this->controllerTag, $id, $attributes['action'], $class));
                }
                list($r, $parameters) = $methods[$action];
                $found = \false;
                foreach ($parameters as $p) {
                    if ($attributes['argument'] === $p->name) {
                        if (!isset($arguments[$r->name][$p->name])) {
                            $arguments[$r->name][$p->name] = $attributes['id'];
                        }
                        $found = \true;
                        break;
                    }
                }
                if (!$found) {
                    throw new \_PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\Exception\InvalidArgumentException(\sprintf('Invalid "%s" tag for service "%s": method "%s()" has no "%s" argument on class "%s".', $this->controllerTag, $id, $r->name, $attributes['argument'], $class));
                }
            }
            foreach ($methods as list($r, $parameters)) {
                /** @var \ReflectionMethod $r */
                // create a per-method map of argument-names to service/type-references
                $args = [];
                foreach ($parameters as $p) {
                    /** @var \ReflectionParameter $p */
                    $type = \ltrim($target = \_PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\LazyProxy\ProxyHelper::getTypeHint($r, $p), '\\');
                    $invalidBehavior = \_PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\ContainerInterface::IGNORE_ON_INVALID_REFERENCE;
                    if (isset($arguments[$r->name][$p->name])) {
                        $target = $arguments[$r->name][$p->name];
                        if ('?' !== $target[0]) {
                            $invalidBehavior = \_PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\ContainerInterface::RUNTIME_EXCEPTION_ON_INVALID_REFERENCE;
                        } elseif ('' === ($target = (string) \substr($target, 1))) {
                            throw new \_PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\Exception\InvalidArgumentException(\sprintf('A "%s" tag must have non-empty "id" attributes for service "%s".', $this->controllerTag, $id));
                        } elseif ($p->allowsNull() && !$p->isOptional()) {
                            $invalidBehavior = \_PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\ContainerInterface::NULL_ON_INVALID_REFERENCE;
                        }
                    } elseif (isset($bindings[$bindingName = $type . ' $' . $p->name]) || isset($bindings[$bindingName = '$' . $p->name]) || isset($bindings[$bindingName = $type])) {
                        $binding = $bindings[$bindingName];
                        list($bindingValue, $bindingId, , $bindingType, $bindingFile) = $binding->getValues();
                        $binding->setValues([$bindingValue, $bindingId, \true, $bindingType, $bindingFile]);
                        if (!$bindingValue instanceof \_PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\Reference) {
                            $args[$p->name] = new \_PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\Reference('.value.' . $container->hash($bindingValue));
                            $container->register((string) $args[$p->name], 'mixed')->setFactory('current')->addArgument([$bindingValue]);
                        } else {
                            $args[$p->name] = $bindingValue;
                        }
                        continue;
                    } elseif (!$type || !$autowire || '\\' !== $target[0]) {
                        continue;
                    } elseif (!$p->allowsNull()) {
                        $invalidBehavior = \_PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\ContainerInterface::RUNTIME_EXCEPTION_ON_INVALID_REFERENCE;
                    }
                    if (\_PhpScoper36281e29f54f\Symfony\Component\HttpFoundation\Request::class === $type) {
                        continue;
                    }
                    if ($type && !$p->isOptional() && !$p->allowsNull() && !\class_exists($type) && !\interface_exists($type, \false)) {
                        $message = \sprintf('Cannot determine controller argument for "%s::%s()": the $%s argument is type-hinted with the non-existent class or interface: "%s".', $class, $r->name, $p->name, $type);
                        // see if the type-hint lives in the same namespace as the controller
                        if (0 === \strncmp($type, $class, \strrpos($class, '\\'))) {
                            $message .= ' Did you forget to add a use statement?';
                        }
                        throw new \_PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\Exception\InvalidArgumentException($message);
                    }
                    $target = \ltrim($target, '\\');
                    $args[$p->name] = $type ? new \_PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\TypedReference($target, $type, $invalidBehavior, $p->name) : new \_PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\Reference($target, $invalidBehavior);
                }
                // register the maps as a per-method service-locators
                if ($args) {
                    $controllers[$id . '::' . $r->name] = \_PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\Compiler\ServiceLocatorTagPass::register($container, $args);
                }
            }
        }
        $controllerLocatorRef = \_PhpScoper36281e29f54f\Symfony\Component\DependencyInjection\Compiler\ServiceLocatorTagPass::register($container, $controllers);
        if ($container->hasDefinition($this->resolverServiceId)) {
            $container->getDefinition($this->resolverServiceId)->replaceArgument(0, $controllerLocatorRef);
        }
        if ($container->hasDefinition($this->notTaggedControllerResolverServiceId)) {
            $container->getDefinition($this->notTaggedControllerResolverServiceId)->replaceArgument(0, $controllerLocatorRef);
        }
        $container->setAlias($this->controllerLocator, (string) $controllerLocatorRef);
    }
}

<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\Compiler;

use _PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\Argument\ArgumentInterface;
use _PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\Definition;
use _PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\Exception\LogicException;
use _PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\Exception\RuntimeException;
use _PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\ExpressionLanguage;
use _PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\Reference;
use _PhpScoper0773dc025ec9\Symfony\Component\ExpressionLanguage\Expression;
/**
 * @author Nicolas Grekas <p@tchwork.com>
 */
abstract class AbstractRecursivePass implements \_PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface
{
    /**
     * @var ContainerBuilder
     */
    protected $container;
    protected $currentId;
    private $processExpressions = \false;
    private $expressionLanguage;
    private $inExpression = \false;
    /**
     * {@inheritdoc}
     */
    public function process(\_PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\ContainerBuilder $container)
    {
        $this->container = $container;
        try {
            $this->processValue($container->getDefinitions(), \true);
        } finally {
            $this->container = null;
        }
    }
    protected function enableExpressionProcessing()
    {
        $this->processExpressions = \true;
    }
    protected function inExpression(bool $reset = \true) : bool
    {
        $inExpression = $this->inExpression;
        if ($reset) {
            $this->inExpression = \false;
        }
        return $inExpression;
    }
    /**
     * Processes a value found in a definition tree.
     *
     * @param mixed $value
     * @param bool  $isRoot
     *
     * @return mixed The processed value
     */
    protected function processValue($value, $isRoot = \false)
    {
        if (\is_array($value)) {
            foreach ($value as $k => $v) {
                if ($isRoot) {
                    $this->currentId = $k;
                }
                if ($v !== ($processedValue = $this->processValue($v, $isRoot))) {
                    $value[$k] = $processedValue;
                }
            }
        } elseif ($value instanceof \_PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\Argument\ArgumentInterface) {
            $value->setValues($this->processValue($value->getValues()));
        } elseif ($value instanceof \_PhpScoper0773dc025ec9\Symfony\Component\ExpressionLanguage\Expression && $this->processExpressions) {
            $this->getExpressionLanguage()->compile((string) $value, ['this' => 'container']);
        } elseif ($value instanceof \_PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\Definition) {
            $value->setArguments($this->processValue($value->getArguments()));
            $value->setProperties($this->processValue($value->getProperties()));
            $value->setMethodCalls($this->processValue($value->getMethodCalls()));
            $changes = $value->getChanges();
            if (isset($changes['factory'])) {
                $value->setFactory($this->processValue($value->getFactory()));
            }
            if (isset($changes['configurator'])) {
                $value->setConfigurator($this->processValue($value->getConfigurator()));
            }
        }
        return $value;
    }
    /**
     * @param bool $required
     *
     * @return \ReflectionFunctionAbstract|null
     *
     * @throws RuntimeException
     */
    protected function getConstructor(\_PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\Definition $definition, $required)
    {
        if ($definition->isSynthetic()) {
            return null;
        }
        if (\is_string($factory = $definition->getFactory())) {
            if (!\function_exists($factory)) {
                throw new \_PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\Exception\RuntimeException(\sprintf('Invalid service "%s": function "%s" does not exist.', $this->currentId, $factory));
            }
            $r = new \ReflectionFunction($factory);
            if (\false !== $r->getFileName() && \file_exists($r->getFileName())) {
                $this->container->fileExists($r->getFileName());
            }
            return $r;
        }
        if ($factory) {
            list($class, $method) = $factory;
            if ($class instanceof \_PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\Reference) {
                $class = $this->container->findDefinition((string) $class)->getClass();
            } elseif ($class instanceof \_PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\Definition) {
                $class = $class->getClass();
            } elseif (null === $class) {
                $class = $definition->getClass();
            }
            if ('__construct' === $method) {
                throw new \_PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\Exception\RuntimeException(\sprintf('Invalid service "%s": "__construct()" cannot be used as a factory method.', $this->currentId));
            }
            return $this->getReflectionMethod(new \_PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\Definition($class), $method);
        }
        $class = $definition->getClass();
        try {
            if (!($r = $this->container->getReflectionClass($class))) {
                throw new \_PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\Exception\RuntimeException(\sprintf('Invalid service "%s": class "%s" does not exist.', $this->currentId, $class));
            }
        } catch (\ReflectionException $e) {
            throw new \_PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\Exception\RuntimeException(\sprintf('Invalid service "%s": %s.', $this->currentId, \lcfirst(\rtrim($e->getMessage(), '.'))));
        }
        if (!($r = $r->getConstructor())) {
            if ($required) {
                throw new \_PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\Exception\RuntimeException(\sprintf('Invalid service "%s": class%s has no constructor.', $this->currentId, \sprintf($class !== $this->currentId ? ' "%s"' : '', $class)));
            }
        } elseif (!$r->isPublic()) {
            throw new \_PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\Exception\RuntimeException(\sprintf('Invalid service "%s": %s must be public.', $this->currentId, \sprintf($class !== $this->currentId ? 'constructor of class "%s"' : 'its constructor', $class)));
        }
        return $r;
    }
    /**
     * @param string $method
     *
     * @throws RuntimeException
     *
     * @return \ReflectionFunctionAbstract
     */
    protected function getReflectionMethod(\_PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\Definition $definition, $method)
    {
        if ('__construct' === $method) {
            return $this->getConstructor($definition, \true);
        }
        if (!($class = $definition->getClass())) {
            throw new \_PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\Exception\RuntimeException(\sprintf('Invalid service "%s": the class is not set.', $this->currentId));
        }
        if (!($r = $this->container->getReflectionClass($class))) {
            throw new \_PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\Exception\RuntimeException(\sprintf('Invalid service "%s": class "%s" does not exist.', $this->currentId, $class));
        }
        if (!$r->hasMethod($method)) {
            throw new \_PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\Exception\RuntimeException(\sprintf('Invalid service "%s": method "%s()" does not exist.', $this->currentId, $class !== $this->currentId ? $class . '::' . $method : $method));
        }
        $r = $r->getMethod($method);
        if (!$r->isPublic()) {
            throw new \_PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\Exception\RuntimeException(\sprintf('Invalid service "%s": method "%s()" must be public.', $this->currentId, $class !== $this->currentId ? $class . '::' . $method : $method));
        }
        return $r;
    }
    private function getExpressionLanguage() : \_PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\ExpressionLanguage
    {
        if (null === $this->expressionLanguage) {
            if (!\class_exists(\_PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\ExpressionLanguage::class)) {
                throw new \_PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\Exception\LogicException('Unable to use expressions as the Symfony ExpressionLanguage component is not installed.');
            }
            $providers = $this->container->getExpressionLanguageProviders();
            $this->expressionLanguage = new \_PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\ExpressionLanguage(null, $providers, function (string $arg) : string {
                if ('""' === \substr_replace($arg, '', 1, -1)) {
                    $id = \stripcslashes(\substr($arg, 1, -1));
                    $this->inExpression = \true;
                    $arg = $this->processValue(new \_PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\Reference($id));
                    $this->inExpression = \false;
                    if (!$arg instanceof \_PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\Reference) {
                        throw new \_PhpScoper0773dc025ec9\Symfony\Component\DependencyInjection\Exception\RuntimeException(\sprintf('"%s::processValue()" must return a Reference when processing an expression, %s returned for service("%s").', \get_class($this), \is_object($arg) ? \get_class($arg) : \gettype($arg), $id));
                    }
                    $arg = \sprintf('"%s"', $arg);
                }
                return \sprintf('$this->get(%s)', $arg);
            });
        }
        return $this->expressionLanguage;
    }
}

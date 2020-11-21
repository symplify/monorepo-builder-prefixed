<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperbc89827b806f\Symfony\Component\DependencyInjection\Loader\Configurator;

use _PhpScoperbc89827b806f\Symfony\Component\DependencyInjection\Argument\ArgumentInterface;
use _PhpScoperbc89827b806f\Symfony\Component\DependencyInjection\Definition;
use _PhpScoperbc89827b806f\Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use _PhpScoperbc89827b806f\Symfony\Component\DependencyInjection\Parameter;
use _PhpScoperbc89827b806f\Symfony\Component\DependencyInjection\Reference;
use _PhpScoperbc89827b806f\Symfony\Component\ExpressionLanguage\Expression;
abstract class AbstractConfigurator
{
    const FACTORY = 'unknown';
    /** @internal */
    protected $definition;
    public function __call($method, $args)
    {
        if (\method_exists($this, 'set' . $method)) {
            return $this->{'set' . $method}(...$args);
        }
        throw new \BadMethodCallException(\sprintf('Call to undefined method %s::%s()', \get_class($this), $method));
    }
    /**
     * Checks that a value is valid, optionally replacing Definition and Reference configurators by their configure value.
     *
     * @param mixed $value
     * @param bool  $allowServices whether Definition and Reference are allowed; by default, only scalars and arrays are
     *
     * @return mixed the value, optionally cast to a Definition/Reference
     */
    public static function processValue($value, $allowServices = \false)
    {
        if (\is_array($value)) {
            foreach ($value as $k => $v) {
                $value[$k] = static::processValue($v, $allowServices);
            }
            return $value;
        }
        if ($value instanceof \_PhpScoperbc89827b806f\Symfony\Component\DependencyInjection\Loader\Configurator\ReferenceConfigurator) {
            return new \_PhpScoperbc89827b806f\Symfony\Component\DependencyInjection\Reference($value->id, $value->invalidBehavior);
        }
        if ($value instanceof \_PhpScoperbc89827b806f\Symfony\Component\DependencyInjection\Loader\Configurator\InlineServiceConfigurator) {
            $def = $value->definition;
            $value->definition = null;
            return $def;
        }
        if ($value instanceof self) {
            throw new \_PhpScoperbc89827b806f\Symfony\Component\DependencyInjection\Exception\InvalidArgumentException(\sprintf('"%s()" can be used only at the root of service configuration files.', $value::FACTORY));
        }
        switch (\true) {
            case null === $value:
            case \is_scalar($value):
                return $value;
            case $value instanceof \_PhpScoperbc89827b806f\Symfony\Component\DependencyInjection\Argument\ArgumentInterface:
            case $value instanceof \_PhpScoperbc89827b806f\Symfony\Component\DependencyInjection\Definition:
            case $value instanceof \_PhpScoperbc89827b806f\Symfony\Component\ExpressionLanguage\Expression:
            case $value instanceof \_PhpScoperbc89827b806f\Symfony\Component\DependencyInjection\Parameter:
            case $value instanceof \_PhpScoperbc89827b806f\Symfony\Component\DependencyInjection\Reference:
                if ($allowServices) {
                    return $value;
                }
        }
        throw new \_PhpScoperbc89827b806f\Symfony\Component\DependencyInjection\Exception\InvalidArgumentException(\sprintf('Cannot use values of type "%s" in service configuration files.', \is_object($value) ? \get_class($value) : \gettype($value)));
    }
}

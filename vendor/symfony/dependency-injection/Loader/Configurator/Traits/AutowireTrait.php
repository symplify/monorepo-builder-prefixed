<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper184bc0c88d68\Symfony\Component\DependencyInjection\Loader\Configurator\Traits;

trait AutowireTrait
{
    /**
     * Enables/disables autowiring.
     *
     * @return $this
     */
    public final function autowire(bool $autowired = \true) : self
    {
        $this->definition->setAutowired($autowired);
        return $this;
    }
}

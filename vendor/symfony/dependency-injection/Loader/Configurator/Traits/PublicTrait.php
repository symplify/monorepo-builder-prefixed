<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperc86a79e2d6b2\Symfony\Component\DependencyInjection\Loader\Configurator\Traits;

trait PublicTrait
{
    /**
     * @return $this
     */
    public final function public() : self
    {
        $this->definition->setPublic(\true);
        return $this;
    }
    /**
     * @return $this
     */
    public final function private() : self
    {
        $this->definition->setPublic(\false);
        return $this;
    }
}

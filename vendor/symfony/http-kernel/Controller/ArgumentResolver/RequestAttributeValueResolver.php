<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperef4638f5d8b1\Symfony\Component\HttpKernel\Controller\ArgumentResolver;

use _PhpScoperef4638f5d8b1\Symfony\Component\HttpFoundation\Request;
use _PhpScoperef4638f5d8b1\Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use _PhpScoperef4638f5d8b1\Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
/**
 * Yields a non-variadic argument's value from the request attributes.
 *
 * @author Iltar van der Berg <kjarli@gmail.com>
 */
final class RequestAttributeValueResolver implements \_PhpScoperef4638f5d8b1\Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface
{
    /**
     * {@inheritdoc}
     */
    public function supports(\_PhpScoperef4638f5d8b1\Symfony\Component\HttpFoundation\Request $request, \_PhpScoperef4638f5d8b1\Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata $argument) : bool
    {
        return !$argument->isVariadic() && $request->attributes->has($argument->getName());
    }
    /**
     * {@inheritdoc}
     */
    public function resolve(\_PhpScoperef4638f5d8b1\Symfony\Component\HttpFoundation\Request $request, \_PhpScoperef4638f5d8b1\Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata $argument) : iterable
    {
        (yield $request->attributes->get($argument->getName()));
    }
}

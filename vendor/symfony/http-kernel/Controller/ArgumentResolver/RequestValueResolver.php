<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper450cfab1c22b\Symfony\Component\HttpKernel\Controller\ArgumentResolver;

use _PhpScoper450cfab1c22b\Symfony\Component\HttpFoundation\Request;
use _PhpScoper450cfab1c22b\Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use _PhpScoper450cfab1c22b\Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
/**
 * Yields the same instance as the request object passed along.
 *
 * @author Iltar van der Berg <kjarli@gmail.com>
 */
final class RequestValueResolver implements \_PhpScoper450cfab1c22b\Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface
{
    /**
     * {@inheritdoc}
     */
    public function supports(\_PhpScoper450cfab1c22b\Symfony\Component\HttpFoundation\Request $request, \_PhpScoper450cfab1c22b\Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata $argument) : bool
    {
        return \_PhpScoper450cfab1c22b\Symfony\Component\HttpFoundation\Request::class === $argument->getType() || \is_subclass_of($argument->getType(), \_PhpScoper450cfab1c22b\Symfony\Component\HttpFoundation\Request::class);
    }
    /**
     * {@inheritdoc}
     */
    public function resolve(\_PhpScoper450cfab1c22b\Symfony\Component\HttpFoundation\Request $request, \_PhpScoper450cfab1c22b\Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata $argument) : iterable
    {
        (yield $request);
    }
}

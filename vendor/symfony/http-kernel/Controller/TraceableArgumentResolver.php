<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper59bf8deb8cc1\Symfony\Component\HttpKernel\Controller;

use _PhpScoper59bf8deb8cc1\Symfony\Component\HttpFoundation\Request;
use _PhpScoper59bf8deb8cc1\Symfony\Component\Stopwatch\Stopwatch;
/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
class TraceableArgumentResolver implements \_PhpScoper59bf8deb8cc1\Symfony\Component\HttpKernel\Controller\ArgumentResolverInterface
{
    private $resolver;
    private $stopwatch;
    public function __construct(\_PhpScoper59bf8deb8cc1\Symfony\Component\HttpKernel\Controller\ArgumentResolverInterface $resolver, \_PhpScoper59bf8deb8cc1\Symfony\Component\Stopwatch\Stopwatch $stopwatch)
    {
        $this->resolver = $resolver;
        $this->stopwatch = $stopwatch;
    }
    /**
     * {@inheritdoc}
     */
    public function getArguments(\_PhpScoper59bf8deb8cc1\Symfony\Component\HttpFoundation\Request $request, $controller)
    {
        $e = $this->stopwatch->start('controller.get_arguments');
        $ret = $this->resolver->getArguments($request, $controller);
        $e->stop();
        return $ret;
    }
}

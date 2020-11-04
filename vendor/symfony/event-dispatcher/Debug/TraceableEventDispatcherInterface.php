<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper68683f91c63d\Symfony\Component\EventDispatcher\Debug;

use _PhpScoper68683f91c63d\Symfony\Component\EventDispatcher\EventDispatcherInterface;
use _PhpScoper68683f91c63d\Symfony\Component\HttpFoundation\Request;
use _PhpScoper68683f91c63d\Symfony\Contracts\Service\ResetInterface;
/**
 * @deprecated since Symfony 4.1
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface TraceableEventDispatcherInterface extends \_PhpScoper68683f91c63d\Symfony\Component\EventDispatcher\EventDispatcherInterface, \_PhpScoper68683f91c63d\Symfony\Contracts\Service\ResetInterface
{
    /**
     * Gets the called listeners.
     *
     * @param Request|null $request The request to get listeners for
     *
     * @return array An array of called listeners
     */
    public function getCalledListeners();
    /**
     * Gets the not called listeners.
     *
     * @param Request|null $request The request to get listeners for
     *
     * @return array An array of not called listeners
     */
    public function getNotCalledListeners();
}

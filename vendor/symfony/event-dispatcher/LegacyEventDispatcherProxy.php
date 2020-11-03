<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperf48ea5df9e9b\Symfony\Component\EventDispatcher;

use _PhpScoperf48ea5df9e9b\Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
trigger_deprecation('symfony/event-dispatcher', '5.1', '%s is deprecated, use the event dispatcher without the proxy.', \_PhpScoperf48ea5df9e9b\Symfony\Component\EventDispatcher\LegacyEventDispatcherProxy::class);
/**
 * A helper class to provide BC/FC with the legacy signature of EventDispatcherInterface::dispatch().
 *
 * @author Nicolas Grekas <p@tchwork.com>
 *
 * @deprecated since Symfony 5.1
 */
final class LegacyEventDispatcherProxy
{
    public static function decorate(?\_PhpScoperf48ea5df9e9b\Symfony\Contracts\EventDispatcher\EventDispatcherInterface $dispatcher) : ?\_PhpScoperf48ea5df9e9b\Symfony\Contracts\EventDispatcher\EventDispatcherInterface
    {
        return $dispatcher;
    }
}

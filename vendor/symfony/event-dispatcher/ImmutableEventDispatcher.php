<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper94f327c48d46\Symfony\Component\EventDispatcher;

/**
 * A read-only proxy for an event dispatcher.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class ImmutableEventDispatcher implements \_PhpScoper94f327c48d46\Symfony\Component\EventDispatcher\EventDispatcherInterface
{
    private $dispatcher;
    public function __construct(\_PhpScoper94f327c48d46\Symfony\Component\EventDispatcher\EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = \_PhpScoper94f327c48d46\Symfony\Component\EventDispatcher\LegacyEventDispatcherProxy::decorate($dispatcher);
    }
    /**
     * {@inheritdoc}
     *
     * @param string|null $eventName
     */
    public function dispatch($event)
    {
        $eventName = 1 < \func_num_args() ? \func_get_arg(1) : null;
        if (\is_scalar($event)) {
            // deprecated
            $swap = $event;
            $event = $eventName ?? new \_PhpScoper94f327c48d46\Symfony\Component\EventDispatcher\Event();
            $eventName = $swap;
        }
        return $this->dispatcher->dispatch($event, $eventName);
    }
    /**
     * {@inheritdoc}
     */
    public function addListener($eventName, $listener, $priority = 0)
    {
        throw new \BadMethodCallException('Unmodifiable event dispatchers must not be modified.');
    }
    /**
     * {@inheritdoc}
     */
    public function addSubscriber(\_PhpScoper94f327c48d46\Symfony\Component\EventDispatcher\EventSubscriberInterface $subscriber)
    {
        throw new \BadMethodCallException('Unmodifiable event dispatchers must not be modified.');
    }
    /**
     * {@inheritdoc}
     */
    public function removeListener($eventName, $listener)
    {
        throw new \BadMethodCallException('Unmodifiable event dispatchers must not be modified.');
    }
    /**
     * {@inheritdoc}
     */
    public function removeSubscriber(\_PhpScoper94f327c48d46\Symfony\Component\EventDispatcher\EventSubscriberInterface $subscriber)
    {
        throw new \BadMethodCallException('Unmodifiable event dispatchers must not be modified.');
    }
    /**
     * {@inheritdoc}
     */
    public function getListeners($eventName = null)
    {
        return $this->dispatcher->getListeners($eventName);
    }
    /**
     * {@inheritdoc}
     */
    public function getListenerPriority($eventName, $listener)
    {
        return $this->dispatcher->getListenerPriority($eventName, $listener);
    }
    /**
     * {@inheritdoc}
     */
    public function hasListeners($eventName = null)
    {
        return $this->dispatcher->hasListeners($eventName);
    }
}

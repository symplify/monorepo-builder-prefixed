<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScopera28be7b3fe51\Symfony\Component\HttpKernel\EventListener;

use _PhpScopera28be7b3fe51\Symfony\Component\EventDispatcher\EventSubscriberInterface;
use _PhpScopera28be7b3fe51\Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use _PhpScopera28be7b3fe51\Symfony\Component\HttpKernel\KernelEvents;
/**
 * ResponseListener fixes the Response headers based on the Request.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @final since Symfony 4.3
 */
class ResponseListener implements \_PhpScopera28be7b3fe51\Symfony\Component\EventDispatcher\EventSubscriberInterface
{
    private $charset;
    public function __construct(string $charset)
    {
        $this->charset = $charset;
    }
    /**
     * Filters the Response.
     */
    public function onKernelResponse(\_PhpScopera28be7b3fe51\Symfony\Component\HttpKernel\Event\FilterResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }
        $response = $event->getResponse();
        if (null === $response->getCharset()) {
            $response->setCharset($this->charset);
        }
        $response->prepare($event->getRequest());
    }
    public static function getSubscribedEvents()
    {
        return [\_PhpScopera28be7b3fe51\Symfony\Component\HttpKernel\KernelEvents::RESPONSE => 'onKernelResponse'];
    }
}

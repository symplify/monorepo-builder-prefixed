<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper0ce3ac6864aa\Symfony\Component\HttpKernel\Fragment;

use _PhpScoper0ce3ac6864aa\Symfony\Component\EventDispatcher\LegacyEventDispatcherProxy;
use _PhpScoper0ce3ac6864aa\Symfony\Component\HttpFoundation\Request;
use _PhpScoper0ce3ac6864aa\Symfony\Component\HttpFoundation\Response;
use _PhpScoper0ce3ac6864aa\Symfony\Component\HttpKernel\Controller\ControllerReference;
use _PhpScoper0ce3ac6864aa\Symfony\Component\HttpKernel\Event\ExceptionEvent;
use _PhpScoper0ce3ac6864aa\Symfony\Component\HttpKernel\HttpCache\SubRequestHandler;
use _PhpScoper0ce3ac6864aa\Symfony\Component\HttpKernel\HttpKernelInterface;
use _PhpScoper0ce3ac6864aa\Symfony\Component\HttpKernel\KernelEvents;
use _PhpScoper0ce3ac6864aa\Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
/**
 * Implements the inline rendering strategy where the Request is rendered by the current HTTP kernel.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class InlineFragmentRenderer extends \_PhpScoper0ce3ac6864aa\Symfony\Component\HttpKernel\Fragment\RoutableFragmentRenderer
{
    private $kernel;
    private $dispatcher;
    public function __construct(\_PhpScoper0ce3ac6864aa\Symfony\Component\HttpKernel\HttpKernelInterface $kernel, \_PhpScoper0ce3ac6864aa\Symfony\Contracts\EventDispatcher\EventDispatcherInterface $dispatcher = null)
    {
        $this->kernel = $kernel;
        $this->dispatcher = \_PhpScoper0ce3ac6864aa\Symfony\Component\EventDispatcher\LegacyEventDispatcherProxy::decorate($dispatcher);
    }
    /**
     * {@inheritdoc}
     *
     * Additional available options:
     *
     *  * alt: an alternative URI to render in case of an error
     */
    public function render($uri, \_PhpScoper0ce3ac6864aa\Symfony\Component\HttpFoundation\Request $request, array $options = [])
    {
        $reference = null;
        if ($uri instanceof \_PhpScoper0ce3ac6864aa\Symfony\Component\HttpKernel\Controller\ControllerReference) {
            $reference = $uri;
            // Remove attributes from the generated URI because if not, the Symfony
            // routing system will use them to populate the Request attributes. We don't
            // want that as we want to preserve objects (so we manually set Request attributes
            // below instead)
            $attributes = $reference->attributes;
            $reference->attributes = [];
            // The request format and locale might have been overridden by the user
            foreach (['_format', '_locale'] as $key) {
                if (isset($attributes[$key])) {
                    $reference->attributes[$key] = $attributes[$key];
                }
            }
            $uri = $this->generateFragmentUri($uri, $request, \false, \false);
            $reference->attributes = \array_merge($attributes, $reference->attributes);
        }
        $subRequest = $this->createSubRequest($uri, $request);
        // override Request attributes as they can be objects (which are not supported by the generated URI)
        if (null !== $reference) {
            $subRequest->attributes->add($reference->attributes);
        }
        $level = \ob_get_level();
        try {
            return \_PhpScoper0ce3ac6864aa\Symfony\Component\HttpKernel\HttpCache\SubRequestHandler::handle($this->kernel, $subRequest, \_PhpScoper0ce3ac6864aa\Symfony\Component\HttpKernel\HttpKernelInterface::SUB_REQUEST, \false);
        } catch (\Exception $e) {
            // we dispatch the exception event to trigger the logging
            // the response that comes back is ignored
            if (isset($options['ignore_errors']) && $options['ignore_errors'] && $this->dispatcher) {
                $event = new \_PhpScoper0ce3ac6864aa\Symfony\Component\HttpKernel\Event\ExceptionEvent($this->kernel, $request, \_PhpScoper0ce3ac6864aa\Symfony\Component\HttpKernel\HttpKernelInterface::SUB_REQUEST, $e);
                $this->dispatcher->dispatch($event, \_PhpScoper0ce3ac6864aa\Symfony\Component\HttpKernel\KernelEvents::EXCEPTION);
            }
            // let's clean up the output buffers that were created by the sub-request
            \_PhpScoper0ce3ac6864aa\Symfony\Component\HttpFoundation\Response::closeOutputBuffers($level, \false);
            if (isset($options['alt'])) {
                $alt = $options['alt'];
                unset($options['alt']);
                return $this->render($alt, $request, $options);
            }
            if (!isset($options['ignore_errors']) || !$options['ignore_errors']) {
                throw $e;
            }
            return new \_PhpScoper0ce3ac6864aa\Symfony\Component\HttpFoundation\Response();
        }
    }
    protected function createSubRequest($uri, \_PhpScoper0ce3ac6864aa\Symfony\Component\HttpFoundation\Request $request)
    {
        $cookies = $request->cookies->all();
        $server = $request->server->all();
        unset($server['HTTP_IF_MODIFIED_SINCE']);
        unset($server['HTTP_IF_NONE_MATCH']);
        $subRequest = \_PhpScoper0ce3ac6864aa\Symfony\Component\HttpFoundation\Request::create($uri, 'get', [], $cookies, [], $server);
        if ($request->headers->has('Surrogate-Capability')) {
            $subRequest->headers->set('Surrogate-Capability', $request->headers->get('Surrogate-Capability'));
        }
        static $setSession;
        if (null === $setSession) {
            $setSession = \Closure::bind(static function ($subRequest, $request) {
                $subRequest->session = $request->session;
            }, null, \_PhpScoper0ce3ac6864aa\Symfony\Component\HttpFoundation\Request::class);
        }
        $setSession($subRequest, $request);
        if ($request->get('_format')) {
            $subRequest->attributes->set('_format', $request->get('_format'));
        }
        if ($request->getDefaultLocale() !== $request->getLocale()) {
            $subRequest->setLocale($request->getLocale());
        }
        return $subRequest;
    }
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'inline';
    }
}

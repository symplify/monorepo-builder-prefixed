<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper36281e29f54f\Symfony\Component\HttpKernel;

use _PhpScoper36281e29f54f\Symfony\Component\HttpFoundation\Request;
use _PhpScoper36281e29f54f\Symfony\Component\HttpFoundation\Response;
/**
 * Terminable extends the Kernel request/response cycle with dispatching a post
 * response event after sending the response and before shutting down the kernel.
 *
 * @author Jordi Boggiano <j.boggiano@seld.be>
 * @author Pierre Minnieur <pierre.minnieur@sensiolabs.de>
 */
interface TerminableInterface
{
    /**
     * Terminates a request/response cycle.
     *
     * Should be called after sending the response and before shutting down the kernel.
     */
    public function terminate(\_PhpScoper36281e29f54f\Symfony\Component\HttpFoundation\Request $request, \_PhpScoper36281e29f54f\Symfony\Component\HttpFoundation\Response $response);
}

<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper36281e29f54f\Symfony\Component\Debug\Exception;

@\trigger_error(\sprintf('The "%s" class is deprecated since Symfony 4.4, use "%s" instead.', \_PhpScoper36281e29f54f\Symfony\Component\Debug\Exception\UndefinedMethodException::class, \_PhpScoper36281e29f54f\Symfony\Component\ErrorHandler\Error\UndefinedMethodError::class), \E_USER_DEPRECATED);
/**
 * Undefined Method Exception.
 *
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 *
 * @deprecated since Symfony 4.4, use Symfony\Component\ErrorHandler\Error\UndefinedMethodError instead.
 */
class UndefinedMethodException extends \_PhpScoper36281e29f54f\Symfony\Component\Debug\Exception\FatalErrorException
{
    public function __construct(string $message, \ErrorException $previous)
    {
        parent::__construct($message, $previous->getCode(), $previous->getSeverity(), $previous->getFile(), $previous->getLine(), null, \true, null, $previous->getPrevious());
        $this->setTrace($previous->getTrace());
    }
}

<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper2a80719fd449\Symfony\Component\DependencyInjection\Exception;

/**
 * This exception wraps exceptions whose messages contain a reference to an env parameter.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
class EnvParameterException extends \_PhpScoper2a80719fd449\Symfony\Component\DependencyInjection\Exception\InvalidArgumentException
{
    public function __construct(array $envs, \Throwable $previous = null, string $message = 'Incompatible use of dynamic environment variables "%s" found in parameters.')
    {
        parent::__construct(\sprintf($message, \implode('", "', $envs)), 0, $previous);
    }
}
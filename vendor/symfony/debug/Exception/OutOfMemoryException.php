<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper3c46f40844ed\Symfony\Component\Debug\Exception;

@\trigger_error(\sprintf('The "%s" class is deprecated since Symfony 4.4, use "%s" instead.', \_PhpScoper3c46f40844ed\Symfony\Component\Debug\Exception\OutOfMemoryException::class, \_PhpScoper3c46f40844ed\Symfony\Component\ErrorHandler\Error\OutOfMemoryError::class), \E_USER_DEPRECATED);
/**
 * Out of memory exception.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 *
 * @deprecated since Symfony 4.4, use Symfony\Component\ErrorHandler\Error\OutOfMemoryError instead.
 */
class OutOfMemoryException extends \_PhpScoper3c46f40844ed\Symfony\Component\Debug\Exception\FatalErrorException
{
}

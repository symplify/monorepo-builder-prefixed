<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper36281e29f54f\Symfony\Component\Debug;

@\trigger_error(\sprintf('The "%s" class is deprecated since Symfony 4.4, use "%s" instead.', \_PhpScoper36281e29f54f\Symfony\Component\Debug\Debug::class, \_PhpScoper36281e29f54f\Symfony\Component\ErrorHandler\Debug::class), \E_USER_DEPRECATED);
/**
 * Registers all the debug tools.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @deprecated since Symfony 4.4, use Symfony\Component\ErrorHandler\Debug instead.
 */
class Debug
{
    private static $enabled = \false;
    /**
     * Enables the debug tools.
     *
     * This method registers an error handler and an exception handler.
     *
     * @param int  $errorReportingLevel The level of error reporting you want
     * @param bool $displayErrors       Whether to display errors (for development) or just log them (for production)
     */
    public static function enable($errorReportingLevel = \E_ALL, $displayErrors = \true)
    {
        if (static::$enabled) {
            return;
        }
        static::$enabled = \true;
        if (null !== $errorReportingLevel) {
            \error_reporting($errorReportingLevel);
        } else {
            \error_reporting(\E_ALL);
        }
        if (!\in_array(\PHP_SAPI, ['cli', 'phpdbg'], \true)) {
            \ini_set('display_errors', 0);
            \_PhpScoper36281e29f54f\Symfony\Component\Debug\ExceptionHandler::register();
        } elseif ($displayErrors && (!\filter_var(\ini_get('log_errors'), \FILTER_VALIDATE_BOOLEAN) || \ini_get('error_log'))) {
            // CLI - display errors only if they're not already logged to STDERR
            \ini_set('display_errors', 1);
        }
        if ($displayErrors) {
            \_PhpScoper36281e29f54f\Symfony\Component\Debug\ErrorHandler::register(new \_PhpScoper36281e29f54f\Symfony\Component\Debug\ErrorHandler(new \_PhpScoper36281e29f54f\Symfony\Component\Debug\BufferingLogger()));
        } else {
            \_PhpScoper36281e29f54f\Symfony\Component\Debug\ErrorHandler::register()->throwAt(0, \true);
        }
        \_PhpScoper36281e29f54f\Symfony\Component\Debug\DebugClassLoader::enable();
    }
}

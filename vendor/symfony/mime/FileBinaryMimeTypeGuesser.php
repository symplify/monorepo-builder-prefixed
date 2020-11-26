<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper97d4f3c5628a\Symfony\Component\Mime;

use _PhpScoper97d4f3c5628a\Symfony\Component\Mime\Exception\InvalidArgumentException;
use _PhpScoper97d4f3c5628a\Symfony\Component\Mime\Exception\LogicException;
/**
 * Guesses the MIME type with the binary "file" (only available on *nix).
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 *
 * @experimental in 4.3
 */
class FileBinaryMimeTypeGuesser implements \_PhpScoper97d4f3c5628a\Symfony\Component\Mime\MimeTypeGuesserInterface
{
    private $cmd;
    /**
     * The $cmd pattern must contain a "%s" string that will be replaced
     * with the file name to guess.
     *
     * The command output must start with the MIME type of the file.
     *
     * @param string $cmd The command to run to get the MIME type of a file
     */
    public function __construct(string $cmd = 'file -b --mime %s 2>/dev/null')
    {
        $this->cmd = $cmd;
    }
    /**
     * {@inheritdoc}
     */
    public function isGuesserSupported() : bool
    {
        static $supported = null;
        if (null !== $supported) {
            return $supported;
        }
        if ('\\' === \DIRECTORY_SEPARATOR || !\function_exists('passthru') || !\function_exists('escapeshellarg')) {
            return $supported = \false;
        }
        \ob_start();
        \passthru('command -v file', $exitStatus);
        $binPath = \trim(\ob_get_clean());
        return $supported = 0 === $exitStatus && '' !== $binPath;
    }
    /**
     * {@inheritdoc}
     */
    public function guessMimeType(string $path) : ?string
    {
        if (!\is_file($path) || !\is_readable($path)) {
            throw new \_PhpScoper97d4f3c5628a\Symfony\Component\Mime\Exception\InvalidArgumentException(\sprintf('The "%s" file does not exist or is not readable.', $path));
        }
        if (!$this->isGuesserSupported()) {
            throw new \_PhpScoper97d4f3c5628a\Symfony\Component\Mime\Exception\LogicException(\sprintf('The "%s" guesser is not supported.', __CLASS__));
        }
        \ob_start();
        // need to use --mime instead of -i. see #6641
        \passthru(\sprintf($this->cmd, \escapeshellarg($path)), $return);
        if ($return > 0) {
            \ob_end_clean();
            return null;
        }
        $type = \trim(\ob_get_clean());
        if (!\preg_match('#^([a-z0-9\\-]+/[a-z0-9\\-\\.]+)#i', $type, $match)) {
            // it's not a type, but an error message
            return null;
        }
        return $match[1];
    }
}

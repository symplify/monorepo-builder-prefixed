<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper36281e29f54f\Symfony\Component\Process;

use _PhpScoper36281e29f54f\Symfony\Component\Process\Exception\RuntimeException;
/**
 * PhpProcess runs a PHP script in an independent process.
 *
 *     $p = new PhpProcess('<?php echo "foo"; ?>');
 *     $p->run();
 *     print $p->getOutput()."\n";
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class PhpProcess extends \_PhpScoper36281e29f54f\Symfony\Component\Process\Process
{
    /**
     * @param string      $script  The PHP script to run (as a string)
     * @param string|null $cwd     The working directory or null to use the working dir of the current PHP process
     * @param array|null  $env     The environment variables or null to use the same environment as the current PHP process
     * @param int         $timeout The timeout in seconds
     * @param array|null  $php     Path to the PHP binary to use with any additional arguments
     */
    public function __construct(string $script, string $cwd = null, array $env = null, int $timeout = 60, array $php = null)
    {
        if (null === $php) {
            $executableFinder = new \_PhpScoper36281e29f54f\Symfony\Component\Process\PhpExecutableFinder();
            $php = $executableFinder->find(\false);
            $php = \false === $php ? null : \array_merge([$php], $executableFinder->findArguments());
        }
        if ('phpdbg' === \PHP_SAPI) {
            $file = \tempnam(\sys_get_temp_dir(), 'dbg');
            \file_put_contents($file, $script);
            \register_shutdown_function('unlink', $file);
            $php[] = $file;
            $script = null;
        }
        parent::__construct($php, $cwd, $env, $script, $timeout);
    }
    /**
     * Sets the path to the PHP binary to use.
     *
     * @deprecated since Symfony 4.2, use the $php argument of the constructor instead.
     */
    public function setPhpBinary($php)
    {
        @\trigger_error(\sprintf('The "%s()" method is deprecated since Symfony 4.2, use the $php argument of the constructor instead.', __METHOD__), \E_USER_DEPRECATED);
        $this->setCommandLine($php);
    }
    /**
     * {@inheritdoc}
     */
    public function start(callable $callback = null, array $env = [])
    {
        if (null === $this->getCommandLine()) {
            throw new \_PhpScoper36281e29f54f\Symfony\Component\Process\Exception\RuntimeException('Unable to find the PHP executable.');
        }
        parent::start($callback, $env);
    }
}

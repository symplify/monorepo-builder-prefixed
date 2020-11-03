<?php

declare (strict_types=1);
namespace Symplify\PackageBuilder\Tests;

use _PhpScoper2a80719fd449\PHPUnit\Framework\TestCase;
use _PhpScoper2a80719fd449\Psr\Container\ContainerInterface;
use ReflectionClass;
use _PhpScoper2a80719fd449\Symfony\Component\Console\Output\OutputInterface;
use _PhpScoper2a80719fd449\Symfony\Component\Console\Style\SymfonyStyle;
use _PhpScoper2a80719fd449\Symfony\Component\DependencyInjection\Container;
use _PhpScoper2a80719fd449\Symfony\Component\HttpKernel\KernelInterface;
use _PhpScoper2a80719fd449\Symfony\Contracts\Service\ResetInterface;
use Symplify\PackageBuilder\Contract\HttpKernel\ExtraConfigAwareKernelInterface;
use Symplify\PackageBuilder\Exception\HttpKernel\MissingInterfaceException;
use Symplify\SymplifyKernel\Exception\ShouldNotHappenException;
/**
 * Inspiration
 * @see https://github.com/symfony/symfony/blob/master/src/Symfony/Bundle/FrameworkBundle/Test/KernelTestCase.php
 */
abstract class AbstractKernelTestCase extends \_PhpScoper2a80719fd449\PHPUnit\Framework\TestCase
{
    /**
     * @var KernelInterface
     */
    protected static $kernel;
    /**
     * @var ContainerInterface|Container
     */
    protected static $container;
    /**
     * @param string[] $configs
     */
    protected function bootKernelWithConfigs(string $kernelClass, array $configs) : \_PhpScoper2a80719fd449\Symfony\Component\HttpKernel\KernelInterface
    {
        $configsHash = $this->resolveConfigsHash($configs);
        $this->ensureKernelShutdown();
        $kernel = new $kernelClass('test_' . $configsHash, \true);
        if (!$kernel instanceof \_PhpScoper2a80719fd449\Symfony\Component\HttpKernel\KernelInterface) {
            throw new \Symplify\SymplifyKernel\Exception\ShouldNotHappenException();
        }
        $this->ensureIsConfigAwareKernel($kernel);
        /** @var ExtraConfigAwareKernelInterface $kernel */
        $kernel->setConfigs($configs);
        static::$kernel = $this->bootAndReturnKernel($kernel);
        return static::$kernel;
    }
    protected function bootKernel(string $kernelClass) : void
    {
        $this->ensureKernelShutdown();
        $kernel = new $kernelClass('test', \true);
        if (!$kernel instanceof \_PhpScoper2a80719fd449\Symfony\Component\HttpKernel\KernelInterface) {
            throw new \Symplify\SymplifyKernel\Exception\ShouldNotHappenException();
        }
        static::$kernel = $this->bootAndReturnKernel($kernel);
    }
    /**
     * Shuts the kernel down if it was used in the test.
     */
    protected function ensureKernelShutdown() : void
    {
        if (static::$kernel !== null) {
            // make sure boot() is called
            // @see https://github.com/symfony/symfony/pull/31202/files
            $kernelReflectionClass = new \ReflectionClass(static::$kernel);
            $containerPropertyReflection = $kernelReflectionClass->getProperty('container');
            $containerPropertyReflection->setAccessible(\true);
            $kernel = $containerPropertyReflection->getValue(static::$kernel);
            if ($kernel !== null) {
                $container = static::$kernel->getContainer();
                static::$kernel->shutdown();
                if ($container instanceof \_PhpScoper2a80719fd449\Symfony\Contracts\Service\ResetInterface) {
                    $container->reset();
                }
            }
        }
        static::$container = null;
    }
    private function resolveConfigsHash(array $configs) : string
    {
        $configsHash = '';
        foreach ($configs as $config) {
            $configsHash .= \md5_file($config);
        }
        return \md5($configsHash);
    }
    private function ensureIsConfigAwareKernel(\_PhpScoper2a80719fd449\Symfony\Component\HttpKernel\KernelInterface $kernel) : void
    {
        if ($kernel instanceof \Symplify\PackageBuilder\Contract\HttpKernel\ExtraConfigAwareKernelInterface) {
            return;
        }
        throw new \Symplify\PackageBuilder\Exception\HttpKernel\MissingInterfaceException(\sprintf('"%s" is missing an "%s" interface', \get_class($kernel), \Symplify\PackageBuilder\Contract\HttpKernel\ExtraConfigAwareKernelInterface::class));
    }
    private function bootAndReturnKernel(\_PhpScoper2a80719fd449\Symfony\Component\HttpKernel\KernelInterface $kernel) : \_PhpScoper2a80719fd449\Symfony\Component\HttpKernel\KernelInterface
    {
        $kernel->boot();
        $container = $kernel->getContainer();
        // private → public service hack?
        if ($container->has('test.service_container')) {
            $container = $container->get('test.service_container');
        }
        if (!$container instanceof \_PhpScoper2a80719fd449\Psr\Container\ContainerInterface) {
            throw new \Symplify\SymplifyKernel\Exception\ShouldNotHappenException();
        }
        // has output? keep it silent out of tests
        if ($container->has(\_PhpScoper2a80719fd449\Symfony\Component\Console\Style\SymfonyStyle::class)) {
            $symfonyStyle = $container->get(\_PhpScoper2a80719fd449\Symfony\Component\Console\Style\SymfonyStyle::class);
            $symfonyStyle->setVerbosity(\_PhpScoper2a80719fd449\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_QUIET);
        }
        static::$container = $container;
        return $kernel;
    }
}
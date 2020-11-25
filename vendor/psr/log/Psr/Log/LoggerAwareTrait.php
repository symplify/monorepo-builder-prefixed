<?php

namespace _PhpScoper3d7663d13234\Psr\Log;

/**
 * Basic Implementation of LoggerAwareInterface.
 */
trait LoggerAwareTrait
{
    /** @var LoggerInterface */
    protected $logger;
    /**
     * Sets a logger.
     * 
     * @param LoggerInterface $logger
     */
    public function setLogger(\_PhpScoper3d7663d13234\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}

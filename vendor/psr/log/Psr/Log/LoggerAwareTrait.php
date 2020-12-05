<?php

namespace _PhpScoperd607abf1de8e\Psr\Log;

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
    public function setLogger(\_PhpScoperd607abf1de8e\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}

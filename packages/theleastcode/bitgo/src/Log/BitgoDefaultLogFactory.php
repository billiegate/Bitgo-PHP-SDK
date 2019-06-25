<?php

namespace Log;

use Psr\Log\LoggerInterface;

/**
 * Class BitgoDefaultLogFactory
 *
 * This factory is the default implementation of Log factory.
 *
 * @package Log
 */
class BitgoDefaultLogFactory implements BitgoLogFactory
{
    /**
     * Returns logger instance implementing LoggerInterface.
     *
     * @param string $className
     * @return LoggerInterface instance of logger object implementing LoggerInterface
     */
    public function getLogger($className)
    {
        return new BitgoLogger($className);
    }
}

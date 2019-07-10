<?php

namespace Handler;

/**
 * Interface IBitgoHandler
 *
 * @package Handler
 */
interface IBitgoHandler
{
    /**
     *
     * @param \Core\BitgoHttpConfig $httpConfig
     * @param string $request
     * @param mixed $options
     * @return mixed
     */
    public function handle($httpConfig, $request, $options);
}

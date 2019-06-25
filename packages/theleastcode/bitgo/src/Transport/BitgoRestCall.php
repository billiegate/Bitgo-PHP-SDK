<?php
namespace Transport;

use Core\BitgoHttpConfig;
use Core\BitgoHttpConnection;
use Core\BitgoLoggingManager;
use Rest\ApiContext;

/**
 * Class BitgoRestCall
 *
 * @package Transport
 */
class BitgoRestCall
{


    /**
     * Bitgo Logger
     *
     * @var BitgoLoggingManager logger interface
     */
    private $logger;

    /**
     * API Context
     *
     * @var ApiContext
     */
    private $apiContext;


    /**
     * Default Constructor
     *
     * @param ApiContext $apiContext
     */
    public function __construct(ApiContext $apiContext)
    {
        $this->apiContext = $apiContext;
        $this->logger = BitgoLoggingManager::getInstance(__CLASS__);
    }

    /**
     * @param array  $handlers Array of handlers
     * @param string $path     Resource path relative to base service endpoint
     * @param string $method   HTTP method - one of GET, POST, PUT, DELETE, PATCH etc
     * @param string $data     Request payload
     * @param array  $headers  HTTP headers
     * @return mixed
     * @throws \Exception\BitgoConnectionException
     */
    public function execute($handlers = array(), $path, $method, $data = '', $headers = array())
    {
        $config = $this->apiContext->getConfig();
        $httpConfig = new BitgoHttpConfig(null, $method, $config);
        $headers = $headers ? $headers : array();
        $httpConfig->setHeaders($headers +
            array(
                'Content-Type' => 'application/json'
            )
        );

        // if proxy set via config, add it
        if (!empty($config['http.Proxy'])) {
            $httpConfig->setHttpProxy($config['http.Proxy']);
        }

        /** @var \Handler\IBitgoHandler $handler */
        foreach ($handlers as $handler) {
            if (!is_object($handler)) {
                $fullHandler = "\\" . (string)$handler;
                $handler = new $fullHandler($this->apiContext);
            }
            $handler->handle($httpConfig, $data, array('path' => $path, 'apiContext' => $this->apiContext));
        }
        $connection = new BitgoHttpConnection($httpConfig, $config);
        $response = $connection->execute($data);

        return $response;
    }
}

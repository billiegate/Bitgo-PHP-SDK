<?php
/**
 * API handler for OAuth Token Request REST API calls
 */

namespace Handler;

use Common\BitgoUserAgent;
use Core\BitgoConstants;
use Core\BitgoHttpConfig;
use Exception\BitgoConfigurationException;
use Exception\BitgoInvalidCredentialException;
use Exception\BitgoMissingCredentialException;

/**
 * Class OauthHandler
 */
class OauthHandler implements IBitgoHandler
{
    /**
     * Private Variable
     *
     * @var Rest\ApiContext $apiContext
     */
    private $apiContext;

    /**
     * Construct
     *
     * @param Rest\ApiContext $apiContext
     */
    public function __construct($apiContext)
    {
        $this->apiContext = $apiContext;
    }

    /**
     * @param BitgoHttpConfig $httpConfig
     * @param string                    $request
     * @param mixed                     $options
     * @return mixed|void
     * @throws BitgoConfigurationException
     * @throws BitgoInvalidCredentialException
     * @throws BitgoMissingCredentialException
     */
    public function handle($httpConfig, $request, $options)
    {
        $config = $this->apiContext->getConfig();

        $httpConfig->setUrl(
            rtrim(trim($this->_getEndpoint($config)), '/') .
            (isset($options['path']) ? $options['path'] : '')
        );

        $headers = array(
            "User-Agent"    => BitgoUserAgent::getValue(BitgoConstants::SDK_NAME, BitgoConstants::SDK_VERSION),
            "Authorization" => "Basic " . base64_encode($options['clientId'] . ":" . $options['clientSecret']),
            "Accept"        => "*/*"
        );
        $httpConfig->setHeaders($headers);

        // Add any additional Headers that they may have provided
        $headers = $this->apiContext->getRequestHeaders();
        foreach ($headers as $key => $value) {
            $httpConfig->addHeader($key, $value);
        }
    }

    /**
     * Get HttpConfiguration object for OAuth API
     *
     * @param array $config
     *
     * @return BitgoHttpConfig
     * @throws Exception\BitgoConfigurationException
     */
    private static function _getEndpoint($config)
    {
        if (isset($config['oauth.EndPoint'])) {
            $baseEndpoint = $config['oauth.EndPoint'];
        } elseif (isset($config['service.EndPoint'])) {
            $baseEndpoint = $config['service.EndPoint'];
        } elseif (isset($config['mode'])) {
            switch (strtoupper($config['mode'])) {
                case 'TEST':
                    $baseEndpoint = BitgoConstants::REST_TEST_ENDPOINT;
                    break;
                case 'LIVE':
                    $baseEndpoint = BitgoConstants::REST_LIVE_ENDPOINT;
                    break;
                default:
                    throw new BitgoConfigurationException('The mode config parameter must be set to either test/live');
            }
        } else {
            // Defaulting to test
            $baseEndpoint = BitgoConstants::REST_TEST_ENDPOINT;
        }

        $baseEndpoint = rtrim(trim($baseEndpoint), '/') . "/v1/oauth2/token";

        return $baseEndpoint;
    }
}

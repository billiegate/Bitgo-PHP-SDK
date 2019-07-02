<?php
/**
 * API handler for all REST API calls
 */

namespace Handler;

use Auth\OAuthTokenCredential;
use Common\BitgoUserAgent;
use Core\BitgoConstants;
use Core\BitgoCredentialManager;
use Core\BitgoHttpConfig;
use Exception\BitgoConfigurationException;
use Exception\BitgoInvalidCredentialException;
use Exception\BitgoMissingCredentialException;

/**
 * Class RestHandler
 */
class RestHandler implements IBitgoHandler
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
        $credential = $this->apiContext->getCredential();
        $config = $this->apiContext->getConfig();

        if ($credential == null) {
            // Try picking credentials from the config file
            $credMgr = BitgoCredentialManager::getInstance($config);
            $credValues = $credMgr->getCredentialObject();

            if (!is_array($credValues)) {
                throw new BitgoMissingCredentialException("Empty or invalid credentials passed");
            }

            $credential = new OAuthTokenCredential($credValues['clientId'], $credValues['clientSecret']);
        }

        if ($credential == null || !($credential instanceof OAuthTokenCredential)) {
            throw new BitgoInvalidCredentialException("Invalid credentials passed");
        }

        $httpConfig->setUrl(
            rtrim(trim($this->_getEndpoint($config)), '/') .
            (isset($options['path']) ? $options['path'] : '')
        );

        // Overwrite Expect Header to disable 100 Continue Issue
        $httpConfig->addHeader("Expect", null);

        if (!array_key_exists("User-Agent", $httpConfig->getHeaders())) {
            $httpConfig->addHeader("User-Agent", BitgoUserAgent::getValue(BitgoConstants::SDK_NAME, BitgoConstants::SDK_VERSION));
        }

        if (!is_null($credential) && $credential instanceof OAuthTokenCredential && is_null($httpConfig->getHeader('Authorization'))) {
            $httpConfig->addHeader('Authorization', "Bearer " . $credential->getAccessToken($config), false);
        }

        if (($httpConfig->getMethod() == 'POST' || $httpConfig->getMethod() == 'PUT') && !is_null($this->apiContext->getRequestId())) {
            $httpConfig->addHeader('Bitgo-Request-Id', $this->apiContext->getRequestId());
        }
        // Add any additional Headers that they may have provided
        $headers = $this->apiContext->getRequestHeaders();
        foreach ($headers as $key => $value) {
            $httpConfig->addHeader($key, $value);
        }
    }

    /**
     * End Point
     *
     * @param array $config
     *
     * @return string
     * @throws Exception\BitgoConfigurationException
     */
    private function _getEndpoint($config)
    {
        if (isset($config['service.EndPoint'])) {
            return $config['service.EndPoint'];
        } elseif (isset($config['mode'])) {
            switch (strtoupper($config['mode'])) {
                case 'TEST':
                    return BitgoConstants::REST_TEST_ENDPOINT;
                    break;
                case 'LIVE':
                    return BitgoConstants::REST_LIVE_ENDPOINT;
                    break;
                default:
                    throw new BitgoConfigurationException('The mode config parameter must be set to either test/live');
                    break;
            }
        } else {
            // Defaulting to test
            return BitgoConstants::REST_TEST_ENDPOINT;
        }
    }
}

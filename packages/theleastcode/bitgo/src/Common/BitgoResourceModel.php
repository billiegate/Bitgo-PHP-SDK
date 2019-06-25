<?php

namespace\Common;

use Rest\ApiContext;
use Rest\IResource;
use Transport\BitgoRestCall;

/**
 * Class BitgoResourceModel
 * An Executable BitgoModel Class
 *
 * @property \Api\Links[] links
 * @package \Common
 */
class BitgoResourceModel extends BitgoModel implements IResource
{

    /**
     * Sets Links
     *
     * @param \Api\Links[] $links
     *
     * @return $this
     */
    public function setLinks($links)
    {
        $this->links = $links;
        return $this;
    }

    /**
     * Gets Links
     *
     * @return \Api\Links[]
     */
    public function getLinks()
    {
        return $this->links;
    }

    public function getLink($rel)
    {
        if (is_array($this->links)) {
            foreach ($this->links as $link) {
                if ($link->getRel() == $rel) {
                    return $link->getHref();
                }
            }
        }
        return null;
    }

    /**
     * Append Links to the list.
     *
     * @param \Api\Links $links
     * @return $this
     */
    public function addLink($links)
    {
        if (!$this->getLinks()) {
            return $this->setLinks(array($links));
        } else {
            return $this->setLinks(
                array_merge($this->getLinks(), array($links))
            );
        }
    }

    /**
     * Remove Links from the list.
     *
     * @param \Api\Links $links
     * @return $this
     */
    public function removeLink($links)
    {
        return $this->setLinks(
            array_diff($this->getLinks(), array($links))
        );
    }


    /**
     * Execute SDK Call to Bitgo services
     *
     * @param string      $url
     * @param string      $method
     * @param string      $payLoad
     * @param array $headers
     * @param ApiContext      $apiContext
     * @param BitgoRestCall      $restCall
     * @param array $handlers
     * @return string json response of the object
     */
    protected static function executeCall($url, $method, $payLoad, $headers = array(), $apiContext = null, $restCall = null, $handlers = array('Handler\RestHandler'))
    {
        //Initialize the context and rest call object if not provided explicitly
        $apiContext = $apiContext ? $apiContext : new ApiContext(self::$credential);
        $restCall = $restCall ? $restCall : new BitgoRestCall($apiContext);

        //Make the execution call
        $json = $restCall->execute($handlers, $url, $method, $payLoad, $headers);
        return $json;
    }

    /**
     * Updates Access Token using long lived refresh token
     *
     * @param string|null $refreshToken
     * @param ApiContext $apiContext
     * @return void
     */
    public function updateAccessToken($refreshToken, $apiContext)
    {
        $apiContext = $apiContext ? $apiContext : new ApiContext(self::$credential);
        $apiContext->getCredential()->updateAccessToken($apiContext->getConfig(), $refreshToken);
    }
}

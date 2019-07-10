<?php

namespace Api\Address;

use Common\BitgoResourceModel;
use Core\BitgoConstants;
use Validation\ArgumentValidator;
use Rest\ApiContext;

/**
 * Class VerifyAddress
 *
 * Verify address for a given coin.
 *
 * @package Api\Address
 * 
 * @property string $coin
 * @property string $address
 * @property boolean $isValid
 */

class VerifyAddress Extends BitgoResourceModel
{
    /**
     * Example BTC.
     *
     * @param string $coin
     * 
     * @return $this
     */
    public function setCoin($coin)
    {
        $this->coin = $coin;
        return $this;
    }

    /**
     * type of the coin created.
     *
     * @return string
     */
    public function getCoin()
    {
        return $this->coin;
    }

    /**
     * Address
     *
     * @param string $address
     * 
     * @return $this
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * Address.
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Is address a valid coin address
     *
     * @param string $isValid
     * 
     * @return $this
     */
    public function setIsValid($isValid)
    {
        $this->isValid = $isValid;
        return $this;
    }

    /**
     * isValid.
     *
     * @return string
     */
    public function getIsValid()
    {
        return $this->isValid;
    }

    /**
     *
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration and credentials.
     * @param BitgoRestCall $restCall is the Rest Call Service that is used to make rest calls
     * @return isValid
     */
    public static function get($apiContext = null, $restCall = null)
    {
        $payLoad = $this->toJSON();
        $json = self::executeCall(
            "/{$this->getCoin()}/verifyaddress",
            "POST",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $this->fromJson($json);
        return $this;
    }

}

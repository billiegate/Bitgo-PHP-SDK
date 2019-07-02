<?php

namespace Api;

use Common\BitgoResourceModel;
use Core\BitgoConstants;
use Validation\ArgumentValidator;
use Rest\ApiContext;

/**
 * Class Payment
 *
 * Lets you create, process and manage payments.
 *
 * @package Api
 * 
 * @property string id
 * @property string address
 * @property int chain
 * @property string index
 * @property string coin
 * @property int lastNonce
 * @property string coinSpecific
 * @property string label
 * @property string addressType
 * @property Api\Wallet\Wallet wallet
 * @property boolean lowPriority
 * @property int|string gasPrice
 */

class Address Extends BitgoResourceModel
{
    /**
     * Identifier of the address resource created.
     *
     * @param string $id
     * 
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Identifier of the address resource created.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
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
     * Chains
     * Acceptable Values:0, 1, 10, 11, 20, 21
     * 
     * @param string $chain
     * 
     * @return $this
     */
    public function setChain($chain)
    {
        $this->chain = $chain;
        return $this;
    }

    /**
     * Chains
     * 
     * @return string
     */
    public function getChain()
    {
        return $this->chain;
    }

    /**
     * Index.
     * @param int $index
     * 
     * @return $this
     */
    public function setIndex($index)
    {
        $this->index = $index;
        return $this;
    }

    /**
     * Index.
     * @return int
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * Coin
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
     * Coin
     * 
     * @return string
     */
    public function getCoin()
    {
        return $this->coin;
    }

    /**
     * Last Nonce of the block
     *
     * @param int $lastNonce
     * 
     * @return $this
     */
    public function setLastNonce($lastNonce)
    {
        $this->lastNonce = $lastNonce;
        return $this;
    }

    /**
     * Last Nonce of the block
     *
     * @return int
     */
    public function getLastNonce()
    {
        return $this->lastNonce;
    }

    /**
     * Wallet this address belongs to
     *
     * @param string Api\Wallet\Wallet $wallet
     * 
     * @return $this
     */
    public function setWallet($wallet)
    {
        $this->wallet = $wallet;
        return $this;
    }

    /**
     * Wallet this address belongs to
     *
     * @return string Api\Wallet\Wallet
     */
    public function getWallet()
    {
        return $this->wallet;
    }

    /**
     * Address label
     *
     * @param string $label
     * 
     * @return $this
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * Address label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Address Type
     * Acceptable values "p2sh", "p2sh-p2wsh", "p2wsh"
     * 
     * @param string $addressType
     * 
     * @return $this
     */
    public function setAddressType($addressType)
    {
        $this->addressType = $addressType;
        return $this;
    }

    /**
     * Address Type
     *
     * @return string
     */
    public function getAddressType()
    {
        return $this->addressType;
    }

    /**
     * Whether the deployment of the address forwarder contract 
     * should use a low priority fee key (ETH only)
     * 
     * @param boolean $lowPriority
     * 
     * @return $this
     */
    public function setLowPriority($lowPriority)
    {
        $this->lowPriority = $lowPriority;
        return $this;
    }

    /**
     * Address foworder selected
     *
     * @return boolean
     */
    public function getLowPriority()
    {
        return $this->lowPriority ? $this->lowPriority : false;
    }

    /**
     * Explicit gas price to use when deploying the forwarder contract (ETH only). 
     * If not given, defaults to the current estimated network gas price.
     * 
     * @param int|string $gasPrice
     * 
     * @return $this
     */
    public function setGasPrice($gasPrice)
    {
        $this->gasPrice = $gasPrice;
        return $this;
    }

    /**
     * Gas price provided
     *
     * @return int|string
     */
    public function getGasPrice()
    {
        return $this->gasPrice;
    }

    /**
     * Append FailedTransactions to the list.
     * @deprecated Not publicly available
     * @param \PayPal\Api\Error $error
     * @return $this
     */
    public function addFailedTransaction($error)
    {
        if (!$this->getFailedTransactions()) {
            return $this->setFailedTransactions(array($error));
        } else {
            return $this->setFailedTransactions(
                array_merge($this->getFailedTransactions(), array($error))
            );
        }
    }

    /**
     * Remove FailedTransactions from the list.
     * @deprecated Not publicly available
     * @param \PayPal\Api\Error $error
     * @return $this
     */
    public function removeFailedTransaction($error)
    {
        return $this->setFailedTransactions(
            array_diff($this->getFailedTransactions(), array($error))
        );
    }
	
    /**
     * This API call is used to create a new receive address for your wallet. 
     * You may choose to call this API whenever a deposit is made. 
     * The BitGo API supports millions of addresses.
     *
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration and credentials.
     * @param BitgoRestCall $restCall is the Rest Call Service that is used to make rest calls
     * @return Address
     */
    public function create($apiContext = null, $restCall = null)
    {
        $payLoad = $this->toJSON();
        $json = self::executeCall(
            "/{coin}/wallet/{id}/address",
            "POST",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $this->fromJson($json);
        return $this;
    }

    /**
     * Gets a receive address on a wallet
     *
     * @param string $paymentId
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration and credentials.
     * @param BitgoRestCall $restCall is the Rest Call Service that is used to make rest calls
     * @return Payment
     */
    public static function get($paymentId, $apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($paymentId, 'paymentId');
        $payLoad = "";
        $addressOrId = $this->getWallet()->getAddress() || $this->getWallet()->getId();
        $json = self::executeCall(
            "/{$this->getCoin()}/wallet/{$this->getId()}/address/{$addressOrId}",
            "GET",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new Payment();
        $ret->fromJson($json);
        return $ret;
    }

    /**
     * Update a receive address on a wallet.
     *
     * @param PatchRequest $patchRequest
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration and credentials.
     * @param BitgoRestCall $restCall is the Rest Call Service that is used to make rest calls
     * @return boolean
     */
    public function update($patchRequest, $apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($this->getId(), "Id");
        ArgumentValidator::validate($patchRequest, 'patchRequest');
        $payLoad = $patchRequest->toJSON();
        $addressOrId = $this->getWallet()->getAddress() || $this->getWallet()->getId();
        self::executeCall(
            "/{$this->getCoin()}/wallet/{$this->getId()}/address/{$addressOrId}",
            "PUT",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        return true;
    }

    /**
     * List payments that were made to the merchant who issues the request. Payments can be in any state.
     *
     * @param array $params
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration and credentials.
     * @param PayPalRestCall $restCall is the Rest Call Service that is used to make rest calls
     * @return PaymentHistory
     */
    public static function all($params, $apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($params, 'params');
        $payLoad = "";
        $allowedParams = array(
                    'labelContains' => 1,
                    'limit' => 1,
                    'mine' => 1,
                    'prevId' => 1,
                    'chains' => 1,
                    'sort' => 1,
        );
        $json = self::executeCall(
            "/{$this->getCOin()}/wallet/{$this->getWallet()->getId()}/addresses?" . http_build_query(array_intersect_key($params, $allowedParams)),
            "GET",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new Addresses();
        $ret->fromJson($json);
        return $ret;
    }

}

<?php

namespace Api\Transaction;

use Common\BitgoResourceModel;
use Core\BitgoConstants;
use Validation\ArgumentValidator;
use Rest\ApiContext;

/**
 * Class Transaction
 *
 * Transaction object and queries
 *
 * @package Api\Transaction
 * 
 * @property string $coin
 * @property string $address
 * @property string $message
 * @property string $data
 * @property string $walletPassphrase
 * @property string $prv
 * @property integer $amount
 * @property integer $minConfirms
 * @property boolean $enforceMinConfirmsForChange
 */

class Transaction Extends BitgoResourceModel
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
     * Destination address
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
     * Optional message to attach to transaction
     *
     * @param string $message
     * 
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Optional data to pass to transaction (ETH specific)
     *
     * @param string $data
     * 
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * data.
     *
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Passphrase to decrypt the user key on the wallet
     *
     * @param string $walletPassphrase
     * 
     * @return $this
     */
    public function setWalletPassphrase($walletPassphrase)
    {
        $this->walletPassphrase = $walletPassphrase;
        return $this;
    }

    /**
     * walletPassphrase.
     *
     * @return string
     */
    public function getWalletPassphrase()
    {
        return $this->walletPassphrase;
    }

    /**
     * Private key in string form, if walletPassphrase is not available
     *
     * @param string $prv
     * 
     * @return $this
     */
    public function setPrv($prv)
    {
        $this->prv = $prv;
        return $this;
    }

    /**
     * prv.
     *
     * @return string
     */
    public function getPrv()
    {
        return $this->prv;
    }

    /**
     * Minimum confirmation threshold for inputs
     *
     * @param string $minConfirms
     * 
     * @return $this
     */
    public function setMinConfirms($minConfirms)
    {
        $this->minConfirms = $minConfirms;
        return $this;
    }

    /**
     * minConfirms.
     *
     * @return string
     */
    public function getMinConfirms()
    {
        return $this->minConfirms;
    }

    /**
     * Flag for enforcing minConfirms for change inputs
     *
     * @param boolean $enforceMinConfirmsForChange
     * 
     * @return $this
     */
    public function setEnforceMinConfirmsForChange($enforceMinConfirmsForChange)
    {
        $this->enforceMinConfirmsForChange = $enforceMinConfirmsForChange;
        return $this;
    }

    /**
     * enforceMinConfirmsForChange.
     *
     * @return boolean
     */
    public function getEnforceMinConfirmsForChange()
    {
        return $this->enforceMinConfirmsForChange;
    }

    /**
     * Amount in base units (e.g. satoshi, wei, drops, stroops)
     *
     * @param string $amount
     * 
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * amount.
     *
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
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

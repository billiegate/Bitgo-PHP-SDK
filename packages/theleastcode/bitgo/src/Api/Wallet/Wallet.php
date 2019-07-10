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
 * @property string label
 * @property string passphrase
 * @property string userKey
 * @property string backupXpub
 * @property string backupXpubProvider
 * @property string enterprise
 * @property boolean disableTransactionNotifications
 * @property string passcodeEncryptionCode
 * @property string coldDerivationSeed
 * @property integer gasPrice
 * @property boolean disableKRSEmail
 */

class Address Extends BitgoResourceModel
{
    /**
     * Identifier of the wallet resource created.
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
     * return set label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Passphrase to be used to encrypt the user key on the wallet.
     *
     * @param string $passphrase
     * 
     * @return $this
     */
    public function setPassphrase($passphrase)
    {
        $this->passphrase = $passphrase;
        return $this;
    }

    /**
     * passphrase.
     *
     * @return string
     */
    public function getPassphrase()
    {
        return $this->passphrase;
    }
    

    /**
     * User provided public key
     * 
     * @param string $userKey
     * 
     * @return $this
     */
    public function setUserKey($userKey)
    {
        $this->userKey = $userKey;
        return $this;
    }

    /**
     * user Key
     * 
     * @return string
     */
    public function getUserKey()
    {
        return $this->userKey;
    }

    /**
     * User provided backup public key.
     * @param string $backupXpub
     * 
     * @return $this
     */
    public function setBackupXpub($backupXpub)
    {
        $this->backupXpub = $backupXpub;
        return $this;
    }

    /**
     * backupXpub.
     * @return string
     */
    public function getBackupXpub()
    {
        return $this->backupXpub;
    }

    /**
     * Value:"keyternal"
     * Optional key recovery service to provide and store the backup key
     * 
     * @param string $backupXpubProvider
     * 
     * @return $this
     */
    public function setBackupXpubProvider($backupXpubProvider)
    {
        $this->backupXpubProvider = $backupXpubProvider;
        return $this;
    }

    /**
     * backupXpubProvider
     * 
     * @return string
     */
    public function getBackupXpubProvider()
    {
        return $this->backupXpubProvider;
    }

    /**
     * Enteprise
     *
     * @param int $enterprise
     * 
     * @return $this
     */
    public function setEnterprise($enterprise)
    {
        $this->enterprise = $enterprise;
        return $this;
    }

    /**
     * enterprise
     *
     * @return int
     */
    public function getEnterprise()
    {
        return $this->enterprise;
    }

    /**
     * Flag for disabling wallet transaction notifications
     *
     * @param boolean $disableTransactionNotifications
     * 
     * @return $this
     */
    public function setDisableTransactionNotifications($disableTransactionNotifications)
    {
        $this->disableTransactionNotifications = $disableTransactionNotifications;
        return $this;
    }

    /**
     * disableTransactionNotifications
     *
     * @return string
     */
    public function getDisableTransactionNotifications()
    {
        return $this->disableTransactionNotifications;
    }

    /**
     * The passphrase used for decrypting the encrypted user 
     * private key during wallet recovery
     *
     * @param string $passcodeEncryptionCode
     * 
     * @return $this
     */
    public function setPasscodeEncryptionCode($passcodeEncryptionCode)
    {
        $this->passcodeEncryptionCode = $passcodeEncryptionCode;
        return $this;
    }

    /**
     * Passcode EncryptionCode
     *
     * @return string
     */
    public function getPasscodeEncryptionCode()
    {
        return $this->passcodeEncryptionCode;
    }

    /**
     * Seed used to derive an extended user key for a cold wallet
     * 
     * @param string $coldDerivationSeed
     * 
     * @return $this
     */
    public function setColdDerivationSeed($coldDerivationSeed)
    {
        $this->coldDerivationSeed = $coldDerivationSeed;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getColdDerivationSeed()
    {
        return $this->coldDerivationSeed;
    }

    /**
     * Gas price to use when deploying an Ethereum wallet
     * 
     * @param integer $gasPrice
     * 
     * @return $this
     */
    public function setGasPrice($gasPrice)
    {
        $this->gasPrice = $gasPrice;
        return $this;
    }

    /**
     *
     * @return integer
     */
    public function getGasPrice()
    {
        return $this->gasPrice;
    }

    /**
     * Flag for preventing KRS from sending email after creating backup key
     * 
     * @param boolean $disableKRSEmail
     * 
     * @return $this
     */
    public function setDisableKRSEmail($disableKRSEmail)
    {
        $this->disableKRSEmail = $disableKRSEmail;
        return $this;
    }

    /**
     * Gas price provided
     *
     * @return boolean
     */
    public function getDisableKRSEmail()
    {
        return $this->disableKRSEmail;
    }
	
    /**
     * This API call creates a new wallet. Under the hood, the SDK (or BitGo Express) does the following:
     * 1. Creates the user keychain locally on the machine, and encrypts it with the provided passphrase (skipped if userKey is provided).
     * 2. Creates the backup keychain locally on the machine.
     * 3. Uploads the encrypted user keychain and public backup keychain.
     * 4. Creates the BitGo key (and the backup key if backupXpubProvider is set) on the service.
     * 5. Creates the wallet on BitGo with the 3 public keys above.
     * 
     * Ethereum wallets can only be created under an enterprise. Pass in the id of the enterprise to 
     * associate the wallet with. Your enterprise id can be seen by clicking on the “Manage 
     * Organization” link on the enterprise dropdown. Each enterprise has a fee address 
     * which will be used to pay for transaction fees on all Ethereum wallets in that 
     * enterprise. The fee address is displayed in the dashboard of the website, 
     * please fund it before creating a wallet.
     * 
     * You cannot generate a wallet by passing in an ERC20 token as the coin. ERC20 tokens share 
     * Ethereum wallets and it is not possible to create a wallet specific to one token. 
     * Please see Coin-Specific Implementation for details.
     * 
     * This endpoint should be called through BitGo Express if used without the SDK, such as when 
     * using cURL.
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

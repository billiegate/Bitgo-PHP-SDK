<?php

namespace Api\Policy;

use Common\BitgoResourceModel;
use Core\BitgoConstants;
use Validation\ArgumentValidator;
use Rest\ApiContext;

/**
 * Class Policy
 *
 * Lets you create, process and manage policies.
 *
 * @package Api
 * 
 * @property string id
 * @property string admin
 * @property int approvalsRequired
 * @property string coin
 * @property string coinSpecific
 * @property boolean allowBackupKeySigning
 * @property boolean deleted
 * @property boolean disableTransactionNotifications
 * @property string enterprise
 * @property string ethFeeAddress
 * @property string freeze
 * @property string label
 * @property boolean isCold
 * @property string array[] keys
 * @property int m
 * @property int n
 * @property Api\Address\Address receiveAddress
 * @property boolean recoverable
 * @property string array[] tags
 * @property string type
 * @property Api\User\User[] users
 * @property Api\Policy\Condition condition
 * @property Api\Policy\Action action
 */

class Policy Extends BitgoResourceModel
{
    /**
     * Identifier of the policy resource created.
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
     * How many Enterprise Admins are required for action to fire
     *
     * @param int $approvalsRequired
     * 
     * @return $this
     */
    public function setApprovalsRequired($approvalsRequired)
    {
        $this->approvalsRequired = $approvalsRequired;
        return $this;
    }

    /**
     * Numbers of approvals required.
     *
     * @return int
     */
    public function getApprovalsRequired()
    {
        return $this->approvalsRequired;
    }

    /**
     * If set, the rule will only apply to the given coin or ERC20 token 
     * in an Ethereum wallet. It is generally recommended 
     * to not set a coin for policy rules of 
     * the following types:
     * 
     * Acceptable Values: advancedWhitelist, allTx, coinAddressWhitelist, coinAddressBlacklist, webhook.
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
     * Type.
     * Acceptable Values: "advancedWhitelist" "allTx" "coinAddressWhitelist" "coinAddressBlacklist" "velocityLimit" "webhook"
     * 
     * @param string $type
     * 
     * @return $this
     */
    // public function setType($type)
    // {
    //     $this->type = $type;
    //     return $this;
    // }

    /**
     * Type.
     *
     * @return string
     */
    // public function getType()
    // {
    //     return $this->type;
    // }

    /**
     * Back up key sigining.
     * 
     * @param boolean $allowBackupKeySigning
     * 
     * @return $this
     */
    public function setAllowBackupKeySigning($allowBackupKeySigning)
    {
        $this->allowBackupKeySigning = $allowBackupKeySigning;
        return $this;
    }

    /**
     * allowBackupKeySigning.
     *
     * @return boolean
     */
    public function getAllowBackupKeySigning()
    {
        return $this->allowBackupKeySigning;
    }

    /**
     * Approvals Required.
     * 
     * @param boolean $isCold
     * 
     * @return $this
     */
    public function setIsCold($isCold)
    {
        $this->isCold = $isCold;
        return $this;
    }

    /**
     *
     * @return boolean
     */
    public function getIsCold()
    {
        return $this->isCold;
    }

    /**
     * keys.
     * 
     * @param string arrays $keys
     * 
     * @return $this
     */
    public function setKeys($keys)
    {
        $this->keys = $keys;
        return $this;
    }

    /**
     *
     * @return string array[]
     */
    public function getKeys()
    {
        return $this->keys;
    }

    /**
     * Coin specific.
     * 
     * @param object $coinSpecific
     * 
     * @return $this
     */
    public function setCoinSpecific($coinSpecific)
    {
        $this->coinSpecific = $coinSpecific;
        return $this;
    }

    /**
     *
     * @return object
     */
    public function getCoinSpecific()
    {
        return $this->coinSpecific;
    }

    /**
     * Deleted.
     * 
     * @param boolean $deleted
     * 
     * @return $this
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
        return $this;
    }

    /**
     *
     * @return boolean
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Disable Transaction Notifications.
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
     *
     * @return boolean
     */
    public function getDisableTransactionNotifications()
    {
        return $this->disableTransactionNotifications;
    }

    /**
     * enterprise.
     * 
     * @param string $enterprise
     * 
     * @return $this
     */
    public function setEnterprise($enterprise)
    {
        $this->enterprise = $enterprise;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getEnterprise()
    {
        return $this->enterprise;
    }

    /**
     * freeze.
     * 
     * @param Api\Wallet\Freeze $freeze
     * 
     * @return $this
     */
    public function setFreeze($freeze)
    {
        $this->freeze = $freeze;
        return $this;
    }

    /**
     *
     * @return Api\Wallet\Freeze
     */
    public function getFreeze()
    {
        return $this->freeze;
    }

    /**
     * label.
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
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Number of signatures required. This value must be 2 for hot wallets, 
     * 1 for ofc wallets, and not specified for custodial wallets..
     * 
     * @param integer $m
     * 
     * @return $this
     */
    public function setM($m)
    {
        $this->m = $m;
        return $this;
    }

    /**
     *
     * @return integer
     */
    public function getM()
    {
        return $this->m;
    }

    /**
     * Number of keys provided. This value must be 3 for hot wallets, 
     * 1 for ofc wallets, and not specified for custodial wallets
     * 
     * @param integer $n
     * 
     * @return $this
     */
    public function setN($n)
    {
        $this->n = $n;
        return $this;
    }

    /**
     *
     * @return integer
     */
    public function getN()
    {
        return $this->n;
    }

    /**
     * recoverable.
     * 
     * @param boolean $recoverable
     * 
     * @return $this
     */
    public function setRecoverable($recoverable)
    {
        $this->recoverable = $recoverable;
        return $this;
    }

    /**
     *
     * @return boolean
     */
    public function getRecoverable()
    {
        return $this->recoverable;
    }

    /**
     * tags.
     * 
     * @param string array[] $tags
     * 
     * @return $this
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     *
     * @return string array[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Enum:"custodial" "custodialPaired" The type describes who owns the keys 
     * to the wallet and how they are stored. custodial means that this 
     * wallet is a cold wallet where BitGo owns the keys. Only 
     * customers of the BitGo Trust can create this kind of 
     * wallet. custodialPaired means that this is a hot 
     * wallet that is owned by the customer but it 
     * will be linked to a cold (custodial) 
     * wallet where BitGo owns the keys. 
     * This option is only available 
     * to customers of BitGo Inc..
     * 
     * @param string $type
     * 
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * users.
     * 
     * @param Api\User\User array[] $users
     * 
     * @return $this
     */
    public function setUsers($users)
    {
        $this->users = $users;
        return $this;
    }

    /**
     *
     * @return Api\User\User array[]
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Adds a rule to a wallet’s policy. A wallet policy’s rules control the conditions 
     * under which BitGo will use its single key to sign a transaction. An email 
     * notification will be sent to all wallet users when a policy is updated. 
     * This email is NOT sent for the first time policy is added.
     *
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration and credentials.
     * @param BitgoRestCall $restCall is the Rest Call Service that is used to make rest calls
     * @return Address
     */
    public function add($apiContext = null, $restCall = null)
    {
        $payLoad = $this->toJSON();
        $json = self::executeCall(
            "/{coin}/wallet/{id}/policy/rule",
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
     * Updates a rule on the policy attached to a wallet.
     *
     * @param PatchRequest $patchRequest
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration and credentials.
     * @param BitgoRestCall $restCall is the Rest Call Service that is used to make rest calls
     * @return boolean
     */
    public function update($apiContext = null, $restCall = null)
    {
        $payLoad = $this->toJSON(); 
        $json = self::executeCall(
            "/{coin}/wallet/{id}/policy/rule",
            "PUT",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $this->fromJson($json);
        return $this;
    }

    /**
     * Update a receive address on a wallet.
     *
     * @param PatchRequest $patchRequest
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration and credentials.
     * @param BitgoRestCall $restCall is the Rest Call Service that is used to make rest calls
     * @return boolean
     */
    public function delete($patchRequest, $apiContext = null, $restCall = null)
    {
        $payLoad = $this->toJSON(); 
        self::executeCall(
            "/{coin}/wallet/{id}/policy/rule",
            "DELETE",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        return true;
    }
}
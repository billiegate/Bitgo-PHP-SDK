<?php

namespace Api;

use Common\BitgoResourceModel;
use Core\BitgoConstants;
use Validation\ArgumentValidator;
use Rest\ApiContext;

/**
 * Class Enterprise
 *
 * Lets you create, process and manage enterprises.
 *
 * @package Api
 * 
 * @property string id
 * @property string admin
 * @property int approvalsRequired
 * @property string bitgoEthKey
 * @property string bitgoOrg
 * @property boolean canCreateColdWallet
 * @property boolean canCreateCustodialWallets
 * @property boolean canCreateHotWallet
 * @property string emergencyPhone
 * @property string ethFeeAddress
 * @property string freeze
 * @property int mutablePolicyWindow
 * @property string name
 * @property string primaryContact
 * @property array tags
 * @property array Api\Wallet\Wallet[] wallets
 */

class Enterprise Extends BitgoResourceModel
{
    /**
     * Identifier of the enterprise resource created.
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
     * The public portion of the ethererum key generated for the 
     * enterprise fee address
     *
     * @param string $bitgoEthKey
     * 
     * @return $this
     */
    public function setBitgoEthKey($bitgoEthKey)
    {
        $this->bitgoEthKey = $bitgoEthKey;
        return $this;
    }

    /**
     * Bitgo public ether key
     *
     * @return string
     */
    public function getBitgoEthKey()
    {
        return $this->bitgoEthKey;
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
}
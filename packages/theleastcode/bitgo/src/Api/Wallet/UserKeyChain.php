<?php

namespace Api\UserKeyChain;

use Common\BitgoModel;

/**
 * Class UserKeyChain
 *
 * What happens when this rule is triggered.
 *
 * @package Api\UserKeyChain
 * 
 * @property string id
 * @property string encryptedPrv
 * @property string prv
 * @property string pub
 * @property string array[] users
 * @property string ethAddress
 */

class UserKeyChain Extends BitgoModel
{
    /**
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
    *
    * @return string
    */
   public function getId()
   {
       return $this->id;
   }

   /**
    * Alway greater than 1
    *
    * @param string $encryptedPrv
    * 
    * @return $this
    */
    public function setEncryptedPrv($encryptedPrv)
    {
        $this->encryptedPrv = $encryptedPrv;
        return $this;
    }
 
    /**
     *
     * @return string
     */
    public function getEncryptedPrv()
    {
        return $this->encryptedPrv;
    }

    /**
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
     *
     * @return string
     */
    public function getPrv()
    {
        return $this->prv;
    }

    /**
    *
    * @param string $pub
    * 
    * @return $this
    */
    public function setPub($pub)
    {
        $this->pub = $pub;
        return $this;
    }
 
    /**
     *
     * @return string
     */
    public function getPub()
    {
        return $this->pub;
    }

    /**
    *
    * @param string array[] $users
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
     * @return string array[]
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
    *
    * @param string $ethAddress
    * 
    * @return $this
    */
    public function setEthAddress($ethAddress)
    {
        $this->ethAddress = $ethAddress;
        return $this;
    }
 
    /**
     *
     * @return string
     */
    public function getEthAddress()
    {
        return $this->ethAddress;
    }

}


?>
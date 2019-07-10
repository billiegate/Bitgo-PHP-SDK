<?php

namespace Api\BitgoKeychain;

use Common\BitgoModel;

/**
 * Class BitgoKeychain
 *
 * What happens when this rule is triggered.
 *
 * @package Api\BitgoKeychain
 * 
 * @property string id
 * @property string isBitGo
 * @property string pub
 * @property string array[] users
 * @property string ethAddress
 */

class BitgoKeychain Extends BitgoModel
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
    * @param boolean $isBitGo
    * 
    * @return $this
    */
    public function setIsBitGo($isBitGo)
    {
        $this->isBitGo = $isBitGo;
        return $this;
    }
 
    /**
     *
     * @return boolean
     */
    public function getIsBitGo()
    {
        return $this->isBitGo;
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
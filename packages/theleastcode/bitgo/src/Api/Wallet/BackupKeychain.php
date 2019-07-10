<?php

namespace Api\BackupKeychain;

use Common\BitgoModel;

/**
 * Class BackupKeychain
 *
 * What happens when this rule is triggered.
 *
 * @package Api\BackupKeychain
 * 
 * @property string id
 * @property string source
 * @property string prv
 * @property string pub
 * @property string array[] users
 * @property string ethAddress
 */

class BackupKeychain Extends BitgoModel
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
    * @param string $source
    * 
    * @return $this
    */
    public function setSource($source)
    {
        $this->source = $source;
        return $this;
    }
 
    /**
     *
     * @return string
     */
    public function getSource()
    {
        return $this->source;
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
<?php

namespace Api\Policy;

use Common\BitgoModel;

/**
 * Class Action
 *
 * What happens when this rule is triggered.
 *
 * @package Api\Policy
 * 
 * @property string type
 * @property integer approvalsRequired
 * @property integer array[] userIds
 */

class Action Extends BitgoModel
{
    /**
    * Enum: "deny" "getApproval" "getBitGoAdminApproval" "getFinalApproval" "getCustodianApproval" "getIdVerification" "noop"
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
    * Alway greater than 1
    *
    * @param integer $approvalsRequired
    * 
    * @return $this
    */
    public function setApprovalsRequired($approvalsRequired)
    {
        $this->approvalsRequired = $approvalsRequired;
        return $this;
    }
 
    /**
     *
     * @return integer
     */
    public function getApprovalsRequired()
    {
        return $this->approvalsRequired;
    }

    /**
    * For a final approver action, who can approve
    *
    * @param integer $userIds
    * 
    * @return $this
    */
    public function setUserIds($userIds)
    {
        $this->userIds = $userIds;
        return $this;
    }
 
    /**
     *
     * @return integer array[]
     */
    public function getUserIds()
    {
        return $this->userIds;
    }
}


?>
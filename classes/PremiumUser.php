<?php
/**
 * Created by PhpStorm.
 * User: brook
 * Date: 2/27/2019
 * Time: 11:14 AM
 */

class PremiumUser extends User
{
    private $_goals;

    /**
     * PremiumUser constructor.
     * @param $_goals
     */
    public function __construct($fname, $lname, $email, $user_id)
    {
        parent::__construct($fname,$lname,$email,$user_id);
    }

    /**
     * @return mixed
     */
    public function getGoals()
    {
        return $this->_goals;
    }

    /**
     * @param mixed $goals
     */
    public function setGoals($goals)
    {
        $this->_goals = $goals;
    }

}
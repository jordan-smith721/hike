<?php
/**
 * Premium User that will extend from User to use the necessary fields.
 * User: Brooks Eshe
 * Date: 2/27/2019
 * Time: 11:14 AM
 */

class PremiumUser extends User
{
    private $_goals;

    /**
     * PremiumUser constructor. Extends User in order to get the necessary
     * parameters.
     *
     * @param $fname, $lname, $email, $user_id
     */
    public function __construct($fname, $lname, $email, $user_id)
    {
        parent::__construct($fname,$lname,$email,$user_id);
    }

    /**
     * This will return the goals that the user creates
     *
     * @return $this
     */
    public function getGoals()
    {
        return $this->_goals;
    }

    /**
     * Takes a new goal as a parameter to be added to the user
     *
     * @param $goals
     */
    public function setGoals($goals)
    {
        $this->_goals = $goals;
    }

}
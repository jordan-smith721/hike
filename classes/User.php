<?php
/**
 * Created by PhpStorm.
 * User: brook
 * Date: 2/27/2019
 * Time: 11:14 AM
 */

class User
{
    
    private $_fname;
    private $_lname;
    private $_email;
    private $_user_id;

    /**
     * User constructor.
     * @param $_fname
     * @param $_lname
     * @param $_email
     */
    public function __construct($_fname, $_lname, $_email, $_user_id)
    {
        $this->_fname = $_fname;
        $this->_lname = $_lname;
        $this->_email = $_email;
        $this->_user_id = $_user_id;

    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->_user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->_user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * @param mixed $fname
     */
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    /**
     * @return mixed
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * @param mixed $lname
     */
    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

}
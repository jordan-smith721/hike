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

    /**
     * User constructor.
     * @param $_fname
     * @param $_lname
     * @param $_email
     */
    public function __construct($_fname, $_lname, $_email)
    {
        $this->_fname = $_fname;
        $this->_lname = $_lname;
        $this->_email = $_email;
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
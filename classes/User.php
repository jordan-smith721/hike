<?php
/**
 * User class that will define a user
 * User: Brooks Eshe
 * Date: 2/27/2019
 * Time: 11:14 AM
 */
class User
{
    //fields
    private $_fname;
    private $_lname;
    private $_email;
    private $_user_id;

    /**
     * User constructor. Creates a user object to be added in an database
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
     * Returns the user_id of the student that is created in a SQL database
     *
     * @return mixed
     */
    public function getUserId()
    {
        return $this->_user_id;
    }


    /**
     * Returns the name that the user signs up with
     *
     * @return mixed
     */
    public function getFname()
    {
        return $this->_fname;
    }


    /**
     * Returns the last name that the user signs up with
     *
     * @return mixed
     */
    public function getLname()
    {
        return $this->_lname;
    }


    /**
     * Returns the email that the user signs up with
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }


}
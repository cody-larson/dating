<?php

class Member
{
    private $_fname;
    private $_lname;
    private $_age;
    private $_gender;
    private $_phone;
    private $_email;
    private $_state;
    private $_seeking;
    private $_bio;

    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    public function getAge()
    {
        return $this->_age;
    }

    public function setAge($age)
    {
        $this->_age = $age;
    }

    public function getGender()
    {
        return $this->_gender;
    }

    public function setGender($gender)
    {
        $this->_gender = $gender;
    }

    public function getPhone()
    {
        return $this->_phone;
    }

    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function setEmail($email)
    {
        $this->_email = $email;
    }

    public function getState()
    {
        return $this->_state;
    }

    public function setState($state)
    {
        $this->_state = $state;
    }

    public function getSeeking()
    {
        return $this->_seeking;
    }

    public function setSeeking($seeking)
    {
        $this->_seeking = $seeking;
    }

    public function getBio()
    {
        return $this->_bio;
    }

    public function setBio($bio)
    {
        $this->_bio = $bio;
    }

    public function getFname()
    {
        return $this->_fname;
    }

    public function getLname()
    {
        return $this->_lname;
    }
}
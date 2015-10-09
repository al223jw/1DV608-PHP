<?php

class User
{
    private $name;
    private $password;
    
    public function __construct($userName, $userPassword)
    {
        $this->name = $userName;
        $this->password = $userPassword;
    }
    
    public function getUserName()
    {
        return $this->name;
    }
    
    public function getUserPassword()
    {
        return $this->password;
    }
}
<?php

class RegisterModel
{
    private static $userDAL;
    
    public function __construct($DAL)
    {
        self::$userDAL = $DAL;
    }
    
    public function Register($userName, $passWord, $passWordCheck)
    {
        if(self::ValidateData($userName, $passWord, $passWordCheck))
        {
            self::$userDAL -> addUser($userName, sha1(file_get_contents("../Data/salt.txt")+$userName.$passWord));
        }
    }
    
    private function ValidateData($userName, $passWord, $passWordCheck)
    {
        $registerdUsers = self::$userDAL -> getUnserializedUsers();
        
        if($registerdUsers != false)
        {
            foreach($registerdUsers as $regUser)
            {
                if($userName == $regUser -> getUserName())
                {
                    throw new RegisterModelException("User exists, pick another username.");
                }
            }
        }
        
        if($userName != strip_tags($userName))
        {
            throw new RegisterModelException("Username contains invalid characters.");
        }
        if($passWord != strip_tags($passWord))
        {
            throw new RegisterModelException("Password contains invalid characters.");
        }
        if($passWord != $passWordCheck)
        {
            throw new RegisterModelException("Passwords do not match.");
        }
        if(strlen($userName) < 3)
        {
            if(strlen($passWord) < 6)
            {
                throw new RegisterModelException("Username has too few characters, at least 3 characters. <br />Password has too few characters, at least 6 characters.");
            }
            throw new RegisterModelException("Username has too few characters, at least 3 characters.");
        }
        if(strlen($passWord) < 6)
        {
            throw new RegisterModelException("Password has too few characters, at least 6 characters.");
        }
        return true;
    }
}


class RegisterModelException extends Exception
{}
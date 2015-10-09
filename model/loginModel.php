<?php

class LoginModel
{
    private static $UserDAL;
    private static $isLoggedin = "isLoggedin";
    
    public function __construct($DAL)
    {
        self::$UserDAL = $DAL;
        
        if(!isset($_SESSION[self::$isLoggedin]))
        {
            $_SESSION[self::$isLoggedin] = false;
        }
    }
    
    public function  tryLoginInfo($userN, $pass)
    {
        $RegisterdUsers = self::$UserDAL -> getUnserializedUsers();
        
        if($RegisterdUsers == false){
            throw new LoginModelException("No registerd users yet");
        }
        
        
        if(empty($userN))
        {
            throw new LoginModelException("Username is missing");
        }
        else if(empty($pass))
        {
            throw new LoginModelException("Password is missing");
        }
        else if(isset($_SESSION[self::$isLoggedin]) && $_SESSION[self::$isLoggedin] == true)
        {
            throw new LoginModelException();
        }
        
        foreach($RegisterdUsers as $regUser)
        {
            if($userN == $regUser -> getUserName())
            {
                if(sha1(file_get_contents("../Data/salt.txt") +$userN.$pass) == $regUser -> getUserPassword())
                {
                    $_SESSION[self::$isLoggedin] = true;
                    break;
                }
            }
        }
        
        if(!$_SESSION[self::$isLoggedin])
        {
            throw new LoginModelException("Wrong name or password");
        }
    }
    
    public function getLoginStatus()
    {
        if(isset($_SESSION[self::$isLoggedin]))
        {
            return $_SESSION[self::$isLoggedin];
        }
        else
        {
            return false;
        }
    }
    
    public function logOut()
    {
        if(isset($_SESSION[self::$isLoggedin]) && !$_SESSION[self::$isLoggedin])
        {
            throw new LoginModelException();
        }
        
        $_SESSION[self::$isLoggedin] = false;
    }
}


class LoginModelException extends Exception
{}
 
 


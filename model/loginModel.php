<?php

session_start();

class LoginModel
{
    private static $userName = "Admin";
    private static $userPassword = "Password";
    
    public function __construct()
    {
        if(isset($_SESSION["isLoggedin"]) && !empty($_SESSION["isLoggedin"]))
        {
            $_SESSION["isLoggedin"] = true;
        }
    }
    
    public function  tryLoginInfo($userN, $pass)
    {
        $userN = trim($userN);
        $pass = trim($pass);
        
        if(empty($userN))
        {
            throw new Exeption("Username is missing");
        }
        else if(empty($pass))
        {
            throw new Exeption("Password is missing");
        }
        else if($userN === self::$userName && $pass === self::$userPassword)
        {
           if(isset($_SESSION["isLoggedin"]) && $_SESSION["isLoggedin"] == true)
           {
                throw new Exception();
           }
        }
        else
        {
            throw new Exception("Wrong name of password");
        }
    }
    
    public function getLoginStatus()
    {
        if(isset($_SESSION["isLoggedin"]))
        {
            return $_SESSION["idLoggedin"];
        }
        else
        {
            return false;
        }
    }
    
    public function logOut()
    {
        if(isset($_SESSION["isLoggedin"]) && !$_SESSION["isLoggedin"])
        {
            throw new Exeption();
        }
        
        $_SESSION["idLoggedin"] = false;
    }
}
 
 


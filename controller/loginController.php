<?php

class LoginController
{
    private $v;
    private $lm;
    private $rv;
    private $rm;
    
    //private $LogInValidation;
    
    public function __construct(LoginView $v, LoginModel $lm, RegisterView $rv, RegisterModel $rm)
    {
        $this->v = $v;
        $this->lm = $lm;
        $this->rv = $rv;
        $this->rm = $rm;
    }
    
    public function init()
    {
        try
        {
            
            if($this->rv -> hasPressedRegister())
            {
                self::RegisterNewUser();
            }
            
            if($this-> v ->UserHasPressedLogin())
            {
                self::LogIn();
            }
            else if($this-> v ->UserHasPressedLogout())
            {
                self::logOut();
            }
        }
        catch(LoginModelException $e)
        {
            $this-> v -> setStatusMessage($e);
        }
        
        catch(RegisterModelException $e)
        {
            $this-> rv -> setErrorMessage($e);
        }
        catch(Exception $e)
        {
            echo "An unhandeld exception was thrown. Please infrom...";
        }
        
    }
    
    public function RegisterNewUser()
    {
        $registerUserName = $this-> rv -> getRequestUserName();
        $this-> rm -> Register($registerUserName, $this -> rv -> getRequestPassword(), $this-> rv -> getRequestPasswordCheck());
        
        $_SESSION["newUser"] = $registerUserName;
        
        header("Location: ?login");
    }
    
    public function logIn()
    {
        $this -> lm -> tryLoginInfo($this -> v -> getRequestUserName(), $this -> v -> getRequestUserPassword());
    
        $this -> v -> loginMessage();
    }
    
    public function logOut()
    {
        $this -> lm -> logOut();
        
        $this -> v -> logoutMessage();
    }
}
 
 


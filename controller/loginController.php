<?php

class LoginController
{
    
    private $v;
    private $lm;
    
    private $userN;
    private $pass;
    
    private $LogInValidation;
    
    public function __construct(LoginView $v, LoginModel $lm)
    {
        $this->v=$v;
        $this->lm=$lm;
    }
    
    public function init()
    {
        if($this->v->UserHasPressedSubmit())
        {
            try
            {
                $this->lm->tryLoginInfo($this->v->getRequestUserName(), $this->v->getRequestUserPassword());
                
                $this->v->loginMessage();
            }
            catch(Exception $e)
            {
                $this->v->setStatusMessage($e);
            }
        }
        
        if($this->v->UserHasPressedLogout())
        {
            try
            {
                $this->lm->logOut();
                
                $this->v->logoutMessage();
            }
            catch(Exception $e)
            {
                $this->v->setStatusMessage($e);
            }
        }
    }
    
    
}
 
 


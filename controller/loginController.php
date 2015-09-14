<?php

class LoginController
{
    public function __construct(LoginView $v, LoginModel $lm)
    {
        $this->v=$v;
        $this->lm=$lm;
    }
    
    public function username()
    {
        return $this->v->getUsername();
    }
    
    public function password()
    {
        return $this->v->getPassword();
    }
    
}
 
 


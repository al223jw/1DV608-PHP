<?php

class RegisterView
{
    private static $registerID = "RegisterView::Register";
    private static $userNameID = "RegisterView::UserName";
    private static $passwordID = "RegisterView::Password";
    private static $passwordCheckID = "RegisterView::PasswordRepeat";
    private static $messageID = "RegisterView::Message";
    
    private static $message = "";
    private static $saveUserName = "";
    
    
    public function RegisterLayout()
    {
        return'
                <form method="post">
                    <fieldset>
                        <legend>Register - enter the fields below</legend>
                        <p id="' . self::$messageID . '">' . self::$message . '</p>
                        
                        
                        <label for="' . self::$userNameID . '">Username :</label>
                        <input type="text" id="' . self::$userNameID . '" name="' . self::$userNameID . '" value="' . self::$saveUserName . '"/><br/>
                        
                        <label for="' . self::$passwordID . '">Password :</label>
                        <input type="password" id="' . self::$passwordID . '" name="' . self::$passwordID . '" /><br/>
                        
                        <label for="' . self::$passwordCheckID . '">Re-type Password :</label>
                        <input type="password" id="' . self::$passwordCheckID . '" name="' . self::$passwordCheckID . '" /><br/>
                        
                        <input type="submit" name="' . self::$registerID . '" value="Register" />
                    </fieldset>
                </form>
        ';
    }
    
    public function getRequestUserName()
    {
        if(isset($_POST[self::$userNameID]))
        {
            self::$saveUserName = trim($_POST[self::$userNameID]);
            return self::$saveUserName;
        }
        return null;
    }
    
    public function getRequestPassword()
    {
        if(isset($_POST[self::$passwordID]))
        {
            return trim($_POST[self::$passwordID]);                                       
        }
        return null;
    }
    
    public function getRequestPasswordCheck()
    {
        if(isset($_POST[self::$passwordCheckID]))
        {
            return trim($_POST[self::$passwordCheckID]);
        }
        return null;
    }
    
    public function hasPressedRegister()
    {
       if(isset($_POST[self::$registerID]))
        {
            return trim($_POST[self::$registerID]);
        }
        return null; 
    }
    
    public function setErrorMessage($e)
    {
        if(strpos($e -> getMessage(), "contains invalid characters."))
        {
            self::$saveUserName = strip_tags(self::$saveUserName);
        }
        self::$message = $e -> getMessage();
    }
}
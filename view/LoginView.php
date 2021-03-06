<?php

class LoginView {

	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';

	private static $saveUserName = "";
	private static $statusMessage = "";

	private $lm;
	
	public function __construct($lm)
	{
		$this->lm = $lm;
	}

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() 
	{
		if(isset($_SESSION["newUser"]))
		{
			self::$saveUserName = $_SESSION["newUser"];
			self::$statusMessage = "Registered new user.";
			unset($_SESSION["newUser"]);
		}
		
		$message = self::$statusMessage;
		
		//self::$saveUserName = self::getRequestUserName();
		
		if($this->lm->getLoginStatus())
		{
			$response = $this->generateLogoutButtonHTML($message);
		}
		else
		{
			$response = $this->generateLoginFormHTML($message);
		}
		return $response;
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	*/
	private function generateLogoutButtonHTML($message)
	{
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message) {
		return '
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . self::$saveUserName . '">
					
					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />
					
					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}
	
	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	public function getRequestUserName()
	{
		if(isset($_POST[self::$name]))
		{
			self::$saveUserName = trim($_POST[self::$name]);
			return self::$saveUserName;
		}
	}
	
	public function getRequestUserPassword()
	{
			if(isset($_POST[self::$password]))
		{
			return trim($_POST[self::$password]);
		}
	}
	
	public function UserHasPressedLogin()
	{
		if(isset($_POST[self::$login]))
		{
			return true;
		}
		return false;
	}
	
	public function UserHasPressedLogout()
	{
		if(isset($_POST[self::$logout]))
		{
			return true;
		}
		return false;
	}
	
	public function setStatusMessage($e)
	{
		self::$statusMessage = $e -> getMessage();
	}
	
	public function loginMessage()
	{
		self::$statusMessage = 'Welcome';
	}
	
	public function logoutMessage()
	{
		self::$statusMessage = 'Bye bye!';
	}
}
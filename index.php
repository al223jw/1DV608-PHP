<?php

session_start();

//INCLUDE THE FILES NEEDED...
require_once('controller/loginController.php');

require_once('model/loginModel.php');
require_once('model/RegisterModel.php');
require_once('model/User.php');
require_once('model/UserDAL.php');

require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/RegisterView.php');



//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

$uDAL = new UserDAL();

//CREATE OBJECTS OF THE VIEWS
$lm = new LoginModel($uDAL);
$rm = new RegisterModel($uDAL);

$v = new LoginView($lm);
$rv = new RegisterView();
$dtv = new DateTimeView();
$lv = new LayoutView();

$loginController = new LoginController($v, $lm, $rv, $rm);
$loginController->init();

$lv->render($lm->getLoginStatus(), $v, $dtv, $rv);




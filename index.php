<?php

//INCLUDE THE FILES NEEDED...
require_once('controller/loginController.php');

require_once('model/loginModel.php');

require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');




//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE VIEWS
$lm = new LoginModel();

$v = new LoginView($lm);
$dtv = new DateTimeView();
$lv = new LayoutView();

$loginController = new LoginController($v, $lm);
$loginController->init();

$lv->render($lm->getLoginStatus(), $v, $dtv);



<?php

session_start();

require_once ('View/PageView.php');
require_once ('Controller/LoginController.php');

	$pageView = new View\PageView();
	$loginModel = new Model\LoginModel();
	
	$message = null;
	
	$controller = new Controller\LoginController($loginModel, $pageView);
	echo $controller -> doShit();
	
	
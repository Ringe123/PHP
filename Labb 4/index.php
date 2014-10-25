<?php 

		require_once ("Model/loginModel.php"); 
		require_once ('Controller/loginController.php'); 
		require_once ('View/loginView.php');

		session_start();

		$loginView = new loginView();
		$loginModel = new loginModel();
		$loginController = new loginController($loginModel, $loginView);

		$loginController->doLogin();
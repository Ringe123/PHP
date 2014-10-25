<?php
	
	require_once("loginDAL.php");

	class loginModel{

		private $userName = 'Admin';
		private $passWord = 'Password';
		private $loginDAL;

		function __construct(){

			$this->loginDAL = new loginDAL();

		}		

		function verifyInput($enteredUsername, $enteredPassword){

			if (isset($enteredUsername, $enteredPassword)) {
				
				$userList = $this->loginDAL->getUsersFromDB();

				echo($userList[0]);

				if ($enteredUsername == $this->userName && $enteredPassword == $this->passWord ) {
					$this->setSession();
					return TRUE;
				}
				
			}
			else{

				return FALSE;

			}		

		}

		function setSession(){

			$_SESSION['userIsLoggedIn'] = TRUE;
			$_SESSION['client'] = $_SERVER["HTTP_USER_AGENT"];
			$_SESSION['ip'] = $_SERVER["REMOTE_ADDR"];

		}

		function checkSession(){
			if (isset($_SESSION["client"]) && isset($_SESSION["ip"])) {
			
			if ($_SESSION["client"] == $_SERVER["HTTP_USER_AGENT"] &&
				$_SESSION["ip"] == $_SERVER["REMOTE_ADDR"] && 
				isset($_SESSION['userIsLoggedIn'])) {

				if ($_SESSION['userIsLoggedIn'] == TRUE) {
					return true;
				}
			} else {
				return false;
			}
		}
			else{
				return FALSE;

			}
		}

		function userLogout(){

			if (isset($_SESSION['userIsLoggedIn']) && isset($_POST["logout"])) {
				session_unset($_SESSION['userIsLoggedIn']);				
				return TRUE;

			}

			else{

				return FALSE;

			}

		}

		function encryptPassword($enteredPassword){

			return crypt($enteredPassword, '854854682');

		}

		function getUserName(){

			return $this -> userName;

		}

		function getPassWord(){

			return $this -> passWord;

		}


		
	}
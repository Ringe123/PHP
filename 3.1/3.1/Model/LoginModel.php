<?php

namespace Model;

class LoginModel {
	/*
	 * @var $username string set username
	 */
	public $username = "Admin";
	/*
	 * @var $password string set password
	 */
	public $password = "Password";
	/*
	 * @var $messageInt int 
	 */
	public $messageInt;

	/*
	 * @return boolean
	 */
	
	function userLogout() {
		if (isset($_SESSION['loggedin']) && isset($_POST["logout"])) {
			session_unset($_SESSION['loggedin']);			
			$this -> messageInt = 1;

			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	/*
	 * @return boolean
	 */
	
	function userInput($enterdUsername, $enterdPassword) {
		if (isset($enterdUsername) && isset($enterdPassword)) {

			if ($enterdUsername == $this -> username && 
				$enterdPassword == $this -> password) {

				$this -> messageInt = 2;
				$this -> setSession();
				return TRUE;

			} else {
				return FALSE;
			}

		}
	}
	function wrongInput($enterdUsername, $enterdPassword){
		
			if ($enterdUsername != $this -> username || $enterdPassword != $this -> password) {

				return TRUE;
			} else{
				return FALSE;
			}
		
	}
	
	/*
	 * @return boolean 
	 */
	
	function emptyInput($enterdUsername, $enterdPassword) {

		if (empty($enterdUsername) && empty($enterdPassword)) {

			return TRUE;
		}
		return FALSE;
	}
	
	/*
	 * @return string encrypted password
	 */
	
	function encryptPassword($enterdPassword){
		
		return crypt($enterdPassword, "1337");
		
	}
	
	/*
	 * @return boolean
	 */
	
	function checkSession() {

		if ($_SESSION["client"] == $_SERVER["HTTP_USER_AGENT"] &&
			$_SESSION["ip"] == $_SERVER["REMOTE_ADDR"] && 
			isset($_SESSION['loggedin'])) {

			if ($_SESSION['loggedin'] == TRUE) {
				return true;
			}
		} else {
			return false;
		}
	}

	function setSession() {

		$_SESSION['loggedin'] = TRUE;
		$_SESSION['client'] = $_SERVER["HTTP_USER_AGENT"];
		$_SESSION['ip'] = $_SERVER["REMOTE_ADDR"];

	}
	
	/*
	 * @return boolean 
	 */
	
	function alreadyLoggedIn() {

		if ($_SESSION['loggedin'] = TRUE) {

			return TRUE;
		} else {
			return FALSE;
		}

	}
	
	/*
	 * @return integer
	 */
	
	function getMessageInt(){
			return $this -> messageInt;
		
	}
	
	function setMessageInt($int){
		$this -> messageInt = $int;
	}

}
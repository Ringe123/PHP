<?php

namespace View;

class PageView {

	/*
	 * @var $loginController logincontroller
	 */
	private $loginController;
	
	/*
	 * @var $messageint int to set message
	 */
	
	public $messageint;
	/*
	 * @var $message string message to print
	 */
	public $message;
	/*
	 * @return HTML when not loggedin
	 */
	function getForm() {

		$message = $this -> message;
		$clock = $this -> setClock();
		$Header = "<h1> Rw222bq Laboration 1</h1>";

		$FormInput = "<!DOCTYPE HTML SYSTEM><html><head><title>Logga in</title>
						<meta charset='utf-8'></head><body><header>" . $Header . "</header>
						" . $message . "
						<form action='index.php' method='post'>
						Användarnamn: <input type='text' name='userName'>
						Lösenord: <input type='password' name='passWord'><br><br>
						Kom ihåg mig?<input type='checkbox' name='checkBox'/>
						<input type='submit' name='button' value='Logga in'/>					
						
						</form>
						" . $clock . "
						</body></html>";
		return $FormInput;
	}
	
	/*
	 * @return HTML when loggedin
	 */
	
	function LoggedInHTML() {

		$clock = $this -> setClock();
		$loggedin = "<!DOCTYPE HTML SYSTEM><html><head><title>Logga in</title>
					<meta charset='utf-8'></head><header><h1> Admin är inloggad!</h1></header>
					<meta charset='utf-8'>
					<form action='index.php' method='post'>
					" . $this -> message . "
					<br><input type='submit' name='logout' value='Logga ut'/>
					</form>
					$clock</html>";
		return $loggedin;
	}
	
	/*
	 * @return string date and time
	 */
	
	function setClock() {

		setlocale(LC_TIME, 'Swedish_Sweden.UTF-8', 'swedish');
		$clock = strftime("%A, den %d %B år %Y. Klockan är [%H:%M:%S]");

		return $clock;

	}
	
	/*
	 * @return int to model to set right message
	 */
	
	function setMessage($messageInt) { 

		switch ($messageInt) {
			case 1 :
				$this -> message = 'Du har nu loggat ut';
				break;
			case 2 :
				$this -> message = "Inloggningen lyckades!";
				break;
			case 3 :
				$this -> message = "Inloggningen lyckades och vi kommer ihåg dig nästa gång!";
				break;
			case 4 :
				$this -> message = "Fel användarnamn eller lösenord!";
				break;
			case 5 :
				$this -> message = "Fyll i användarnamn och lösenord";
				break;
			case 6 :
				$this -> message = "Inloggningen lyckades med cookies!";
				break;
			case 7 :
				$this -> message = "Felaktig information i cookie!";
				break;
			case 8 :
				$this -> message = "Loggade in med cookies!";
				break;
		}
		return;
	}
	
	/*
	 * @return string entered username
	 */
	
	function checkUsername() {

		if ($_POST) {

			$enteredUsername = "";

			return $enteredUsername = $_POST['userName'];

		}
	}
	
	/*
	 * @return string entered password
	 */
	
	function checkPassword() {

		if ($_POST) {

			$enteredPassword = "";
			return $enteredPassword = $_POST['passWord'];

		}
	}
	
	/*
	 * @return boolean status if previously loggedin
	 */
	
	function checkLoginstatus() {
		if (isset($_POST)) {
			return TRUE;
		} else {
			return FALSE;
		}

	}
	
	/*
	 * @return boolean if checkbox for cookies is set
	 */
	
	function cookieCheckbox() {

		if (isset($_POST["checkBox"])) {
			$this -> messageint = 3;
			return TRUE;
		} else {
			return FALSE;
		}

	}

	function setCookie($enterdUsername, $enterdPassword) {

		$endTime = time() + 60;
		file_put_contents("Cookietime.txt", $endTime);

		setcookie("username", $enterdUsername, $endTime);
		setcookie("password", $enterdPassword, $endTime);

	}
	
	/*
	 * @return boolean if username and password is correct
	 */
	
	function checkCookies($username, $password) {
		if (isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {

			if ($_COOKIE["username"] == $username && $_COOKIE["password"] == $password) {

				$getExpireTime = file_get_contents("Cookietime.txt");

				if ($getExpireTime > time()) {
					return true;

				} else {
					
					$this -> deleteCookies();
					return false;
				}
			}
		} else {
			return false;
		}

	}
	function anyCookies(){
		
		if (isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
			return TRUE;
		}
		else {
			return FALSE;
		}
		
	}
	
	function deleteCookies(){
		setcookie("username", "", time() - 9999);
		setcookie("password", "", time() - 9999);
	}
	function firstPost(){
		
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			return TRUE;
		}
		else{
			return FALSE;
		}
		
	}

}
?>
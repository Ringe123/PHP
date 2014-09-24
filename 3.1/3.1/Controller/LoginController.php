<?php

namespace Controller;
require_once ('View/PageView.php');
require_once ('Model/LoginModel.php');

class LoginController {

	/*
	 * @var PageView Pageview
	 */

	private $PageView;

	/*
	 *  @var LoginModel LoginModel
	 */

	private $LoginModel;

	/*
	 * @var $messageint int to set message
	 */

	private $messageInt;

	function __construct(\Model\LoginModel $LoginModel, \View\PageView $pageView) {

		$this -> LoginModel = $LoginModel;
		$this -> PageView = $pageView;

	}

	/*
	 * @return string HTML
	 */

	public function doShit() {

		$username = $this -> LoginModel -> username;
		$password = $this -> LoginModel -> password;

		$encryptedPassword = $this -> LoginModel -> encryptPassword($password);

		if ($this -> LoginModel -> userLogout()) {
			$this -> PageView -> deleteCookies();
			$this -> message();
			return $this -> PageView -> getForm();

		} else if ($this -> LoginModel -> checkSession()) {
			$this -> message();
			return $this -> PageView -> LoggedInHTML();

		} else if ($this -> PageView -> checkLoginstatus()) {
			if ($this -> PageView -> anyCookies()) {

				if ($this -> PageView -> checkCookies($username, $encryptedPassword)) {
					$this -> LoginModel -> setMessageInt(6);
					$this -> message();
					return $this -> PageView -> LoggedInHTML();
				}
				else {						
					$this -> LoginModel -> setMessageInt(7);	
					$this -> message();
					$this -> PageView -> deleteCookies();
					return $this ->PageView->getForm();
				}
			}
			
			else {			
			return $this -> checkLogin();
				
			}
		}
	}

	/*
	 * @return string HTML
	 */

	public function checkLogin() {

		$enterdUsername = $this -> PageView -> checkUsername();
		$enterdPassword = $this -> PageView -> checkPassword();
		$encryptedPassword = $this -> LoginModel -> encryptPassword($enterdPassword);

		if ($this -> LoginModel -> userInput($enterdUsername, $enterdPassword)) {

			if ($this -> PageView -> cookieCheckbox()) {
				$this -> LoginModel -> setMessageInt(3);
				$this -> PageView -> setCookie($enterdUsername, $encryptedPassword);
			}
			
			$this -> message();
			return $LoggedInHtml = $this -> PageView -> LoggedInHTML();

		} else if ($this -> LoginModel -> emptyInput($enterdUsername, $enterdPassword)) {
			if ($this -> PageView -> firstPost()) {
				$this -> LoginModel -> setMessageInt(5);
				$this -> message();
			}
			return $notLoggedinHTML = $this -> PageView -> getForm();
		} else if ($this -> LoginModel -> wrongInput($enterdUsername, $enterdPassword)) {

			if ($this -> PageView -> firstPost()) {
				$this -> LoginModel -> setMessageInt(4);
				$this -> message();

			}
			return $this -> PageView -> getForm();

		}

	}

	function message() {

		$this -> messageInt = $this -> LoginModel -> getMessageInt();
		$this -> PageView -> setMessage($this -> messageInt);

	}

}
?>

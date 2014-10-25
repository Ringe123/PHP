<?php
	
	//namespace labb2\controller;

	class loginController{

		private $view;
		private $model;
		private $message;

		function __construct(loginModel $loginModel, loginView $loginView){

			$this->view = $loginView;
			$this->model = $loginModel;

		}

		function doLogin(){			

				$username = $this -> model -> getUserName();
				$password = $this -> model -> getPassWord();

				$encryptedPassword = $this -> model -> encryptPassword($password);


			//Har användare varit inloggad tidigare

            if ($this -> model -> userLogout()) {
            	$this->message = 'Du har loggat ut';
            	$this -> view -> killCookies();            	
            	echo $this->view->printLogin($this -> message);
            }

            else if ($this->model->checkSession()) {
            	$this -> message =  '';
            	echo $this -> view -> loggedInHTML($this -> message);
            
        	}
        	else if ($this -> view -> checkCookies($username, $encryptedPassword)){

        		$this -> message = 'Inloggning lyckades via cookies';
            	echo $this -> view -> loggedInHTML($this -> message);

        	}
        	else if ($this -> view -> loginStatus()) {

        		if (!$this -> view -> checkCookies($username, $encryptedPassword)) {
        		$this -> message = 'Felaktig information i cookie';
        		echo $this -> view -> printLogin($this -> message);
        		}
        	}
        	
            else{
			$this->checkLogin();

			}

		}

		function checkLogin(){
			
			$enteredUsername = $this -> view -> checkUsername();
            $enteredPassword = $this -> view -> checkPassword();

            $encryptedPassword = $this -> model -> encryptPassword($enteredPassword);

			if (isset($_POST['userName']) && isset($_POST['passWord'])) {

				if ($this -> model -> verifyInput($enteredUsername, $enteredPassword)) {					
					if ($this -> message == 'Inloggning lyckades') {
						$this -> message = '';
					}
					else{
						$this -> message = 'Inloggning lyckades';
					}

					if ($this -> view -> rememberMe()) {
						$this -> view -> setCookies($enteredUsername, $encryptedPassword);
						$this -> message = 'Inloggning lyckades och vi kommer ihåg dig nästa gång';
					}

					echo $this -> view -> loggedInHTML($this -> message);

				}
				else if (empty($enteredUsername) || empty($enteredPassword)) {

					if (empty($enteredUsername)) {
						$this -> message = 'Användarnamn saknas';
					}
					else if (!empty($enteredUsername) && empty($enteredPassword)) {
						$this -> view -> triedUserName($enteredUsername);
						$this -> message = 'Lösenord saknas';
					}
					
					echo $this->view->printLogin($this -> message);
				}
				else if ($enteredUsername == 'Admin' && $enteredPassword != 'Password' || $enteredUsername != 'Admin') {
					$this -> message = 'Felaktigt användarnamn och/eller lösenord';
					//$this -> view -> triedUserName($enteredUsername);
					echo $this->view->printLogin($this -> message);
				}
				else{

					$this -> message =  '';
					echo $this->view->printLogin($this -> message);
				}

			}
			else{
			$this -> message =  '';
			echo $this->view->printLogin($this -> message);
			}


		}
		


	}
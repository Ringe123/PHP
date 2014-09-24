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


			//Har användare varit inloggad tidigare
			//var_dump($this -> model -> userLogout());

            if ($this -> model -> userLogout()) {
            	$this->message = 'Du har loggat ut';            	
            	echo $this->view->printLogin($this -> message);
            }

            else if ($this->model->checkSession()) {
            	$this -> message =  '';
            	echo $this -> view -> loggedInHTML($this -> message);
            
        	}
            else{

			$this->checkLogin();

			}

		}

		function checkLogin(){
			
			$enteredUsername = $this -> view -> checkUsername();
            $enteredPassword = $this -> view -> checkPassword();

			//var_dump($_POST['userName'], $_POST['passWord']);
			if (isset($_POST['userName']) && isset($_POST['passWord'])) {

				if ($this -> model -> verifyInput($enteredUsername, $enteredPassword)) {					
					if ($this -> message == 'Inloggning lyckades') {
						$this -> message = '';
					}
					else{
						$this -> message = 'Inloggning lyckades';
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
					$this -> view -> triedUserName($enteredUsername);
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
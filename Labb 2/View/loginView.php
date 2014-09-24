<?php 

	class loginView{

		public $clock;
		public $user = '';


		public function printLogin($message){

			$clock = $this->setClock();

			$html = "<!DOCTYPE HTML SYSTEM><html><head><title>Labb 2</title>
						<meta charset='utf-8'></head><body>

						<h1>Rw222bq Laboration 2</h1>
						<h2>Ej Inloggad</h2>						
						<form action='' method='post'>
						<fieldset>
						<legend>Login - Skriv in användarnamn och lösenord</legend>
						" . $message . "<br>
						Användarnamn: <input type='text' name='userName'>
						Lösenord: <input type='password' name='passWord'><br><br>
						Kom ihåg mig?<input type='checkbox' name='checkBox'/>
						<input type='submit' name='button' value='Logga in'/>					
						</fieldset>
						</form>
						$clock
						</body></html>";

						return $html;

		}

		public function loggedInHTML($message){


		$clock = $this -> setClock();

		$loggedin = "<!DOCTYPE HTML SYSTEM><html><head><title>Logga in</title>
					<meta charset='utf-8'></head><header><h1> Admin är inloggad!</h1></header>
					<meta charset='utf-8'>
					<form action='index.php' method='post'>
					" . $message . "
					<br><input type='submit' name='logout' value='Logga ut'/>
					</form>
					$clock</html>";

		return $loggedin;

		}

		function checkUsername() {

	        if ($_POST) {
	        	if ($_POST['userName'] == "" || is_null($_POST['userName'])) {
	        		return null;
	        	}
	        	else{

	                $enteredUsername = "";

	                return $enteredUsername = $_POST['userName'];
	                }
	        }
        }
    
        function checkPassword() {

            if ($_POST) {
            	if ($_POST['passWord'] == "" || is_null($_POST['passWord'])) {
	        		
	        		return null;

	        	}
	        	else{

                    $enteredPassword = "";
                    return $enteredPassword = $_POST['passWord'];
					}
            }
	    }

		public function setClock(){

		setlocale(LC_TIME, 'Swedish_Sweden.1252');
		$clock = strftime("%A, den %d %B år %Y. Klockan är [%H:%M:%S]");

		return $clock;

		}

		function triedUserName($userName){

			$this->user = $userName;
		}


	}
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

						<a href='register/register.php'>Registrera en ny användare</a>						
						<form action='' method='post'>
						<fieldset>
						<legend>Login - Skriv in användarnamn och lösenord</legend>
						" . $message . "<br>
						Användarnamn: <input type='text' name='userName'>
						Lösenord: <input type='password' name='passWord'><br><br>
						Kom ihåg mig?<input type='checkbox' name='CookieBox'/>
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

        function checkCookies($username, $password) {    		        	

        	if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
        		if ($_COOKIE['username'] == $username && $_COOKIE['password'] == $password) {
        			
        			$CookieTime = file_get_contents('timeforacookie');

        			if ($CookieTime > time()) {
        				return TRUE;
        			}
        			else{

        				$this -> killCookies();
        				return FALSE;

        			}

        		}

        		else{

        			return FALSE;
        		}
        	}
        	else{

        		return FALSE;

        	}
        }
    
        function checkPassword() {

            if ($_POST) {
            	if ($_POST['passWord'] == "" || is_null($_POST['passWord'])) {
	        		
	        		return null;

	        	}
	        	else{

                    return $enteredPassword = $_POST['passWord'];
					}
            }
	    }

		public function setClock(){

		setlocale(LC_TIME, 'Swedish_Sweden.1252');
		$clock = strftime("%A, den %d %B år %Y. Klockan är [%H:%M:%S]");

		return $clock;

		}

		public function setCookies($user, $pass){

			$cookieTime = time() + 60;
			file_put_contents('timeforacookie', $cookieTime);

			setcookie('username', $user, $cookieTime);
			setcookie('password', $pass, $cookieTime);

		}

		public function rememberMe(){

			if (isset($_POST['CookieBox'])) {
				return TRUE;
			}
			else{

				return FALSE;
			}


		}

		public function killCookies(){

			setcookie("username", "", time() - 9999);
			setcookie("password", "", time() - 9999);

		}

		function loginStatus() {
		if ($_POST['visited'] == TRUE) {
			return TRUE;
		} 
		else if ($_POST == null) {
			$_POST['visited'] = TRUE;
			return FALSE;
		}
		else {
			return FALSE;
		}

	}



	}
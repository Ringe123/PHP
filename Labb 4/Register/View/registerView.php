<?php

	class registerView{

		private $errormessage = "self::errormessage";
		private $passwordErrormessage = "self::passwordErrormessage";
		private $triedUsername = "self::triedUsername";


		public function printHTML(){

			$clock = $this -> setClock();

			$html = "<!DOCTYPE HTML SYSTEM><html><head><title>Labb 4, registrera användare</title>
						<meta charset='utf-8'></head><body>
						
						<h2>Ej Inloggad, Registrerar användare</h2>

						<a href='..\index.php'>Tillbaka</a>
						<br>						
						<form action='' method='post'>
						<fieldset>
						<legend>Registrerar ny användare - Skriv in användarnamn och lösenord</legend>
						" . $_POST[$this->errormessage] .  $_POST[$this->passwordErrormessage] . "
						Användarnamn:<br> <input type='text' name='regUsername' value='" . $_POST[$this->triedUsername] . "'><br>
						Lösenord: <br><input type='password' name='regPassword' value=''><br>
						Bekräfta Lösenord: <br><input type='password' name='confirmPassword'><br>
						<input type='submit' name='button' value='Registrera'/>					
						</fieldset>
						</form>
						$clock
						</body></html>";

			return $html;
		}

		public function setClock(){

		setlocale(LC_TIME, 'Swedish_Sweden.1252');
		$clock = strftime("%A, den %d %B år %Y. Klockan är [%H:%M:%S]");

		return $clock;

		}

		public function isPost(){

			if($_SERVER['REQUEST_METHOD'] === "POST"){
				return true;
			}
			else{
				return false;
			}

		}

		public function getUsername(){

			if(isset($_POST["regUsername"])){
					if(strlen($_POST["regUsername"]) >= 3 && strlen($_POST["regUsername"]) <= 20){

					$_POST[$this->triedUsername] = $_POST["regUsername"];
					$_POST[$this->errormessage] = $this->setErrormessage(0);
					return $_POST[$this->triedUsername];
					}
					else{
						$_POST[$this->errormessage] = $this->setErrormessage(1);
					}
				}

			}

		public function getPassword(){

			if(isset($_POST["regPassword"])){
				if(strlen($_POST["regPassword"]) >= 6){
					if(strcmp($_POST["regPassword"], $_POST["confirmPassword"]) === 0){
						$_POST[$this->passwordErrormessage] = "";
						return $_POST["regPassword"];
					}
					else{
					$_POST[$this->passwordErrormessage] = $this->setErrormessage(2);	
					}
				}
				else{
					$_POST[$this->passwordErrormessage] = $this->setErrormessage(3);
				}

			}

		}

		public function setErrormessage($messageInt){

			var_dump($messageInt);
			switch ($messageInt) {

				case 1:
				$_POST[$this->errormessage] = "Användarnamnet har för få tecken. Minst 3 tecken<br>";					
				break;

				case 2:
				$_POST[$this->passwordErrormessage] = "Lösenorden stämmer in överens<br>";					
				break;

				case 3:
				$_POST[$this->passwordErrormessage] = "Lösenorden har för få tecken. Minst 6 tecken<br>";					
				break;

				case 4:
				$_POST[$this->errormessage] = "Användare registrerad!";					
				break;

				case 5:
				$_POST[$this->passwordErrormessage]	= "";			
				break;

				default:
				$_POST[$this->errormessage] = "";
				break;
			}


		}





	}
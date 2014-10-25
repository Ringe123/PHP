<?php 

	class loginDAL{
		
		private $DB_HOST;
		private $DB_TABLE;
		private $DB_USER;
		private $DB_PASS;
	
		private $dbConnection;
		private $userList = array();	

		public function __construct(){

			$this -> DB_HOST = 'localhost';
			$this -> DB_TABLE_USER = 'user';
			$this -> DB_TABLE_PW = 'password';
			$this -> DB_USER = 'root';
			$this -> DB_PASS = '';
			$this -> DB_NAME = 'users';

			$this->connect();

		}

		function connect(){

			$this->dbConnection = mysqli_connect($this -> DB_HOST, $this -> DB_USER, $this -> DB_PASS, $this -> DB_NAME);

			if(mysqli_connect_errno()){

				echo("kunde inte koppla till databas");
			}

		}

		function getUsersFromDB(){

			$sql = "SELECT * FROM " . $this -> DB_NAME ." WHERE " . $this -> DB_TABLE_USER;		

			$result = mysqli_query($this->dbConnection, $sql);
			
			$check = mysqli_fetch_array($result);
			var_dump($check);

			/*foreach ($result as $r) {
				$this -> userList[] = $r;
				echo($r);
			}*/

			return $this -> userList;

		}

		function checkForUser($user, $password){

		$username = mysqli_real_escape_string($user);
    	$password = mysqli_real_escape_string($password);

		$sql = "SELECT * FROM users WHERE user='$user' AND password='$password'";

		$result = mysqli_query($this->dbConnection, $sql);



		}


	}
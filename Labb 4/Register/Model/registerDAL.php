<?php 

	class registerDAL{

		private $DB_HOST;
		private $DB_TABLE;
		private $DB_USER;
		private $DB_PASS;

		private $dbConnection;
		private $userList = array();		

		function __construct(){

			$this -> DB_HOST = 'localhost';
			$this -> DB_TABLE_USER = 'user';
			$this -> DB_TABLE_PW = 'password';
			$this -> DB_USER = 'root';
			$this -> DB_PASS = '';
			$this -> DB_NAME = 'users';

			$this -> connect();
			//$this -> getUsersFromDB();

		}

		function connect(){

			$this->dbConnection = mysqli_connect($this -> DB_HOST, $this -> DB_USER, $this -> DB_PASS, $this -> DB_NAME);

			if(mysqli_connect_errno()){

				echo("kunde inte koppla till databas");
			}

		}

		function getUsersFromDB(){

			$sql = "SELECT * FROM " . $this -> DB_NAME;		

			$result = mysqli_query($this->dbConnection, $sql);

			foreach ($result as $r) {
					$this -> userList[] = $r;
					echo($r);
				}	

		}

		function addUser($userToBeAdded, $passwordToBeAdded){
			echo("kommer hit");
			echo($userToBeAdded . $passwordToBeAdded);

			//$sql = "INSERT INTO " . $this -> DB_TABLE . " (" . $this -> DB_TABLE_USER .", " . $this -> DB_TABLE_PW . ") VALUES (" . $userToBeAdded . ", " . $passwordToBeAdded . ")";	
			//$sql = "INSERT INTO $this -> DB_TABLE ('$this -> DB_TABLE_USER' ,'$this -> DB_TABLE_PW' VALUES ('$userToBeAdded' ,'$passwordToBeAdded')";	
				//$sql = "INSERT INTO `users`(`user`, `password`) VALUES (" . $userToBeAdded . "," . $passwordToBeAdded ." )";
			var_dump($this -> DB_NAME);
			mysqli_query($this->dbConnection, "INSERT INTO users (user, password) VALUES ('$userToBeAdded' ,'$passwordToBeAdded')");
			return true;
			

		}

		function getUserList(){

			return $this -> userList;

		}


	}
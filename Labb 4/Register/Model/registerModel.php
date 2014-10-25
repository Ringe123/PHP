<?php

	require_once("/registerDAL.php");

	class registerModel{

		private $validUsername;
		private $validPassword;
		private $registerDAL;

		function __construct(){

			$this -> registerDAL = new registerDAL();

		}

		function validateInput($triedUsername, $triedPassword){

			if($this->validateUsername($triedUsername) && $this->validatePassword($triedPassword)){
				$this -> validUsername = $triedUsername;
				$this -> validPassword = $triedPassword;
				return true;
			}

		}
		function validateUsername($username){

				if(preg_match('/^[<a-zA-Z0-9]*$/', $username)){
					if(!$this->userExsists($username)){
					return true;
					}	
				}

		}
		function validatePassword($password){

			if(strlen($password) > 6 && strlen($password) < 20){
				return true;
			}

		}

		function userExsists($username){

			$userList = $this->registerDAL->getUserList();

			foreach ($userList as $users) {
				if(strcmp($users, $username) === 0){

					return true;

				}
				else{
					return false;
				}
			}			

		}

		function addUser(){

			$this->registerDAL->addUser($this->validUsername, $this->validPassword);

		}

	}
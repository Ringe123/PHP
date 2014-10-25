<?php 

	class registerController{

		private $rM;
		private $rV;


		function __construct(registerModel $registerModel, registerView $registerView){

			$this->rM = $registerModel;
			$this->rV = $registerView;

		}

		function doRegistration(){

			if($this->rV->isPost()){

				$triedUsername = $this->rV->getUsername();
				$triedPassword = $this->rV->getPassword();
				/*
				Tester 
				
				var_dump($triedUsername);
				var_dump($triedPassword);
				var_dump($this->rM->validateUsername($triedUsername));
				var_dump($this->rM->validatePassword($triedPassword));*/
				if($this->rM->validateInput($triedUsername, $triedPassword)){

					if($this->rM->addUser()){
						$this->rV->setErrormessage(4);
					}

				}

			}
			echo($this->rV->printHTML());

		}



	}
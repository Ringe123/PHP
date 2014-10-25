<?php

require_once("Controller/registerController.php");
require_once("Model/registerModel.php");
require_once("View/registerView.php");

$registerView = new registerView();
$registerModel = new registerModel();
$registercontroller = new registerController($registerModel, $registerView);

$registercontroller->doRegistration();

<?php
	require_once('ArrayHelpers.php');
	require_once('myDie.php');
	//Modify this file to test your code.
	$car = array('brand' => 'Volvo', 
		'year' => '2004', 
		'model' => 'v70', 
		'numberOfPreviousOwners' => 3);
	
	$arrayHelpers = new ArrayHelpers();
	
	$carReversed = $arrayHelpers->reverseArray($car);

	$arrayHelpers->printArray($car);
	$arrayHelpers->printArray($carReversed);

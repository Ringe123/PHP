<?php

	//Because of limitations in the environment this function
	//must be used instead of die() or exit().
	function myDie($message) {
		throw new \Exception($message);
	}
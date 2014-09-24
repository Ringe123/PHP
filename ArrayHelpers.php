<?php
	//Modify these funtions. Do not change the function names.
	require_once('myDie.php');

	class ArrayHelpers {

		/**
		 * prints the array on specific format (hint use var_dump)
		 * kills the script using myDie if arrayToBePrinted length is odd (1, 3, 5)
		 * 
		 * 
		 * @param  array  $arrayToBePrinted the array to print
		 * @return void 
		 */ 		
		
		public function printArray(array $arrayToBePrinted) {
			//Kill the script in this function if the length is odd.
			
			//Do not forget to print the array.
			//var_dump($arrayToBePrinted);
			
			if(count($arrayToBePrinted) % 2 == 0){
					
				foreach($arrayToBePrinted as $key){
				
				echo($key . "<br>");
				
				}			
			}
			else{
				
				/myDie("All arrays must have an even length");
				
			}
					
			
			
		}




		/**
		 * Reverses an array with reversed keys and values.
		 *
		 * Example: $rev = $ah->reverseArray(array('a','b','c'));
		 * //$rev == array(2 => c, 1 => b, 0 => a)
		 *
		 * This method should work like array_reverse($arr, TRUE);
		 * http://php.net/manual/en/function.array-reverse.php
		 *
		 * NOTE: You may NOT use array_reverse to solve this assignment
		 * 
		 * @param  array  $arrayToBeReversed
		 * @return array  array with keys and values in reversed order
		 */
		public function reverseArray(array $arrayToBeReversed) {
			$arrayLength;
			$reversedArray = array();
					
			return $reversedArray;
		}
		
		
	}

<?php 

	/**
	 * numExtract()
	 *
	 * Removes all letters from a string, leaving only the numbers
	 *
	 * @param $String) The string that is to be cleaned
	 * @return (String)
	 */
	function numExtract($string) {
		if (function_exists("filter_var")) {
			$string = filter_var($string, FILTER_SANITIZE_NUMBER_INT);
		} else {
			$string = preg_replace("[^0-9\$]","",$string);
		}

		if (empty($string)) {
			return "0";
		} else {
			return $string;
		}

	}


	/**
	 * makeArrayHtmlSafe();
	 *
	 * Takes all array elements and runs htmlEntities() on each item
	 *
	 * @param (array) The ONE DIMENTIONAL Array you need cleaned
	 * @return (array)
	 */
	function makeArrayHtmlSafe($arr) {

		foreach ($arr as $key => $item) {
			$arr[$key] = htmlentities($item);
		}

		return $arr;
	}




	/**
	 * is_arrayEmpty()
	 *
	 * Check if array is empty
	 *
	 * @param (Array) The Array that is to be checked
	 * @return (Void)
	 */
	function is_arrayEmpty($arr) {
		return count($arr) == 0;
	}




	/**
	 * format_date()
	 *
	 * Turns a timestamp into a human readable date mm/dd/yyyy
	 *
	 * @param (String) Unix timestamp to be converted
	 * @return (String)
	 */
	function format_date($timestamp) {
		echo date('m/d/Y', strtotime($timestamp));
	}




	/**
	 * verify_get()
	 *
	 * Mainly used for Course controller. Used to verify string of 'id' is actually set
	 *
	 * @param (String) Name of the GET variable
	 * @return (String)
	 */
	function verify_get($id) {

		if ($_SERVER['REQUEST_METHOD'] == "GET" and isset($_GET[$id])) {

			return $_GET[$id];
		} else {

			//Instead of dieing just return false
			return false;
			die("nope");
		}
	}




	/**
	 * course_clean_output
	 *
	 * Cleans the values of the given array so that it can safely be output to the screen; 
	 * This function can only handle one and two dimentional arrays;
	 *
	 * @param (Array) 
	 * @return (Array)
	 */
	function scrub_array_output($items) {

		foreach ($items as $key => $item) {

			if( is_array($item) ) {
				foreach ($item as $k => $v) {
					$item[$k] = htmlentities($v);
				}

				$items[$key] = $item;
			} else {
				$items[$key] = htmlentities($item);
			}
		}

		return $items;
		
	}


	/**
	 * Convert Time
	 *
	 * What is going on with this function...I mean really.
	 * You Should delete this once you get your head on right. 
	 *
	 * @param (Array) 
	 * @return (Array)
	 */
	function convert_time($time) {

		if(preg_match('/\d{2}\/\d{2}\/\d{4}/', $time)) {

			return true;

		} elseif (preg_match('\d{2}\-\d{2}\-\d{4}', $time)) {

			return true;

		} elseif (preg_match('\d{2}\-\d{2}\-\{4}', $time)) {

		} else {

			return true;
		}


	}


	/**
	 * decToBinArray()
	 *
	 * Converts a decimal to binary then separates each number into an array
	 * This is used to help display the weeks for the schedules
	 *
	 * @param (Array) 
	 * @return (Array)
	 */
	function decToBinArray($num, $len = 7) {

		//If the string length is longer than 7 then return false
		if ( strlen($num) > 7 ) {
			return false;
		}

		$result = str_pad($num, $len, "0", STR_PAD_LEFT);
		$result = str_split($result);

		return $result;

	}









?>
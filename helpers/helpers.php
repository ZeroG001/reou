<?php 

// These are all general helper functions used by all classes.


	/**
	 * redirect404()
	 *
	 * Redirects the User to the 404 not found page
	 *
	 * @return void
	 */
	function redirect404() {

		header( "Location:". main_route('404') );

	}



	/**
	 * displayOption()
	 *
	 * Used to help shorten the code that displays what checkbox or input box is selected
	 *
	 * @param (string) $value of the current select box
	 * @param (strong) $value of the other source (ie. from $_POST)
	 * @return String
	 */
	function displayOption($value, $given) {

		$value = strtolower($value);
		$given = strtolower($given);

		if($value == $given) {
			return "selected";
		} else {
			return false;
		}

	}



	/**
	 * displayCheckbox()
	 *
	 * Used to help shorten the code that displays what checkbox or input box is selected
	 *
	 * @param (type) about this param
	 * @return String
	 */
	function displayChekbox($given) {

		$given = strtolower($given);

		if($given == 1) {
			return "checked";
		} else {
			return false;
		}		
	}



	/**
	 * displayInputPost()
	 *
	 * Used to show input that has already been submitted though post
	 *
	 * @param (type) about this param
	 * @return Void
	 */
	function displayInputPost($given) {

		if(isset($$given)) {
			echo $given;
		}
	}



	/**
	 * convery_camel_case()
	 *
	 * take a camel case word, adds underscaore between lower and upper case letter, then make it all lowercase.
	 * ie(helloWorld becomes hello_world); 
	 *
	 * @param (String) camelCaseString 
	 * @return (String)
	 */
	function convert_camel_case($string) {
		$pattern ="/([a-z])([A-Z])/";
		$replacement = "$1" . "_" . "$2";
		$string = preg_replace($pattern, $replacement, $string);
		$string = strtolower($string);
		return $string;
	}


?>
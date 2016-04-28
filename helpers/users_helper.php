
<?php


	/**
	 * userSignedIn()
	 *
	 * Checks to see whether a user is signed in or not.
	 *
	 * @param (type) about this param
	 * @return (type)
	 */
	function userSignedIn() {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if( isset($_SESSION['id']) ) {
			return true;
		} else {
			return false;
		}
		// check if a session variable is set
		// Return true or false
	}




	/**
	 * displaySelected()
	 *
	 * Used to help shorten the code that helps diplay checkboxes. This simply checks if two string are the same.
	 *
	 * @param (string) value of the checkbox
	 ^ @params (string) value given from the database
	 * @return String
	 */
	function displaySelected($value, $given) {




		$value = strtolower($value);
		$given = strtolower($given);


		if($value == $given) {
			return "selected";

		} else {
			return false;
		}		
	}


	/**
	 * displayOption()
	 *
	 * Used to help shorten the code that displays what checkbox or input box is selected
	 *
	 * @param (type) about this param
	 * @return String
	 */
	function displayOption($value, $given) {

		$value = strtolower($value);
		$given = strtolower($given);

		if($value == $given) {
			return "checked";
		} else {
			return false;
		}		
	}




	/**
	 * displayOption()
	 *
	 * Used to help shorten the code that displays what checkbox or input box is selected
	 *
	 * @param (type) about this param
	 * @return String
	 */
	function displayChekbox($given) {

		$given = strtolower($given);

		if("1" == $given) {
			return "checked";
		} else {
			return false;
		}		
	}


	function redirectHome() {

		if( !isset($_SERVER['HTTP_REFERER']) ) {
			header("Location:". course_route('home') );
		} else {
			header("Location:". $_SERVER['HTTP_REFERER']);
		}

	}


	/**
	 * display_alert()
	 *
	 * Add a message to the User object. Message can be used later on to dislay
	 *
	 * @param (String) set the message type as "Alert", "Notice", "Success", or "Error"
	 * @return (boolean)
	 */
	function display_alert2($type) {

		if ( isset(User::$flash_message) ) {

			foreach (User::$flash_message[$type] as $message) {
				echo $message;
			}

			// Clear the contents of the flash messages
			foreach (User::$flash_message as $messages) {
				unset($message);
			}
			return true;
		} else {
			return false;
		}
	}


	function display_alert($type) {

		if ( isset($_SESSION) ) {

			foreach ($_SESSION['flash_message'][$type] as $message) {
				echo $message;
			}

			// Clear the contents of the flash messages
			foreach ($_SESSION['flash_message'] as $messages) {
				unset($message);
			}
			return true;
		} else {
			return false;
		}
	}




	/**
	 * userIsAdmin()
	 *
	 * Checks if the user signed in is an admin
	 *
	 * @param none
	 * @return (bool)
	 */
	function userIsAdmin() {
		if(session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if( isset($_SESSION['id']) && $_SESSION['role'] == "admin" )  {
			return true;
		} else {
			return false;	
		}
	}



	/**
	 * userIsInstructor
	 *
	 * Checks if the user signed in is an instructor
	 *
	 * @param (type) about this param
	 * @return (type)
	 */
	function userIsInstructor() {
		if(session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if( isset($_SESSION['id']) && $_SESSION['role'] == "instructor" )  {
			return true;
		} else {
			return false;	
		}	
	}


	/**
	 * userIsInstructor
	 *
	 * Pretty much combines two strings. Used to combine a users first and last name
	 *
	 * @param (String, String) the string to combine
	 * @return (String)
	 */
	function fullName($firstName, $lastName) {
		$fullName = $firstName . " " . $lastName;
		return $fullName;
	}




	/**
	 * users_clean_output
	 *
	 * Cleans the values of the given array so that it can safely be output to the screen; 
	 * This function can only handle one and two dimentional arrays;
	 *
	 * @param (Array) 
	 * @return (Array)
	 */
	function users_clean_output($items) {

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




	/**
	 * convery_camel_case()
	 *
	 * take a camel case word, adds underscaore between lower and upper case letter, then make it all lowercase.
	 * ie(helloWorld becomes hello_world); 
	 *
	 * @param (String) camelCaseString 
	 * @return (Void)
	 */
	function check_honeypot_fields($params) {
		if(isset($params['hpUsername']) && !empty($params['hpUsername'])) {
			die("There was an error processing an unknown field");	
		}
	}




?>
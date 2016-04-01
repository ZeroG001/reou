
<?php


	/*
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


	/*
	 * display_alert()
	 *
	 * Add a message to the User object. Message can be used later on to dislay
	 *
	 * @param (String) set the message type as "Alert", "Notice", "Success", or "Error"
	 * @return (boolean)
	 */
	function display_alert($type) {
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




	/*
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



	/*
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


	/*
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




	/*
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



?>
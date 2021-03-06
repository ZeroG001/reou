
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



	function signUserOut() {
		session_destroy();
	}



	/**
	 * replacePhoto()
	 *
	 * Uses the bulletproof class to upload a photo
	 *
	 * @param (none) about this param
	 * @return (void)
	 */

	function replacePhoto() {}	



	/**
	 * displaySelected()
	 *
	 * Used to help shorten the code that helps diplay checkboxes. This simply checks if two string are the same.
	 *
	 * @param (string) value of the checkbox
	 * @param (string) value given from the database
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
	 * redirectHome()
	 *
	 * Redirects the user back to the home page
	 *
	 * @return void
	 */
	function redirectHome() {
		header("Location:". course_route('home'));
	}



	/**
	 * redirectLogin()
	 *
	 * Redirects the user back to the home page
	 *
	 * @return void
	 */
	function redirectLogin() {
		header("Location:" . user_route('sign-in'));
	}



	/**
	 * display_alert() [ERASE THIS FUNCTION] THIS IS BEING REPLACED BY THE FUNTION BELOW.
	 *
	 * Add a message to the User object. Message can be used later on to dislay.
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
				//unset($message);
			}
			return true;
		} else {
			return false;
		}
	}



	/**
	 * add_message()
	 *
	 * Add a message to the User object. Message can be used later on to dislay.
 	 *
	 * @param (String) set the message type as "Alert", "Notice", "Success", or "Error"
	 * @return (boolean)
	 */
	function add_message($type, $message) {

		$acceptable_message_types = array("alert","notice","success","error");


		// For my sake, check to make sure I put in the right session type.
		if(!in_array(strtolower($type), $acceptable_message_types) && is_string($type)) {
			throw new Exception("The function accepts types of alert, notice, success, and error", 1);
		}	

		if ( session_status() == PHP_SESSION_ACTIVE ) {

			if(!isset($_SESSION['flash_message'])) {
				$_SESSION['flash_message'] = array();


				if(!isset($_SESSION['flash_message'][$type]) ) {
					$_SESSION['flash_message'][$type] = array();
				}
			}

			// add messages to the flash message array
			array_push($_SESSION['flash_message'][$type], $message);

		} elseif ( session_status() == PHP_SESSION_NONE ) {

			if(!isset($_SESSION['flash_message'])) {

				$_SESSION['flash_message'] = array();

				if(!isset($_SESSION['flash_message'][$type]) ) {
					$_SESSION['flash_message'][$type] = array();
				}
			}

		} else {
			die("session message was not able to show, make it so that something useful happens when the flash message does not show up");
		}

	}



	/**
	 * display_alert()
	 *
	 * Shows message added to session's "flash_message" array
 	 *
 	 * DEPENDS ON IS SIGNED IN userSignedIn() function
 	 *
	 * @param (String) set the message type as "Alert", "Notice", "Success", or "Error"
	 * @param (boolean) whether or not to remove the session variable after showing the message
	 * @return (boolean)
	 *
	 */
	function display_alert($type, $clearMessage = true) {

		if ( isset($_SESSION['flash_message'][$type]) ) {

			foreach ($_SESSION['flash_message'][$type] as $message) {
				echo  "<div class='alert'>";
				echo $message;
				echo "</div>";
			}

			// clear message from session
			if($clearMessage) {


				// Clear the contents of the flash messages
				unset($_SESSION['flash_message']);


				//If ther user isn't signed in then close the session
				if(!userSignedIn()) {
					unset($_SESSION);
				}
			}

			return true;

		} 
		else {
			return false;
		}
	}



	// THis may need to be erased. Add flash message function should take care of clearing this out.
	function clear_alert() {
		unset($_SESSION['flash_message']);
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
	 * takes time in yyyy-mm-dd format and converts it to mm/dd/yyyy
	 *
	 * @param (String) time  
	 * @return (String)
	 */
	function convert_time_to_local($time) {

		$date = new DateTime($time);
		return $date->format('m/d/y');

	}



	/**
	 * check_honeypot_fields()
	 *
	 * Ensure that the honeypot field is not filled out. If it is then code execution stops.
	 * should make it so a user received a message.
	 * ie(helloWorld becomes hello_world); 
	 *
	 * @param (String) camelCaseString 
	 * @return (Void)
	 */
	function check_honeypot_fields($params) {
		if(isset($params['hpUsername']) && !empty($params['hpUsername'])) {
			die("There was an error processing an unknown field");	
		} 
		else {
			unset($params['hpUsername']);
			unset($params['hpUsername']);
			return $params;
		}
	}


?>
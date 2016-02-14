<?php


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


	function display_alert($type) {
		if ( isset(User::$message[$type]) ) {
			echo User::$message[$type];
			User::$message[$type] == "";
		} else {
			return false;
		}
	}


?>
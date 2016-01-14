<?php

	function signin_check_post_params() {
		$params = array("firstName", "lastName", "email", "password");

		foreach ($params as $v) {

			if(isset($_POST[$v])) {
				continue;
			} 
			else {
				return false;
			}
		}
		return true;
	} // end


	function userIsSignedIn() {
		session_start();

		if( isset($_SESSION['id']) ) {
			return true;
		} else {
			return false;
		}
		// check if a session variable is set
		// Return true or false
	}


?>
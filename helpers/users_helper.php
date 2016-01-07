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


?>
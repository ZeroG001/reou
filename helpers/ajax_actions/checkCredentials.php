<?php
	require_once("../../includes/const.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");

	session_start();


	if( $_SERVER['REQUEST_METHOD'] == "POST" ) {
		$user = new User($db);

		// Assign post to the params variable;
		// Add the session ID to the post param.
			// Might want to be careful with this. You might also want to get back user ID just to be sure you're updating the right password.

		$params = $_POST;
		//$params['email'] = $_SESSION['email'];
		$params['userId'] = $_SESSION['id'];

		// If the user is able to sign in using the current username and password then go ahead and sign them in.
		// I should only have this work if the person is a user. As an admin, they should not be able to do this.

		$sign_in_result = $user->sign_in($params);
	
		if($sign_in_result) {

			// If the session ID and the username & password ID does not match then stop the script

			if($sign_in_result[0]['id'] !== $_SESSION['id']) {
				echo "false";
				die();
			} else {
				echo "true";
				die();
			}

		} 
		else {
			echo "One of both of the Username and Password are invalid";
		}
		

	}
 ?>
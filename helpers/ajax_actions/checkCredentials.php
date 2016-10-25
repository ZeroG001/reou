<?php
	require_once("../../includes/const.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");

	session_start();


	if( $_SERVER['REQUEST_METHOD'] == "POST" ) {

		$user = new User($db);

		$params = $_POST;
		$params['userId'] = $_SESSION['id']

		// Check if user sucessfully signed in.
		$sign_in_result = $user->sign_in($params);

		if($sign_in_result) {

			if($sign_in_result[0]['id'] !== $_SESSION['id']) {
				echo "you are trying to modify a password for a user that is not you...";
				die();
			}
	
		} 
		else {
			echo "One or both of the Username and Passwords are invalid";
		}
		

	}
 ?>
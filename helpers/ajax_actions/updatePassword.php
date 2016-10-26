<?php
	require_once("../../includes/const.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");

	session_start();


	if( $_SERVER['REQUEST_METHOD'] == "POST" ) {
		$user = new User($db);


		$params = $_POST;
		//$params['email'] = $_SESSION['email'];
		$params['userId'] = $_SESSION['id'];

		$sign_in_result = $user->sign_in($params);
	
		if($sign_in_result) {

			if($sign_in_result[0]['id'] !== $_SESSION['id']) {
				echo "you are trying to modify a password for a user that is not you...";
				die();
			}


			if($user->update_password($params)) {
				echo "Password was sucessfully updated.";
			} 
			else {
				echo "Error: There was a problem updating the password";
			}

		} 
		else {
			echo "Error: Username or password incorrect";
		}
		

	}
 ?>
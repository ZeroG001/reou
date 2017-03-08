<?php
	require_once("../../includes/const.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");

	session_start();

	if( $_SERVER['REQUEST_METHOD'] == "POST" ) {

		$schedule = new Schedule($db);

		if($schedule->create_course_schedule($params)) {
			echo "course schedule sucessfully created";
		} else {
			echo "there was a problem creating the course schedule";
		}



		//Check to make sure the params are clemn


		// $params = $_POST;

		//Get logg in user's email and ID from session.
		// $params['email'] = $_SESSION['email'];
		// $params['userId'] = $_SESSION['id'];

		// $sign_in_result = $user->sign_in($params);
	
		// -------------------------
		// if($sign_in_result) {

		// 	// Remember to uncomment this when you're finished
		// 	if($sign_in_result[0]['id'] !== $_SESSION['id']) {
		// 		echo "user_mismatch";
		// 		die();
		// 	}
		// 	if( $user->update_password($params) ) {
		// 		echo "success";
		// 		add_message("alert", "Password Sucessfully Updated");
		// 	} 
		// 	else {
		// 		echo "password_invalid";
		// 	}

		// } 
		// else {
		// 	echo "bad_user_pass";
		// }
		// --------------------------
	}
 ?>
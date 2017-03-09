<?php
	require_once("../../includes/const.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");

	session_start();

	if( $_SERVER['REQUEST_METHOD'] == "POST" && $_POST['_method'] == "post" ) {

		// remove the _method if something does not go right



		// If the user is signed in and they are an admin then go ahead and add the new schedule
		// I'll handle the validation later. The goal is to get the information in the database.
		if(userSignedIn() && userIsAdmin()) {

			$params = $_POST;

			unset($_POST['_method']);
			unset($_POST['recur-day']);
			unset($params['recur-day']);
			unset($params['_method']);

			$schedule = new Schedule($db);

			if($schedule->create_schedule($params)) {
				echo "The schedule has been added"; 
			} else {
				echo "Problem Creating Schedule. createScheduleAsync.php";
			}

			// echo "post vars";

			// var_dump($_POST);

		} else {
			echo "invalid response";
		}

		$schedule = new Schedule($db);


		// Create the course
		// if($schedule->create_course_schedule($params)) {
		// 	echo "course schedule sucessfully created";
		// } else {
		// 	echo "there was a problem creating the course schedule";
		// }


		// $params = $_POST;

		// Get logg in user's email and ID from session.
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

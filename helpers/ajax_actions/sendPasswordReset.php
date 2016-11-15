<?php
	require_once("../../includes/const.php");
	require_once("../../includes/mailer/mailerconst.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");


	session_start();

	if( $_SERVER['REQUEST_METHOD'] == "POST" ) {

		$user = new User($db);


		$params = $_POST;

		//Get logg in user's email and ID from session.
	
		$db_result = $user->create_password_reset_token($params);

		
			if($db_result) {

				echo "Sending the email now please wait";
				
			} else {

				echo "Added entry to the database but was unable to send the email";
			}

		
		if( $db_result ) {

			echo " Entry sucessfully added to the database.";

		} else {

			echo "Entry to database failed";
			
		}
	}
 ?>
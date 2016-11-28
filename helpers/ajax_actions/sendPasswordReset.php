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


				if(!$reoumail->send()) {
				    echo 'Message could not be sent. For real this time.';
				    echo 'Mailer Error: ' . $reoumail->ErrorInfo;
				} else {
				    echo 'Message has been sent for real this time';
				}
							
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
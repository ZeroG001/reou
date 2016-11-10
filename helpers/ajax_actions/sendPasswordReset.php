<?php
	require_once("../../includes/const.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");

	session_start();

	if( $_SERVER['REQUEST_METHOD'] == "POST" ) {

		$user = new User($db);


		$params = $_POST;

		//Get logg in user's email and ID from session.


		if() {
			
		}
		/*

		$send_result = $user->add_password_reset_token_to_database;

		// First we gotta create a query that 

		if( send restult successful ) {
			use php mailer to send email

			if the email send successfully then send a response back
		}

		If you're not able to send to the database or send the email then send a message back saying it failed.

		*/
		
	}
 ?>
<?php
	require_once("../../includes/const.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");

	session_start();

	if( $_SERVER['REQUEST_METHOD'] == "POST" ) {

		$user = new User($db);


		$params = $_POST;

		//Get logg in user's email and ID from session.
	
		$db_result = $user->create_password_reset_token($params);


		// First we gotta create a query that 

		if( $db_result ) {

			echo " Entry sucessfully added to the database.";

		} else {

			echo "Entry to database failed";
			
		}
	}
 ?>
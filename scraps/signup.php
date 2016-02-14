<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
require_once(D_ROOT . "/reou/models/User.php");
require_once(D_ROOT . "/reou/helpers/users_helper.php");

if ( $_SERVER['REQUEST_METHOD'] == "POST" && signin_check_post_params()) {

	// Theres no real reson to do this. Just aliasing the POST params
	$params = $_POST;


	require_once(D_ROOT . "/reou/models/database.php");


	// -------- Attempt To Signup -------- //
	$user = new User($db);

	try {
		$results = $user->create_user($params);
		header("location: ../views/courses/course_category.php");
	} 

	catch (Exception $e) {
		// This needs to be an error message
		echo("There was a porblem creating the user check sigup.php");
		$e->getMessage();
	}

	
}

?>

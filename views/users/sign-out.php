<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");

	session_start();
	session_destroy();


	// ------- Uncomment this Whrn you're done -----------------
	if( !isset($_SERVER['HTTP_REFERER']) ) {
		
		header( "Location:" . course_route('home') );

	} else {

		header("Location:". $_SERVER['HTTP_REFERER']);
		
	}


?>

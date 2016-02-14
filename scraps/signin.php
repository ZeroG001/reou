<?php

if ( $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['email']) 
	&& isset($_POST['password'])) {

	require_once $_SERVER['DOCUMENT_ROOT'] . '/reou/includes/const.php';
	require_once(D_ROOT . "/reou/models/database.php");

	function __autoload($class_name) {
		require_once("../models/". $class_name . '.php');
	}

	// -------- Load POST Variables -------- //
	$params = array();
	$params['email'] = $_POST['email'];
	$params['password'] = $_POST['password'];


	// -------- Attempt To Sign in -------- //
	$user = new User($db);
	$results = $user->sign_in($params); 

	// -------- Load Sesion Variables and sign in -------- //
	if($results) {

		session_start();
		foreach($results[0] as $k => $v) {
			$_SESSION[$k] = $v;

		}

		echo "You have signed in successfully";
	} 

	else {
		echo "Username or password is incorrect";
	}

}


?>

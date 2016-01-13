<?php 
require($_SERVER['DOCUMENT_ROOT'] . '/reou/includes/const.php');
require_once(D_ROOT . "/reou/models/database.php");
require(D_ROOT . '/reou/helpers/users_helper.php');
require(D_ROOT . "/reou/models/User.php");



// --------------- signin.php ---------------------
function signin($ObjectPDO) {

	if ( $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['email']) 
		&& isset($_POST['password'])) {

		// -------- Load POST Variables -------- //
		$params = array();
		$params['email'] = $_POST['email'];
		$params['password'] = $_POST['password'];


		// -------- Attempt To Sign in -------- //
		$user = new User($db);
		$results = $user->sign_in($params); 

		// -------- Load Sesion Variables -------- //
		if($results) {
			session_start();
			foreach($results[0] as $k => $v) {
				$_SESSION[$k] = $v;

			}
		}
	}
}



// --------------- signup.php ---------------------

function create($ObjectPDO) {
	require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	require_once(D_ROOT . "/reou/helpers/users_helper.php");

	if ( $_SERVER['REQUEST_METHOD'] == "POST" && signin_check_post_params()) {

		$params = $_POST;
		$user = new User($ObjectPDO);

		try {
			$results = $user->create_user($params);
		} 

		catch (Exception $e) {
			// This needs to be an error message
			echo("There was a porblem creating the user check sigup.php");
			$e->getMessage();
		}

		header("location: ../views/courses/course_category.php");
	}
}



// --------------------------------- edit.php -----------------------------

function edit($ObjectPDO) {
	// if(isSignedIn()) {
		$user = new User($ObjectPDO);

		$user->get
	// }

}






?>
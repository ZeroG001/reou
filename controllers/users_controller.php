<?php 
	
function signin() {

	if ( $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['email']) 
		&& isset($_POST['password'])) {

		require_once $_SERVER['DOCUMENT_ROOT'] . '/reou/includes/const.php';
		require_once(D_ROOT . "/reou/classes/database.php");

		function __autoload($class_name) {
			require_once("classes/". $class_name . '.php');
		}

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
} // Sign in Function End



function signup() {
	require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	require_once(D_ROOT . "/reou/helpers/users_helper.php");

	if ( $_SERVER['REQUEST_METHOD'] == "POST" && signin_check_post_params()) {

		// Theres no real reson to do this. Just aliasing the POST params
		$params = $_POST;

		require_once(D_ROOT . "/reou/classes/database.php");

		// Old fasioned autoloading for compatibility
		function __autoload($class_name) {
			require_once(D_ROOT . "/reou/models/". $class_name . '.php');
		}

		// -------- Attempt To Signup -------- //
		$user = new User($db);

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
}// Sign Up function end


?>
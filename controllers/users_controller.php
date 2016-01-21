<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/includes/const.php');
require_once(D_ROOT . "/reou/models/database.php");
require(D_ROOT . '/reou/helpers/users_helper.php');
require(D_ROOT . '/reou/helpers/courses_helper.php');
require(D_ROOT . '/reou/controllers/routes.php');
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
		// "id","first_name", "last_name", "address", "city", "state", 
		//"zip", "phone", "email", "licensed", "type", "bio", "active", "title"

		if ($results) {
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

		// header("location: ../views/courses/course_category.php");
	}
}


// --------------------------------- edit.php -----------------------------

function edit($ObjectPDO) {
	// if(isSignedIn()) {
		$user = new User($ObjectPDO);
	// }

}

function my_courses($ObjectPDO) {
	//The student ID will be received by the user session

	if(isSignedIn()) {
		$student_id = $_SESSION['id'];
	} else {
		die("You must be signed in to see this page");
	}

	$user = new User($ObjectPDO);
	$results = $user->get_user_classes($student_id);
	$course_detail = $results[0];

	return $results;

}

function sign_in($ObjectPDO, $params) {

	if(isset($params['email']) && isset($params['password'])) {

			$user = new User($ObjectPDO);
			$results = $user->sign_in($params);

			session_start();

			//session variable names are same as column names in table.
			foreach ($results[0] as $k => $v) {
				$_SESSION[$k] = $v;
			}

			//or perhaps take them to the splash page.
			header("location:". course_route('course_category'));

	} else {
		echo "User name or password is empty";
	}	

}


?>
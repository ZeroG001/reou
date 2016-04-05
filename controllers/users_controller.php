<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/includes/const.php');
require_once(D_ROOT . "/reou/models/database.php");
require(D_ROOT . '/reou/helpers/users_helper.php');
require(D_ROOT . '/reou/helpers/courses_helper.php');
require(D_ROOT . '/reou/controllers/routes.php');
require(D_ROOT . '/reou/models/User.php');



// --------------- signin.php ---------------------

function sign_in($ObjectPDO, $params) {

	if($_SERVER['REQUEST_METHOD'] == "POST") {

		// ---------- If Sign in Successful ----------
		if(isset($params['email']) && isset($params['password'])) {

			// If the User is already signed in, take to another page
			if( userSignedIn() ) {

				// Move the user to the course_category page
				header("Location:". course_route('course_category') );
				// header("Location:". $_SERVER['HTTP_REFERER'] );
				die();
			}

			$user = new User($ObjectPDO);

			// If sign-in is successful, take to another page
			if( $results = $user->sign_in($params) ) {
				
				session_start();

				//session variable names are same as column names in table.
				foreach ($results[0] as $k => $v) {
					$_SESSION[$k] = $v;
				}

				//bring to course category page
				header("location:". course_route('course_category'));
			} 
			else {
				User::add_message("alert", "Username or password incorrect");
			}

		} 
		else {
			User::add_message("alert", "User name or password is empty");
		}	

	}


}




// -------------------------- signup.php --------------------------------

function sign_up($ObjectPDO, $params) {
	require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	require_once(D_ROOT . "/reou/helpers/users_helper.php");



	// If signed in bring to course category page
	if(userSignedIn()) {
		header("Location:".course_route('course_category') );
		die();
	}

	if ( $_SERVER['REQUEST_METHOD'] == "POST") {

		$params = $_POST;
		$user = new User($ObjectPDO);

		try {
			if($user->create_user($params)) {
				header("Location:". course_route('course_category'));
				sign_in($ObjectPDO, $params);
			} else {
				User::$message['alert'] = "This user already exists";
			}
		} 
		catch (Exception $e) {
			// This needs to be an error message
			die("There was a porblem creating the user check sigup.php");
			$e->getMessage();
		}

		// header("location: ../views/courses/course_category.php");
	}
}




// --------------------------------- edit.php ----------------------------------

function edit_user($ObjectPDO) {


	// If User isn't signed in, go back to home page
	if( !userSignedIn() ) {
		redirectHome();
		die("You should not be here");
	}


	// If user is NOT Admin
	if(  userSignedIn() && !userIsAdmin() ) {

		if($_SESSION['id'] != $_GET['id'] ) {
			redirectHome();
			die("You aren't suppose to be here.");
		}

	}


	// If user is Admin
	if(  userSignedIn() && userIsAdmin() ) {

		if($_SERVER['REQUEST_METHOD'] != "POST") {
			redirectHome();
		}

		$user = new User($ObjectPDO);
		$results = $user->get_user_details($_POST);

		if(sizeof($results) <= 0) {
			redirectHome();
			return false;
		}
		

		return $results;

	}

}


// --------------------------------- update_user ----------------------------------

function update_user($ObjectPDO, $params) {
	require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	require_once(D_ROOT . "/reou/helpers/users_helper.php");

	if(userSignedIn() && $_SERVER['REQUEST_METHOD'] == "POST" && $_POST['updateMethod'] == 'updateUser') {

		unset($_POST['updateMethod']);
		check_honeypot_fields($_POST);
		unset($_POST['hpUsername']);

		$user = new User($ObjectPDO);

		if($user->update_user($_POST)) {
			User::add_message("alert", "User Successfully Updated");
		} else {
			User::add_message("error", "There was a problem updating the user");
		}
		
	}
}


// --------------------------------- show_users.php -----------------------------

function show_users($ObjectPDO) {

	//If the user isn't an admin then bring them back to the page they were on
	if(!userIsAdmin()) {
		if( !isset($_SERVER['HTTP_REFERER']) ) {
			header("Location:". course_route('course_category') );
		} else {
			header("Location:". $_SERVER['HTTP_REFERER']);
		}
	}

	$user = new User($ObjectPDO);
	$results = $user->get_users_info();
	return $results;
}




// --------------------------------- my_courses.php -----------------------------

function my_courses($ObjectPDO) {
	//The student ID will be received by the user session

	if(userSignedIn()) {
		$student_id = $_SESSION['id'];
	} else {
		die("You must be signed in to see this page");
	}

	$user = new User($ObjectPDO);
	$results = $user->get_user_classes($student_id);
	$course_detail = $result;

	return $results;
}



?>
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
				User::$message['alert'] = "Username or password incorrect";
			}

		} 
		else {
			User::$message['alert'] = "User name or password is empty";
		}	

	}


}

// function signin($ObjectPDO) {

// 	if ( $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['email']) 
// 		&& isset($_POST['password'])) {

// 		// -------- Load POST Variables -------- //
// 		$params = array();
// 		$params['email'] = $_POST['email'];
// 		$params['password'] = $_POST['password'];


// 		// -------- Attempt To Sign in -------- //
// 		$user = new User($db);
// 		$results = $user->sign_in($params); 

// 		// -------- Load Sesion Variables -------- //
// 		// "id","first_name", "last_name", "address", "city", "state", 
// 		//"zip", "phone", "email", "licensed", "type", "bio", "active", "title"

// 		if ($results) {
// 			session_start();
// 			foreach($results[0] as $k => $v) {
// 				$_SESSION[$k] = $v;

// 			}
// 		}
// 	}
// }

// --------------- signup.php ---------------------

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

				//header("Location:". course_route('course_category'));

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




// --------------------------------- edit.php -----------------------------

function edit($ObjectPDO) {
	// if(isSignedIn()) {
		$user = new User($ObjectPDO);
	// }

}

// --------------------------------- show_users.php -----------------------------

function show_users($ObjectPDO) {
	
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




?>
<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/includes/const.php');
require_once(D_ROOT . "/reou/models/database.php");
require(D_ROOT . '/reou/helpers/users_helper.php');
require(D_ROOT . '/reou/helpers/courses_helper.php');
require(D_ROOT . '/reou/controllers/routes.php');
require(D_ROOT . '/reou/models/User.php');



// --------------- signin.php --------------------- //

function sign_in($ObjectPDO, $params) {

	session_start();

	if($_SERVER['REQUEST_METHOD'] == "POST") {

		if(isset($params['email']) && isset($params['password'])) {

			// If the User is already signed in, take to another page
			if( userSignedIn() ) {
				// Move the user to the course_category page
				header("Location:". course_route('course_category') );
				// header("Location:". $_SERVER['HTTP_REFERER'] );
				die();
			}

			$user = new User($ObjectPDO);

			// Attemps to sign the user in. If successful, then move to home page.
			if( $results = $user->sign_in($params) ) {
				session_start();
				//session variable names are same as column names in table.
				foreach ($results[0] as $k => $v) {
					$_SESSION[$k] = $v;
				}
				header("location:". course_route('course_category'));
			} 
			else {
				// If the sign in fails then add a message then destroy the session.
				session_start();
				add_message("alert", "username or password is incorrect");
				header( "Location:" . $_SERVER['REQUEST_URI']);
				die();
			}
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
				User::add_message("alert", "This user already exists");
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




// --------------------------------- edit_user.php ----------------------------------

function edit_profile($ObjectPDO) {


	// If User isn't signed in, go back to home page
	if( !userSignedIn() ) {
		redirectHome();
		die("You should not be here");
	}




	// If user is NOT Admin
	if(  userSignedIn() && !userIsAdmin() ) {

		// If the session ID is not set or empty then redirect the user home
		if(!isset($_SESSION['id']) || trim($_SESSION['id']) == "") {
			redirectHome();
		}

		$userId = $_SESSION['id'];
		$params = array("userId" => $userId);
		$user = new User($ObjectPDO);
		$results = $user->get_user_details($params);
		
		return $results;
	}

	// If user is Admin
	if(  userSignedIn() && userIsAdmin() ) {

		if(!isset($_GET['userId'])) {
			redirectHome();
		}

		$user = new User($ObjectPDO);
		$results = $user->get_user_details($_GET);

		if(sizeof($results) <= 0) {
			redirectHome();
			return false;
		}
		

		return $results;

	}


	die("edit profile ran into a critical error");

}


// --------------------------------- update_user ----------------------------------

function update_user($ObjectPDO, $params) {

	require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	require_once(D_ROOT . "/reou/helpers/users_helper.php");

	// If the users data is being updated.
	if(userSignedIn() && $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['_method']) ) {

		if ( ($_POST['_method']) == "patch" )  {


			// ------ Quick Field Check -----
			unset($_POST['_method']);
			unset($params['_method']);
			check_honeypot_fields($_POST);
			unset($_POST['hpUsername']);
			unset($params['hpUsername']);
			// ---------- END ---------------

			$user = new User($ObjectPDO);

			if($user->update_user($_POST)) {
				add_message("alert", "User Successfully Updated");
				// header( "Location:" . $_SERVER['REQUEST_URI']);
				// die();

			} 
			else {
				add_message("error", "there was a problem updating the user");
			}
		} 
		else {
			die("update user error patch method invalid");
		}
	}



	// // If ther user is trying to upload an image
	// if (userSignedIn() && !empty($_FILES) ) {

	// 	echo "you're trying to upload an image";

	// 	require  D_ROOT . "/reou/assets/classes/bulletproof/src/bulletproof.php";

	// 	// There might be an error here since there is no user object
	// 	$image = new Bulletproof\Image($_FILES);

	// 	if($image["profilePicture"]) {
	// 		 $image->setLocation("/var/www/html/reou/assets/img/dbimg");
	// 		 $image->setSize(100, 4194304);
	// 		 $image->setDimension(900, 900);
	// 	    // $upload = $image->upload();
	// 		 echo "Image has been uploaded - PHASE 1";


	// 		// Get Current name of user profile image
	// 		$profilePictureName = $user->getProfilePictureName($params);

	// 		echo "profile picture name is";
	// 		var_dump($profilePictureName);

	// 		if  (empty($profilePictureName)) {

	// 			// If the picture profile name is empty
	// 		    if($upload) {
	// 		       echo "The file has been uploaded";
	// 		       echo $image->getName() . "." . $image->getMime();
	// 		    } 
	// 		    else {
	// 		        echo $image["error"]; 
	// 		    }
				
	// 		}
	// 		else {
	// 			echo "the profile picture name is apperently this caused some ort of error";
	// 			var_dump($profilePictureName);
	// 			// unlink(D_ROOT . "/reou/images/dbimg/src/" . $profilePictureName['profile_picture']);
	// 			echo "file erased?";
	// 			echo "the file has been erased";
	// 		}

	// 	}

	// 	// Take this out? No
	// 	die("image has been uploaded END");
	// }


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



/**
 * show_user($params) 
 *
 * Used to show only one users detail. Idealy the information of the person whose logged in
 *
 * @param (Array) $params - The parameters submitted from POST
 * @return (boolean)
 */
function show_user() {
	// If the user is signed in then run the qurey.
	// Store the result of the query in an array, then display on page.

	if(userSignedIn()) {

		if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['userId']) ) {

			echo "Hello there is something here.";

		}
		$user = new User($ObjectPDO);
		$results = $user->get_user_details($_POST);

	}
}




// --------------------------------- my_courses.php -----------------------------



/**
 * show_user($params) 
 *
 * Shows all the courses that belong to the currently logged in user.
 *
 * @param (Array) $params - The parameters submitted from POST
 * @return (array) 
 */
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

function update_profile_picture($ObjectPDO) {
	// $user = new User($ObjectPDO);
	// $result = $user->get
}




?>
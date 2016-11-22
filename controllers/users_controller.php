<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/includes/const.php');
require_once(D_ROOT . "/reou/models/database.php");
require(D_ROOT . '/reou/helpers/users_helper.php');
require(D_ROOT . '/reou/helpers/courses_helper.php');
require(D_ROOT . '/reou/controllers/routes.php');
require(D_ROOT . '/reou/models/User.php');
require(D_ROOT . '/reou/models/Course.php');



// --------------- signin.php --------------------- //

function sign_in($ObjectPDO, $params) {

	session_start();

	// If the user is already signed in then take them to the home page
	if( userSignedIn() ) {

		header("Location:". course_route('course_category') );
		
	}

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


	// TODO - On the sign up page if one of the fields has no name value then you get an error. Correct that.

	// If already signed then take to courses page
	if(userSignedIn()) {
		header("Location:" . course_route('course_category') );
		die();
	}

	if ( $_SERVER['REQUEST_METHOD'] == "POST") {


		// Check Honeypot Field ( for spam stop comparing yourself to others. This is you right now.)
		$_POST = check_honeypot_fields($_POST);

		$params = $_POST;
		$user = new User($ObjectPDO);

		try {
			
			if($user->create_user($params)) {
				header("Location:". course_route('course_category'));
				sign_in($ObjectPDO, $params);
			} else {
				header( "Location:" . $_SERVER['REQUEST_URI']);
				die();
			}
		} 
		catch (Exception $e) {
			// This needs to be an error message
			echo $e->getMessage();
			die("There was a porblem creating the user check sigup.php");
			
		}

		// header("location: ../views/courses/course_category.php");
	}
}




// --------------------------------- edit_user.php ----------------------------------

function edit_profile($ObjectPDO) {

	// TODO - Mak sure that a user input is filtered.

	// If User isn't signed in, go back to home page
	if( !userSignedIn() ) {
		redirectHome();
		die("You should not be here");
	}


	// If the user is not an admin
	if( userSignedIn() && !userIsAdmin() ) {

		// If the session ID is not set or empty then redirect the user home
		if(!isset($_SESSION['id']) || trim($_SESSION['id']) == "") {
			redirectHome();
		}

		$userId = $_SESSION['id'];
		$params = array("userId" => $userId);
		$user = new User($ObjectPDO);
		$results = $user->get_user_details($params);

			//Convert created at time to mm/dd/yy format
		$updated_at_date = DateTime::createFromFormat('Y-m-d H:m:s',$results['updated_at']);

		$results['updated_at'] = $updated_at_date->format("m/d/Y");


		
		return $results;

	}


	// If the user is an Admin
	if( userSignedIn() && userIsAdmin() ) {

		if( !isset($_GET['userId']) || trim($_GET['userId'] == "") ) {
			redirectHome();
		}

		$user = new User($ObjectPDO);


		// Uses $_GET variable to show the user
		$results = $user->get_user_details($_GET);


		// Todo - Make this so that you get the count of the results instrad of boolean
		if(!$results) {
			redirectHome();
			return false;
		}


		
		return $results;

	}

	die("edit_profile ran into a critical error. You must be signed in to continue");
	
}


function create_user($ObjectPDO, $params) {

	// This function is also used by the signup form so be careful for conflicts
	// If something breaks its because I remove this part of the program.
	// require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	// require_once(D_ROOT . "/reou/helpers/users_helper.php");

	// Only admin's can create a new user in this way.
	if(userSignedIn() && userIsAdmin()) {

		// If the users data is being updated.
		if( $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['_method']) ) {

			// If they they are trying to create a new user.
			if ( ($_POST['_method']) == "post" )  {


				// Get the post vars and put then in the create user mehots

				// ------ Quick Field Check -----

				unset($_POST['_method']);
				unset($params['_method']);
				$_POST = check_honeypot_fields($_POST);
				
				// ---------- Field Check End ---------------

				$user = new User($ObjectPDO);

				if($user->create_user($_POST)) {

					add_message("alert", "The user has been successfully created");
					// Direct the admin back to the user list page with the message.
				}


				// If the user is not an admin then move them back one space.
				if(!userIsAdmin()) {
					if( $_SESSION['id'] != $_POST['userId'] ) {
						add_message("error", "there was a problem moving the users");
						header( "Location:" . $_SERVER['REQUEST_URI']);
						die();
					}
				}
			} 
			else {
				die("Critical error in creating the user. Incorrect method used");
			}
		}
	} else {
		die("Your not an admin, im not sure how you even got to this page without being detected. users_controller.php");
	}

}




// --------------------------------- update_user ----------------------------------


/**
 * update_user($params) 
 *
 * Update a user using the parameters submitted. Don't worry only allowed params can be submitted.
 *
 * @param (Obect) Accepts the PDO Object
 * @param (Array) params array submitted from form
 * @return (params)
 */
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


			if(!userIsAdmin()) {
				
				// If a non-admin is trying to edit another user then stop
				if( $_SESSION['id'] != $_POST['userId'] ) {
					add_message("error", "there was a problem updating the user");
					header( "Location:" . $_SERVER['REQUEST_URI']);
					die();
				}

				// Prevent non-admin  from changing their role ( needs refactoring )
				$_POST['role'] = "student"; 

				// Prevent non-admin user from deactivating theit account
				$_POST['active'] = '1';
			}

			// The user should not be able to update if the email already exists in the system


			// Admins Should not be able to change the email address

			if( $user->update_user($_POST) ) {
				add_message("alert", "Profile has been Successfully Updated");
				header( "Location:" . $_SERVER['REQUEST_URI']);
				die();
			} 
			else {
				add_message("error", "there was a problem updating the user");
			}

		} 
		else {
			die("crital update user error. Incorrect update method used");
		}
	}


	// UPLOADING IMAGES. You may need to use this later.
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




function user_mail_reset_password($ObjectPDO, $params) {

	// Sign the user out so sessions dont conflict.
	if (userSignedIn()) {
		signUserOut();
	}



	if ( $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['a']) ) {
			$user_token = $_GET['a'];
		 	// Load the actual page. 
		}


	// If the submit method
 // 	if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['_method'] == "patch" ) {

	// 	// ------ unset the method variabel -----
	// 	unset($_POST['_method']);
	// 	unset($params['_method']);
	// 	// ---------- END ---------------------


	// 	$user = new User($ObjectPDO);

	// 	// Attemt to get the token information
	// 	try {

	// 		$token_info = $user->get_token_info($_POST['token']);

	// 	} 
	// 	catch (Exception $e) {

	// 		echo "unable to retrieve token info. Reason: " . $e->getMessage();

	// 	}

	// } else {
	// 	echo "the update method is invalid";
	// }


}


// --------------------------------- show_users.php -----------------------------

function show_users($ObjectPDO) {

	//If the user isn't an admin then bring them back to the page they were on
	if(!userIsAdmin()) {
		if( !isset($_SERVER['HTTP_REFERER']) ) {
			header("Location:". course_route('course_category') );
		} else {
			// header("Location:". $_SERVER['HTTP_REFERER']);
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
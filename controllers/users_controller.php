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

		// ---------- If Sign in Successful ---------- //
		if(isset($params['email']) && isset($params['password'])) {

			// If the User is already signed in, take to another page
			if( userSignedIn() ) {

				// Move the user to the course_category page
				header("Location:". course_route('course_category') );
				// header("Location:". $_SERVER['HTTP_REFERER'] );
				die();
			}

			$user = new User($ObjectPDO);

			// If sign-in is successfull then take the user to another page. Start the session
			if( $results = $user->sign_in($params) ) {
				session_start();
				//session variable names are same as column names in table.
				foreach ($results[0] as $k => $v) {
					$_SESSION[$k] = $v;
				}
				header("location:". course_route('course_category'));
			} 
			else {
				// In the case I want to kill the session as soon as I display the message.

				User::add_message("alert", "Username or password incorrect");
				session_destroy();
			}
		}
		else {
			User::add_message("alert", "Username or password is incorrect");
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


	die("edit profile ran into a critical error");

}


// --------------------------------- update_user ----------------------------------

function update_user($ObjectPDO, $params) {
	require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	require_once(D_ROOT . "/reou/helpers/users_helper.php");

	// If the users data is being updated.
	if(userSignedIn() && $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['_method']) ) {

		if ( ($_POST['_method']) == "patch" )  {

			var_dump($_FILES);

			if ($_FILES) {
				var_dump($_FILES);
				echo "I see you tried to upload a file, but I don't care";
			}

			// ------ Quick Field Check -----
			unset($_POST['_method']);
			check_honeypot_fields($_POST);
			unset($_POST['hpUsername']);
			// ---------- END ---------------

			$user = new User($ObjectPDO);

			if($user->update_user($_POST)) {
				User::add_message("alert", "User Successfully Updated");
				// header( "Location:" . $_SERVER['REQUEST_URI']);
			} else {
				User::add_message("error", "There was a problem updating the user");
			}
		}
	}



	// If ther user is trying to upload an image
	if (userSignedIn() && !empty($_FILES) ) {

		echo "you're trying to upload an image";

	// 	require  D_ROOT . "/reou/assets/classes/bulletproof/src/bulletproof.php";

	// 	$user = new User($ObjectPDO);
	// 	$image = new Bulletproof\Image($_FILES);
	// 	if($image["profilePicture"]) {
	// 		 $image->setLocation("/var/www/html/reou/assets/img/dbimg");
	// 		 $image->setSize(100, 4194304);
	// 		 $image->setDimension(900, 900);
	// 	    // $upload = $image->upload();
	// 		 echo "Image has been uploaded";


	// 	// Get Current name of user profile image
	// 	$profilePictureName = $user->getProfilePictureName($params);

	// 	var_dump($params);

	// 	if  (empty($profilePictureName)) {

	// 		//If there is nothing there. Just regularl post
	// 	    if($upload) {
	// 	       echo "The file has been uploaded";
	// 	       echo $image->getName() . "." . $image->getMime();
	// 	    } 
	// 	    else {
	// 	        echo $image["error"]; 
	// 	    }
			
	// 	}
	// 	else {
	// 		unlink(D_ROOT . "/reou/images/dbimg/src/" . $profilePictureName);
	// 		echo "file erased?";
	// 		// If there is, get the name of the current image. 
	// 		// Erase the pd image, 
	// 		//then post the new one
	// 	}
	// }

	// 	// Take this out? No
	// 	die("image has been uploaded");
	// }

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
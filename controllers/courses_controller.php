<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/includes/const.php');
require_once(D_ROOT . "/reou/models/database.php");
require_once(D_ROOT . '/reou/helpers/courses_helper.php');
require_once(D_ROOT . '/reou/helpers/users_helper.php');
require_once(D_ROOT . '/reou/controllers/routes.php');
require_once(D_ROOT . "/reou/models/Course.php");
require_once(D_ROOT . "/reou/models/User.php");


// decToBinArray

// --------------- course_category.php ---------------------

function course_category($ObjectPDO) {

	$course = new Course($ObjectPDO);
	$categories = $course->get_course_category();
	$categories = scrub_array_output($categories); //scrub output

	return $categories;
}




// --------------- course_classes.php ---------------------

function course_classes($ObjectPDO) {

	$course_id = verify_get('id');
	$course = new Course($ObjectPDO);
	$result_array = Array();
	
	$categories = $course->get_course_classes($course_id);
	$one_category = $course->get_one_course_category($course_id);

	$categories = scrub_array_output($categories); //scrub output
	$one_category = scrub_array_output($one_category); //scrub output
	
	array_push($result_array, $categories);
	array_push($result_array, $one_category);

	return $result_array;

}




// --------------- course_detail.php ---------------------

function course_detail($ObjectPDO) {

	$course_class_id = verify_get('courseId');

	if( verify_get('courseId') ) {
		$course_class_id = verify_get('courseId');
	} else {
		// SHOULD REDIRECT TO COURSE LISTING PAGE - Right now I have it going to course detail

		redirectHome();
	}

	$course = new Course($ObjectPDO);
	$user = new User($ObjectPDO);
	$result_array = Array();


	// Retrive data from database
	$details = $course->get_class_details($course_class_id);
	$schedules = $course->get_course_schedule($course_class_id);
	$course_categories = $course->get_course_category();
	$instructors = $user->get_instructors();


	// Push the result of each to the result array
	array_push($result_array, $details);
	array_push($result_array, $schedules);
	array_push($result_array, $course_categories);
	array_push($result_array, $instructors);
	

	// I need to find a way to srube the data in a different way.
	foreach ($result_array as $k => $v) {
		$result_array[$k] = scrub_array_output($v);
	}
	

	return $result_array;
}




// --------------- course_create.php -----------------------

function course_create($ObjectPDO) {
	
	// if( $_SERVER['REQUEST_METHOD'] == 'POST' )
	if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

		//removeme
		session_start(); // Might erase this because it might not be nessessary to start a session.

		$params = $_POST;

		// _method needs to be removed on submit.
		unset($params['_method']);


		//Check and scrub parameters

		$course = new Course($ObjectPDO);


		// If the course was created, show sucess message. Else, show an error message.
		// if($course->create_course($params))
		if( true ) {

			// add_message("alert", "the course was added sucessfully");
			// header("Location:". $_SERVER['HTTP_REFERER']);
			die("The course has been created");

		} else {

			add_message("alert", "there was a problem creating the class");
			header("Location:". $_SERVER['HTTP_REFERER']);
			die();
		}
		
	} 

}


// --------------- Create course schedule -----------------------

function course_create_schedule($ObjectPDO, $params) {


	if( userSignedIn() && userIsAdmin() ) {


		if($_SERVER['REQUEST_METHOD'] == 'POST') {


			// ------ Quick Field Check -----
			unset($_POST['_method']);
			unset($params['_method']);
			$_POST = check_honeypot_fields($_POST);

			// ---------- END ---------------



			$course = new Course($ObjectPDO);


			if( $course->create_course_schedule($params) ) {

				add_message("alert", "the course was added sucessfully");
				header("Location:". $_SERVER['HTTP_REFERER']);
				die();

			} else {

				// the model should return a message.
				header("Location:". $_SERVER['HTTP_REFERER']);
				die();

			}
		
		}

	} else {
		die("you're not an admin. Make course controller show another message");
	}

	// It should use the model to create a course

}


// --------------- getCourseSchedules.php ---------------------
// THis page was mainly for testing. If you earase the page. Erase this code

function getCourseSchedules($ObjectPDO) {

	// request method is post
	if( $_SERVER['REQUEST_METHOD'] == "POST") {

		// If the user is not signed in
		if( !userSignedIn() ) {
			die("please sign in to continue");
		}


		$params = $_POST;
		$course = new Course($ObjectPDO);

		// This will only get the schedules with a course ID of 1 for now;
		$result = $course->get_course_schedule("1");

		return $result;


	} else {

		die("we weren't able to get the course schedules, maybe you need to code it correctly...");

	}
}


// ----------------- Edit Course -------------------------

/**
 * update_course($params) 
 *
 * Update a course using the parameters submitted.
 *
 * @param (Obect) Accepts the PDO Object
 * @param (Array) params array submitted from form
 * @return (params)
 */
function update_course($ObjectPDO, $params) {

	// If something breaks its probably because this isn't here
	// require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	// require_once(D_ROOT . "/reou/helpers/users_helper.php");

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

			$course = new Course($ObjectPDO);

			// Die. If the user tried to edit another user. This wont work because a notmal user is able to edit
			// from session while admin edits from get.
			// if( $_GET['userId'] != $_POST['userId'] ) {
			// 	add_message("error", "An error occured when trying to update the user");
			// 	header( "Location:" . $_SERVER['REQUEST_URI']);
			// 	die();
			// }

			// Make sure a user cannot edit another user unless they are an admin
			// Do something if there is no session of the session is no loger tehr

			// If the user isn't an admin and they are trying to modify one of the courses. Actually, regular users should not be able to modify a course period, so im going to error out when a user attmeps to do this.
			if(!userIsAdmin()) {

				// Direct the user back to the home page
				header("Location:" . course_route("course_category") );
				die();
			}


			if( $course->update_user($_POST) ) {
				add_message("alert", "Profile has been Successfully Updated");

				// Take the user back to the course edit page.
				header( "Location:" . $_SERVER['REQUEST_URI']);
				die();
			} 
			else {
				add_message("error", "An error occured while trying to update the course");
			}

		} 
		else {
			die("Error has occured. Incorrect update method was used.");
		}
	}

}
	

function edit_course($ObjectPDO) {
	// TODO - Mak sure that a user input is filtered.

	// If User isn't signed in, go back to home page
	if( !userSignedIn() ) {
		redirectHome();
		die("You should not be here");
	}

	// If the user is not an admin then take them back home.
	// A normal user should not be able to see this page.
	if( userSignedIn() && !userIsAdmin() ) {
		redirectHome();
	}

	// If the user is sign in and is an admin
	if( userSignedIn() && userIsAdmin() ) {

		if( !isset($_GET['courseId']) || trim($_GET['courseId'] == "") ) {
			// Should redirect back to the course edit page;
			redirectHome();
		}

		$course = new Course($ObjectPDO);

		// Uses $_GET variable to show the course details
		$results = $course->get_class_details($_GET['courseId']);

		// Todo - get a cournt of result instead of whether there is something in ther or not.
		if(!$results) {
			redirectHome();
			return false;
		}

		// Make each array item HTML safe;
		$results = makeArrayHtmlSafe($results);

		return $results;

	}

	die("edit_profile ran into a critical error. You must be signed in to continue");
	
}



function update_course_schedule() {
	// Perhaps for each course schedule you can create an ajax request 
	// instead of sumitting each course over again
}



// --------------- course_register.php ---------------------

function course_register($ObjectPDO) {

	// have a user register for a course
	
	if($_SERVER['REQUEST_METHOD'] == 'POST') {

		// If a user isn't sign in then it wont work
		if( !userSignedIn() ) {
			die("Please sign in to continue");
		}


		$params = $_POST;
		$course = new Course($ObjectPDO);
		$course->register_course($params);

	} else {
		// maybe kick the user back to the main screen...
		die("controller_course register isnt there");
		
	}
	// $params are {course_id => "#", student_id => "#", schedule_id => "#" }
}




// --------------- my-courses.php ---------------------

// I don't know why I created this function. remove it when finished
function my_courses_two($ObjectPDO) {

	if( userSignedIn() ) {

		$user_id = $_SESSION['id'];
		
		$course = new Course($ObjectPDO);
		$categories = $course->get_registered_courses($user_id);
		$categories = scrub_array_output($categories); // Scrub Output
		return $categories;

	} 
	else {
		header("Location:" . course_route("course_category") );
	}

}




function my_courses($ObjectPDO) {

	if( userSignedIn() ) {

		$user_id = $_SESSION['id'];
		
		$course = new Course($ObjectPDO);
		$categories = $course->get_registered_courses($user_id);
		$categories = scrub_array_output($categories); // Scrub Output
		return $categories;

	} 
	else {
		header("Location:" . course_route("course_category") );
	}

}


?>
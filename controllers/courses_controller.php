<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/includes/const.php');
require_once(D_ROOT . "/reou/models/database.php");
require_once(D_ROOT . '/reou/helpers/helpers.php');
require_once(D_ROOT . '/reou/helpers/courses_helper.php');
require_once(D_ROOT . '/reou/helpers/users_helper.php');
require_once(D_ROOT . '/reou/controllers/routes.php');
require_once(D_ROOT . "/reou/models/Course.php");
require_once(D_ROOT . "/reou/models/Schedule.php");
require_once(D_ROOT . "/reou/models/User.php");


// --------------- course_category.php ---------------------

function course_category($ObjectPDO) {

	$course = new Course($ObjectPDO);
	$categories = $course->get_course_category();
	// $categories = scrub_array_output($categories); //scrub output
	scrub_array_output($categories); // Scrub Output with html entities

	return $categories;
}



// --------------- course_classes.php --------------------- //

function course_classes($ObjectPDO) {

	$course_id = verify_get('id');
	$course = new Course($ObjectPDO);
	$result_array = Array();
	
	$categories = $course->get_course_classes($course_id);
	$one_category = $course->get_one_course_category($course_id);

	// $categories = scrub_array_output($categories); //scrub output
	// $one_category = scrub_array_output($one_category); //scrub output
	scrub_array_output($categories); // Scrub Output with html entities
	scrub_array_output($one_category); // Scrub Output with html entities


	
	array_push($result_array, $categories);
	array_push($result_array, $one_category);

	return $result_array;

}



// Is this function being used?
function course_search($ObjectPDO, $keyword) {

	$keyword = verify_get('q');
	$course = new Course($ObjectPDO);
	$result_array = Array();

	$courses = $course->search_courses($keyword);


	// $categories = scrub_array_output($categories); //scrub output
	// $one_category = scrub_array_output($one_category); //scrub output
	scrub_array_output($courses); // Scrub Output with html entities

	return $courses;

}





// --------------- course_detail.php ---------------------

function course_detail($ObjectPDO) {

	$course_class_id = verify_get('id');

	if( verify_get('id') ) {
		$course_class_id = verify_get('id');
	} else {
		// SHOULD REDIRECT TO COURSE LISTING PAGE - Right now I have it going to course detail

		redirectHome();
	}

	$course = new Course($ObjectPDO);
	$schedule = new Schedule($ObjectPDO);
	$result_array = Array();


	// Get Course Details and Schedules
	$course_details = $course->get_class_details($course_class_id);
	$course_schedules = $schedule->get_course_schedule($course_class_id);

	if (empty($course_details)) {
		// Should go to course list page instead of home.
		redirectHome();
	}


	// Push the result of each to the result array
	array_push($result_array, $course_details);
	array_push($result_array, $course_schedules);


	// I need to find a way to srube the data in a different way.
	// foreach ($result_array as $k => $v) {
	// 	$result_array[$k] = scrub_array_output($v);
	// }
	// $result_array[$k] = scrub_array_output($v);
	

	return $result_array;
}

// --------------- course_show.php (admin) ---------------------

function course_show($ObjectPDO) {

	$course = new Course($ObjectPDO);
	$courses = $course->get_courses();
	return $courses;
}





function course_edit($ObjectPDO) {

	$course_class_id = verify_get('courseId');

	if( verify_get('courseId') ) {
		$course_class_id = verify_get('courseId');
	} 
	else {
		// SHOULD REDIRECT TO COURSE LISTING PAGE - Right now I have it going to course detail
		redirectHome();
	}

	$course = new Course($ObjectPDO);
	$user = new User($ObjectPDO);
	$result_array = Array();

	


	// Retrive data from database
	$details = $course->get_class_details($course_class_id);

	if (empty($details)) {
		// Should go to course list page instead of home.
		redirectHome();
	}


	$schedules = $course->get_course_schedule($course_class_id);
	$course_categories = $course->get_course_category();
	$instructors = $user->get_instructors();


	// Take the days_available result and convert it to binary arry
	foreach ($schedules as $k => $course_schedule) {
		$schedules[$k]['days_available'] = decToBinArray($course_schedule['days_available']);
	}
	unset($couse_schedule);

	// Push the result of each to the result array
	array_push($result_array, $details);
	array_push($result_array, $schedules);
	array_push($result_array, $course_categories);
	array_push($result_array, $instructors);


	// I need to find a way to srube the data in a different way.
	// scrup_array_output only handles up to two-dimentional arrays
	foreach ($result_array as $k => $v) {
		scrub_array_output($v);
	}

	return $result_array;
}



// --------------- course_create.php -----------------------

function course_create($ObjectPDO) {

	if( userSignedIn() && userIsAdmin() ) {

		$results = array();
		$course = new Course($ObjectPDO);
		$results['course_category'] = $course->get_course_category();

		

	
	// if( $_SERVER['REQUEST_METHOD'] == 'POST' )
	if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['_method'])  ) {

			$params = $_POST;
			unset($params['_method']);
			unset($_POST['_method']);
			unset($params['_method']);
			$_POST = check_honeypot_fields($_POST);


		if( $course->create_course($params) ) {
			# If the course creates sucessfully
			add_message('alert', 'the course was created succesfully');
			header("Location:". admin_route('admin-home'));
		} 
		else {
			return $results;
		}
		
		// add_message("alert", "there was a problem creating the class");
		// header("Location:". $_SERVER['HTTP_REFERER']);
		// die();

		
		}

		return $results;
		
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

				add_message("alert", "the course schedule was added successfully");
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



function admin_get_courses($ObjectPDO) {

	$params = $_POST;
	$course = new Course($ObjectPDO);
	
	// Get All courses
	$result = $course->get_courses();

	return $result;
}


/**
 * update_user($params) 
 *
 * Update a user using the parameters submitted. Don't worry only allowed params can be submitted.
 *
 * @param (Obect) Accepts the PDO Object
 * @param (Array) params array submitted from form
 * @return (params)
 */
function update_course($ObjectPDO, $params) {

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


			// Check to see if you're updating the right course
			if( $_GET['courseId'] != $_POST['courseId']) {
					add_message("alert", "Error occured on update");
					header( "Location:" . $_SERVER['REQUEST_URI']);
				die();

			} 



			$course = new Course($ObjectPDO);

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

			// Update the course
			



			// The user should not be able to update if the email already exists in the system


			// Admins Should not be able to change the email address

			if( $course->update_course($_POST) ) {

				add_message("alert", "Course has been successfully updated");
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

	


}



function edit_couse($ObjectPDO) {

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
	if ( userSignedIn() && userIsAdmin() ) {

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

// ----------------- Edit Course -------------------------




function edit_course($ObjectPDO) {
	// TODO - Mak sure that a user input is filtered.

	// If User isn't signed in, go back to home page
	if( !userSignedIn() ) {
		die("You should not be here");
		redirectHome();
		
	}

	// If the user is not an admin then take them back home.
	// A normal user should not be able to see this page.
	if( userSignedIn() && !userIsAdmin() ) {
		die("You should really not be here");
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
		// $categories = scrub_array_output($categories); // Scrub Output
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
		// $categories = scrub_array_output($categories); // Scrub Output
		scrub_array_output($categories); // Scrub Output with html entities
		return $categories;

	} 
	else {
		header("Location:" . course_route("course_category") );
	}

}


?>

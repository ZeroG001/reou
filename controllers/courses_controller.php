<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/includes/const.php');
require_once(D_ROOT . "/reou/models/database.php");
require_once(D_ROOT . '/reou/helpers/courses_helper.php');
require_once(D_ROOT . '/reou/helpers/users_helper.php');
require_once(D_ROOT . '/reou/controllers/routes.php');
require_once(D_ROOT . "/reou/models/Course.php");


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

	session_start();

	$course_class_id = verify_get('id');
	$course = new Course($ObjectPDO);
	$result_array = Array();

	$details = $course->get_class_details($course_class_id);
	$schedules = $course->get_course_schedule($course_class_id);

	array_push($result_array, $details);
	array_push($result_array, $schedules);

	foreach ($result_array as $k => $v) {
		$result_array[$k] = scrub_array_output($v);
	}
	

	return $result_array;
}




// --------------- course_create.php -----------------------

function course_create($ObjectPDO) {
	

	if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

		//removeme
		session_start(); // Might erase this because it might not be nessessary to start a session.

		$params = $_POST;

		// _method needs to be removed on submit.
		unset($params['_method']);


		//Check and scrub parameters

		$course = new Course($ObjectPDO);


		// If the course was created, show sucess message. Else, show an error message.
		if($course->create_course($params)) {

			add_message("alert", "the course was added sucessfully");
			header("Location:". $_SERVER['HTTP_REFERER']);
			die();

		} else {

			add_message("alert", "there was a problem creating the class");
			return $params;
		}
		
	}

}



// --------------- course_register.php ---------------------

function course_register($ObjectPDO) {
	
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
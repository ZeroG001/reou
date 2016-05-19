<?php

require($_SERVER['DOCUMENT_ROOT'] . '/reou/includes/const.php');
require_once(D_ROOT . "/reou/models/database.php");
require(D_ROOT . '/reou/helpers/courses_helper.php');
require(D_ROOT . '/reou/helpers/users_helper.php');
require(D_ROOT . '/reou/controllers/routes.php');
require(D_ROOT . "/reou/models/Course.php");



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

		//Change this//
		session_start(); // Might erase this because it might not be nessessary to start a session.

		$params = $_POST;

		unset($params['_method']);

		var_dump($params);
		
		$course = new Course($ObjectPDO);

		if($course->add_course($params)) {
			add_message("alert", "couse has been sucessfully updated");
			header("Location:". $_SERVER['HTTP_REFERER']);
			die();
		} else {

			die("there was a problem in coursse controller.php");
		}
		
	}
	// If the request method is post
		// Use params to push an update request to the model code.


}



// --------------- course_register.php ---------------------

function course_register($ObjectPDO) {
	
	if($_SERVER['REQUEST_METHOD'] == 'POST') {

		// If a user isn't sign in then it wont work
		if( !userSignedIn() ) {
			die("Please sign in to continue");
		}

		//----- Debug --------
			var_dump($_POST);
		//-------------------

		$params = $_POST;
		$course = new Course($ObjectPDO);
		$course->register_course($params);

	} else {
		//maybe kick the user back to the main screen...
		die("controller_course register isnt there");
		
	}
	// $params are {course_id => "#", student_id => "#", schedule_id => "#" }
}



// --------------- my-courses.php ---------------------

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
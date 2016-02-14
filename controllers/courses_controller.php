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

	return $categories;
}



// --------------- course_classes.php ---------------------

function course_classes($ObjectPDO) {

	$course_id = verify_get('id');
	$course = new Course($ObjectPDO);
	$categories = $course->get_course_classes($course_id);

	return $categories;

}



// --------------- course_classes.php ---------------------

function course_detail($ObjectPDO) {

	session_start();


	$return_values = [];
	$course_class_id = verify_get('id');
	$course = new Course($ObjectPDO);

	$return_values['details'] = $course->get_class_details($course_class_id);
	$return_values['schedules'] = $course->get_course_schedule($course_class_id);

	return $return_values;
}



// --------------- course_register.php ---------------------

function course_register($ObjectPDO) {
	
	if($_SERVER['REQUEST_METHOD'] == 'POST') {

		// If a user isn't sign in then it wont work
		if( !isset($_POST['student_id']) ) {
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


	// You were right here about to connect the controller to MODEL. Call the 
	// reguster class fucntion
}



// --------------- my-courses.php ---------------------

function my_courses($ObjectPDO) {

	if( userSignedIn() ) {

		$user_id = $_SESSION['id'];
		
		$course = new Course($ObjectPDO);
		$categories = $course->get_registered_courses($user_id);
		return $categories;

	} 
	else {
		header("Location:" . course_routes("course_category") );
	}

}

?>
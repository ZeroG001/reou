<?php

function course_category() {
	require($_SERVER['DOCUMENT_ROOT'] . '/reou/includes/const.php');
	require(D_ROOT . '/reou/helpers/courses_helper.php');


	function _autoload($class_name) {
		require_once(D_ROOT . "/reou/models/". $class_name . '.php');
	}


	$course = new Course($db);
	$categories = $course->get_course_category();
} // Course Category End


function course_classes() {

	require($_SERVER['DOCUMENT_ROOT'] . '/reou/includes/const.php');
	require(D_ROOT . '/reou/courses/helpers/helpers.php');

	function _autoload($class_name) {
		require_once("classes/". $class_name . '.php');
	}

	$course_id = verify_get('id');
	$course = new Course($db);
	$categories = $course->get_course_classes($course_id);


	// Debugging -------------------------

	if(isset($categories[0]) && !empty($categories[0]) ) {
		foreach ($categories[0] as $k => $v) {

			echo $k . " - ";

		};		
	};

	// -----------------------------------
} // Course Classes End

function course_detail() {

	require($_SERVER['DOCUMENT_ROOT'] . '/reou/includes/const.php');
	
	function __autoload($class_name) {
		require_once("classes/". $class_name . '.php');
	}

	require(D_ROOT . '/reou/courses/helpers/helpers.php');


	$course_class_id = verify_get('id');
	$course = new Course($db);
	$course_detail = $course->get_class_details($course_class_id);
	$course_schedules = $course->get_course_schedule($course_class_id);


	// Debugging -------------------------

	if( isset($course_details[0]) && !empty($course_details[0]) ) {
		foreach ($course_details[0] as $key => $value) {
				echo $k . " - ";
			}	
	}
	// -----------------------------------
} // Course Detail end

// Perhaps make a controller class.
// This way you can auto load all classes in this obeject.

?>
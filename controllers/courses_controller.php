<?php

require($_SERVER['DOCUMENT_ROOT'] . '/reou/includes/const.php');
require_once(D_ROOT . "/reou/models/database.php");
require(D_ROOT . '/reou/helpers/courses_helper.php');
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

	$return_values = [];
	$course_class_id = verify_get('id');
	$course = new Course($ObjectPDO);

	$return_values['details'] = $course->get_class_details($course_class_id);
	$return_values['schedules'] = $course->get_course_schedule($course_class_id);

	return $return_values;
}


?>
<?php

	require($_SERVER['DOCUMENT_ROOT'] . '/reou/controllers/courses_controller.php');
	$course_schedules = getCourseSchedules($db);


	foreach ($course_schedules as $course_schedule ) {
		echo $course_schedule['days_available'];
	}

	// Header HTML

?>
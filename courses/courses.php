<?php
	require('../includes/const.php');
	require(D_ROOT . '/reou/includes/database.php');

	$course = new Course($db);
	$courses = $course->get_course_classes("1");	

	foreach ($courses as $v) {
		echo $v['course_name'];
		echo $v['course_number'];
		echo $v['course_hours_day'];
		echo $v['course_duration_day'];
		echo $v['course_name'];
		echo $v['course_name'];
	}
?>

<style type="text/css">
	.wrap {
		max-width: 1000px;
	}
	.box {
		display: inline-block;
		height: 300px;
		width: 33%;
		border: 1px solid black;
		margin-left: -4px;
	}
</style>

<div class="wrap">
	<div class="box">

	</div>
	<div class="box">

	</div>
	<div class="box">

	</div>
</div>
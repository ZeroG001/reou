<?php
	require('../includes/const.php');
	require(D_ROOT . '/reou/classes/course.php');
	require(D_ROOT . '/reou/courses/helpers/helpers.php');


	$course_class_id = verify_get('id');
	$course = new Course($db);
	$course_detail = $course->get_course_details($course_class_id);
	$course_schedules = $course->get_course_schedule($course_class_id);

	var_dump($course_detail);

?>

<html>
	<head>
		<title></title>
	</head>

	<body>

	<link rel="stylesheet" type="text/css" href="../css/main.css">

	<div class="wrap">

		<h3> Course Name </h3>

		<?php foreach ($course_detail as $detail) { ?>
		
			<p><?php echo $detail['course_name'] ?></p> 

			<h3> Days Offered </h3>
			<p><?php echo $detail['course_days_day'] ?></p> 

			<h3> Hours </h3>
			<p><?php echo $detail['course_hours_day'] ?> </p> 

			<h3> Duration </h3>
			<p><?php echo $detail['course_duration_day'] ?> </p> 

			<h3> Cost </h3>
			<p><?php echo $detail['course_cost_day'] ?></p> 

			<h3> Description </h3>
			<p><?php echo $detail['course_desc'] ?> </p> 

			<h3> Notes </h3>
			<p><?php echo $detail['course_notes'] ?> </p>

		<?php } ?>

		<h2> Course Schedules and Availiblilty </h2>

		<?php foreach ($course_schedules as $detail) { ?>
			
			<h3> Begin Date </h3>
			<p><?php format_date($detail['class_date']) ?> </p>

			<h3> Time </h3>
			<p> 
				<?php printf('%s - %s', $detail['class_begin_time'], $detail['class_end_time']) ?> 
			</p>

			<h3> Location </h3>
			<p> <?php echo $detail['course_location'] ?> </p>

		<?php } ?> 

	</div>

	</body>

</html>
	

	



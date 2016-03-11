<?php

	require($_SERVER['DOCUMENT_ROOT'] . '/reou/controllers/courses_controller.php');
	

	list($course_details, $course_schedules) = course_classes($db);

	var_dump($course_details);
	var_dump($course_schedules);


	// ------------ DEBUG --------------------


	// ------------ DEBUG --------------------

	require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/views/layouts/header.php');

?>

<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../assets/css/main.css">
	</head>

	<body>


		<div class="page-banner">

			<div class="banner-title-wrapper">
				<h1>  </h1>
			</div>
			
			<div class="banner--footer">

			</div>
		</div>

		
		<div class="wrap">



			<h3> Course Name </h3>

			<?php foreach ($course_details as $detail) { ?>
			
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

				<form action="<?php echo course_route('course_register') ?>" method="POST">	
					<input type="submit" value="Sign Up" > 
					<input type="hidden" name="course_id" value="<?php echo $course_detail['details'][0]['course_id'] ?>">
					<input type="hidden" name="student_id" value="<?php echo $_SESSION['id'] ?>">
					<input type="hidden" name="schedule_id" value="<?php echo $detail['schedule_id'] ?>">
				</form>

			<?php } ?> 



		</div>

	</body>

</html>
	

	



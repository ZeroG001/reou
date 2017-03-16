<?php

	require($_SERVER['DOCUMENT_ROOT'] . '/reou/controllers/courses_controller.php');
	list($course_details, $course_schedules) = course_detail($db);


	// ------------ DEBUG --------------------
		// var_dump($course_details);
		// var_dump($course_schedules);
	// ------------ DEBUG --------------------


	// ---------------------------- Include Header ----------------------------
	require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/views/layouts/header.php');

?>

<html>

	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="<?php echo asset_route('css')?>main.css">
	</head>

	<body>

		<div class="page-banner">
			<div class="banner-title-wrapper">
				<h1> <?php echo $course_details['course_name'] ?> </h1>

				<p><?php echo $course_details['course_desc'] ?> </p> 
			</div>
			
			<div class="banner--footer">

			</div>
		</div>



		
		<div class="main-content">


			<!-- Course Info
			====================================================== -->

			<div class="course_info_title">
				 <h1> Course Info </h1>
				<img src="<?php echo asset_route('img')?>info_icon.svg" />
			</div>

			<div class="course_info--wrap">

				<div class="course_info--item">
					<h3> Course Number </h3>
					<p> <?php echo $course_details['course_number'] ?> </p>
				</div>

				<div class="course_info--item">
					<h3> Hours </h3>
					<p> <?php echo $course_details['course_hours_day']?> </p>
				</div>

				<div class="course_info--item">
					<h3> Cost </h3>
					<p> <?php echo $course_details['course_cost_day'] ?> </p>
				</div>

				<div class="course_info--item__notes"> 
					<h3> Important Notes </h3>
					<p> <?php echo $course_details['course_notes'] ?> </p>
				</div>

			</div>
			<!-- ===================================================== -->

		</div>


		<div class="main-content">

			<!-- Course Schedule and Availibility
			====================================================== -->
			<div class="course_info_title">
				 <h1> Schedule </h1>
				<img src="<?php echo asset_route('img')?>schedule_icon.svg" />
			</div>

			<table class="course_schedule--table">

				<tr> 
					<th> Begin Date </th>
					<th> End Date </th>
					<th> Time </th>
					<th> Location </th>
					<th> See Schedule </th>
					<th> Register course? </th>
					
				</tr>

				<?php foreach ($course_schedules as $detail) { ?>

					<tr class="course_schedule--data-row"> 
						<td> <?php echo $detail['start_date'] ?> </td>
						<td> <?php echo $detail['end_date'] ?> </td>
						<td> <?php printf('%s - %s', $detail['start_time'], $detail['end_time']) ?>  </td>
						<td> <?php echo $detail['location'] ?> </td>
						<td> 
							<div class="course_schedule--show-calendar"> SEE SCHEDULE </div>
						 </td>
						<td>
							<form class="course_schedule--sign-up-form" action="<?php echo course_route('course_register') ?>" method="POST">	
							<input type="submit" class="schedule_signup_button"value="JOIN CLASS" > 
							<input type="hidden" name="course_id" value="<?php echo $detail['course_id'] ?>">
							<input type="hidden" name="student_id" value="<?php echo $_SESSION['id'] ?>">
							<input type="hidden" name="schedule_id" value="<?php echo $detail['schedule_id'] ?>">
							</form> 
						</td>

					</tr>

					<tr class="course_schedule--calendar">
					
						<td colspan="100%">
						<div class="show_calendar_section"> <?php echo createCalendarHTML($detail['start_date'], $detail['end_date'], explode(",", $detail['schedule_code']) ) ?> </div>
						</td>
					</tr>

				<?php } ?>

			</table>

			<!-- ===================================================== -->

		</div>



	<script type="text/javascript" src="<?php echo asset_route('js') . "jquery/dist/jquery.min.js" ?>"> </script>
	<script type="text/javascript" src="<?php echo asset_route('js') . "course_detail.js" ?>"> </script>

	</body>

</html>

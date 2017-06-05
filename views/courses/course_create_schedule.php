<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	require_once(D_ROOT . "/reou/controllers/courses_controller.php");

	course_create_schedule($db, $_POST);


	// ----------------- Header HTML --------------------
	require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/views/layouts/header.php');

?>


<html>

	<head>
		<title> Course Create Schedule </title>
		<link rel="stylesheet" type="text/css" href="<?php echo asset_route('css') ?>main.css">
	</head>

	<body>

		<!-- Datatbase Rows -->


		<!--
			schedule_id
			course_id
			staff_id
			location
			days_available
			class_date
			class_begin_date
			class_end_date
			class_begin_time
			class_end_time
			active

			final_exam [x]
			state_exam [x]
			graduation [x]
		-->

		<!-- Action should be the course acc place -->


		<!-- Alert Message  -->
		<div class="alert">
			<?php display_alert('error') ?>
			<?php display_alert('alert') ?>
			<?php clear_alert(); ?>
		</div>

		<form method="POST" action="" class="class-schedule-form">

			<h1> Create Class Schedule </h1>

			<input type="hidden" id="action" name="_method" value="post">

			<!-- Items related to course timing -->
			<fieldset>

				<h3> Course Schedule </h3>


				<!-- Course ID -->
				<label for="courseId" class="class-schedule-label"> Course ID </label>
				<input type="text" name="course_id" value=""> <br /><br />

				<!-- class_begin_date -->
				<label class="class-schedule-label"> One Day Only </label>
				<input  type="checkbox" class="schedule-form__field" id="schedule_one_day"><br /><br />

				<!-- class_begin_date -->
				<label class="class-schedule-label"> Enter Start Date </label>
				<input  type="text" name="start_date" class="schedule-form__field" id="schedule_start_date" placeholder="mm/dd/yyyy"><br /><br />

				<!-- class_end_date -->
				<label class="class-schedule-label"> Enter End Date </label>
				<input type="text" name="end_date" class="schedule-form__field" id="schedule_end_date" placeholder="mm/dd/yyyy"><br /><br />

				<!-- Start Time -->
				<label for="startTime" class="class-schedule-label"> Start Time </label>
				<input type="text" name="start_time" class="schedule-form__field" /><br /><br />

				<!-- End Time -->
				<label for="endTime" class="class-schedule-label"> End Time </label>
				<input type="text" name="end_time" class="schedule-form__field"><br /><br />


				<!-- Location -->
				<label for="location" class="class-schedule-label"> Location </label>
				<input type="text" name="location" class="schedule-form__field"><br /><br />


				<!--  -->
				<label for="number-of-weeks" class="class-schedule-label"> Number of Weeks </label>
				<input type="text" id="number-of-weeks" class="schedule-form__field"> <br />

				<div class="week-days-group">
			
					<input type="checkbox" name="recur-day" value="1" class="recur-day" id="recur-day-sun"> <label for="recur-day-sun">S</label>
					<input type="checkbox" name="recur-day" value="1" class="recur-day" id="recur-day-mon"> <label for="recur-day-mon">M</label>
					<input type="checkbox" name="recur-day" value="1" class="recur-day" id="recur-day-tue"> <label for="recur-day-tue">T</label>
					<input type="checkbox" name="recur-day" value="1" class="recur-day" id="recur-day-wed"> <label for="recur-day-wed">W</label>
					<input type="checkbox" name="recur-day" value="1" class="recur-day" id="recur-day-thu"> <label for="recur-day-thu">T</label>
					<input type="checkbox" name="recur-day" value="1" class="recur-day" id="recur-day-fri"> <label for="recur-day-fri">F</label>
					<input type="checkbox" name="recur-day" value="1" class="recur-day" id="recur-day-sat"> <label for="recur-day-sat">S</label>
				</div>

				<input type="hidden" id="schedule_code" name="schedule_code" value="">
				
				<button id="addDate"> Go </button>
				<input type="Submit" value="Submit">

				<div id="schedule_wrap"> 

					<!-- Here is where all weeks will appear -->

				</div>


			</fieldset>			

		</form>

	</body>

	<script type="text/javascript" src="<?php echo asset_route('js') . "jquery/dist/jquery.min.js" ?>"> </script>
	<script type="text/javascript" src="<?php echo asset_route('js') ?> schedule_create.js" ></script>
</html>

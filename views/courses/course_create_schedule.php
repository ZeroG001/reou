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

		<style>

				.week-wrap { 
					padding: 20px; 
				}

				.week-wrap h3 {
					vertical-align: top;
					margin: 0 20px 0px 0px;
				}

				.week-wrap h3 {
					display: inline;
				}

				.weekday-container {
					display: inline-block;
					width: 50px;
				}

				.weekday-container label {
					display: block;
				}

				.schedule__container {
					margin-top: 40px;
					box-shadow: 0px 4px 5px 0px rgba(0, 0, 0, 0.14), 0px 1px 10px 0px rgba(0, 0, 0, 0.12), 0px 2px 4px -1px rgba(0, 0, 0, 0.2);
				}


				.schedule__container table {
					table-layout: fixed;
					width: 100%;
				}

				.schedule__container label {
					display: block;
				}

				.schedule__container th {
					padding: 10px 0px
				}

				.schedule__container .dateBoxes {
					display: block;
				}

				.schedule__title h3 {
					margin: 0px;
					background-color: #0179C2;
					color: white;
					padding: 10px;
					font-family: helvetica;
				}

				.schedule__container {
					max-width: 323px;
				}


				.schedule__container td:nth-child(2n + 1) {
					background-color: #F5F5F5;
				}



				.schedule__container input[type="checkbox"] {
					display: none;
				}

				.schedule__container input[type="checkbox"] + label {
					cursor: pointer;
					text-align: center;
					box-sizing: border-box;
					margin: 0px auto;
					padding: 10px;
					-webkit-transition: 0.5s ease;
					-moz-transition: 0.5s ease;
					-o-transition: 0.5s ease;
					transition: 0.5s ease;
				}


				.schedule__container input[type="checkbox"]:checked + label {
					background-color: #01B5CC;
					color: white;
					-webkit-transition: 0.5s ease;
					-moz-transition: 0.5s ease;
					-o-transition: 0.5s ease;
					transition: 0.5s ease;
				}

				.schedule-date-time-group {}

				.class-schedule-label {
					display: block;
				}

				.week-days-group {
					margin: 20px 0px;
				}


				.week-days-group input[type="checkbox"] {
					display: none;
				}


				/* Week Day Group radio buttons */
				.week-days-group input[type="checkbox"] + label {
					cursor: pointer;
					text-align: center;
					box-sizing: border-box;
					border: 1px solid black;
					-webkit-transition: 0.2s ease;
					-moz-transition: 0.2s ease;
					-o-transition: 0.2s ease;
					transition: 0.2s ease;
					display: inline-block;
					border: 1px solid black;
					padding: 10px 15px;
				}



				.week-days-group input[type="checkbox"]:checked + label {
					background-color: #01B5CC;
					color: white;
					-webkit-transition: 0.2s ease;
					-moz-transition: 0.2s ease;
					-o-transition: 0.2s ease;
					transition: 0.2s ease;
				}

		</style>

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
	<script type="text/javascript" src="<?php echo asset_route('js') ?>schedule_create.js"></script>
</html>
            
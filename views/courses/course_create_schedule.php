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


		<form method="POST" action="">

			<h1> Create Class Schedule </h1>

			<input type="hidden" id="action" name="_method" value="patch">

			<!-- Items related to course timing -->
			<fieldset>

				<h3> Course Schedule </h3>


				<!-- Course ID -->
				<label for="courseId"> Course ID </label>
				<input type="text" name="courseId" value=""> <br /><br />


				<!-- class_begin_date -->
				<label for="classBeginDate"> Class Begin Date </label>
				<input type="text" name="classBeginDate" value=""> <br /><br />


				<!-- class_end_date -->
				<label for="classEndDate"> Class End Date </label>
				<input type="text" name="classEndDate" id="staffId" value=""> <br /><br />


				<!-- Days Availible -->
				<label for="daysAvailable"> Days Available </label>
				<input type="text" name="daysAvailable" id="daysAvailable" value=""> <br /><br />


				<!-- Location -->
				<label for="location"> Location </label>
				<input type="text" name="location" id="location" value=""> <br /><br />


			</fieldset>

			<input type="Submit" value="Submit">

		</form>

	</body>
</html>
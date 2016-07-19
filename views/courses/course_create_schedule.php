<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	require_once(D_ROOT . "/reou/controllers/course_controller.php");

	create_schedule($db, $_POST);
	$user = edit_profile($db);


	// ----------------- Header HTML --------------------
	require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/views/layouts/header.php');

?>


<html>

	<head>
		<title> Course Create Schedule </title>
	</head>

	<body>

		<!-- Action should be the course acc place -->
		<form method="POST" action="">


			<h1> Creating a new class </h1>



			<input type="hidden" id="action" name="_method" value="patch">


			<!-- Items related to course timing -->
			<fieldset>


				<h3> Course Schedule </h3>

				<!-- Schedule ID ( Hidden ) -->
				<label for="scheduleId"> Schedule ID </label>
				<input type="text" name="scheduleId" value="">


				<!-- Course Duration -->
				<label for="courseId"> Course ID </label>
				<input type="text" name="courseId" value="">


				<!-- class_begin_date -->
				<label for="classBeginDate"> Class End Date </label>
				<input type="text" name="courseId" value="">


				<!-- class_end_date -->
				<label for="classEndDate"> Class End Date </label>
				<input type="text" name="staffId" id="staffId" value="">


				<!-- Days Availible -->
				<label for="daysAvailable"> Days Availible </label>
				<input type="text" name="daysAvailible" id="daysAvailible" value=""> 


				<!-- Location -->
				<label for="location"> Location </label>
				<input type="text" name="location" id="location" value="">


			</fieldset>

			<input type="Submit" value="Submit">

		</form>

	</body>
</html>
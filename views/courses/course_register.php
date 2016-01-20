<?php
	require($_SERVER['DOCUMENT_ROOT'] . '/reou/controllers/courses_controller.php');
	course_register($db);
?>

<p> Thank you. You have Registered for the class </p>


<!-- 
	This migth be all php

	1. Get the User ID
	2. Get the class ID
	3. Get the class schedule

	Add all the information to the courses_classes through table.


	Down the line use that information to bring up the courses a user signed up for.
-->

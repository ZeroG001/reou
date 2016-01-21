<?php
	require($_SERVER['DOCUMENT_ROOT'] . '/reou/controllers/courses_controller.php');
	$course_info = my_courses($db);
?>

<html>
	<head>

		<title>My Courses</title>

	</head>
<body>

</body>
</html>


	<!-- Section that shows the classes they are assigned to -->
	<!-- For now do not give the students the ability to remove classes -->
	<!-- Only an admin can remove classes --> 
	<h1> My Assigned Classes </h1>

	<?php foreach ($course_info as $k => $class) { ?>
		
		<?php echo $class['name']; ?>

	<?php } ?>



	<!-- Crude Ascii Drawing of page -->


	<!--
		[		Course Title		]
		show schedule times?
		V
		Time1	Time2	Time3

	-->

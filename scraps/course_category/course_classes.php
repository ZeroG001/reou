<?php

	require('../includes/const.php');
	require(D_ROOT . '/reou/classes/course.php');
	require(D_ROOT . '/reou/courses/helpers/helpers.php');

	$course_id = verify_get('id');
	$course = new Course($db);
	$categories = $course->get_course_classes($course_id);


	// Debugging -------------------------

	if(isset($categories[0]) && !empty($categories[0]) ) {
		foreach ($categories[0] as $k => $v) {

			echo $k . " - ";

		};		
	};

	// -----------------------------------

?>

<html>

	<head>

		<title> Course Classes </title>

		<link rel="stylesheet" type="text/css" href="assets/css/main.css">

	</head>

	<body>

		<div class="page-banner">
			<h1> Course Title </h1>
			<p> This is a course description</p>
			<div class="banner--footer">

			</div>
		</div>

		<div class="main-content">

			<div class="course-container">

				<?php foreach ($categories as $k => $category) { ?>

					<a class="course-container--box" href='course_detail.php?id=<?php echo $category['course_id'] ?>'>

						<div class="course-container--box-body">
							<p> 
								Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
								Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
							</p>
						</div>

					</a>
					
				<?php } ?>

			</div>

		</div>

	</body>

</html>


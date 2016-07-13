<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/controllers/courses_controller.php');
	$courses = my_courses($db);

	// Header HTML
	require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/views/layouts/header.php');

	//Todo - It should show the course details when clicked

?>

<html>

	<head>

		<title>My Courses</title>

	</head>

	<body>

		<link rel="stylesheet" type="text/css" href="<?php echo asset_route('css')?>main.css">

		<div class="page-banner">
			<div class="banner-title-wrapper">
				<h1> My Courses </h1>
			</div>

			<div class="banner--footer">

			</div>
		</div>

		

		<div class="main-content">

			<?php  foreach ($courses as $k => $course) { ?>


				<a class="mycourse-container--box" href="<?php echo course_route('course_detail', array("id" => $courses['course_id']) ) ?>"
					<div class="class-container--box-body">
						<h1> 
							<?php echo $course['course_name'] ?> 
						</h1>
					</div>

					<div class="mycourse-container--box-footer"> </div>
				</a>		
				
			<?php } ?>


		</div>

	</body>

</html>


<?php

	require($_SERVER['DOCUMENT_ROOT'] . '/reou/controllers/courses_controller.php');
	$courses = admin_get_courses($db);


	// Header HTML
	require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/views/layouts/header.php');



?>

<html>

	<head>

		<title> Courses </title>


		<!-- Stylesheets -->
		<link rel="stylesheet" type="text/css" href="<?php echo asset_route('css')?>main.css">
		<link rel="stylesheet" type="text/css" href="<?php echo asset_route('css')?>/vendor/skeleton.css">
	</head>

	<body>

		<!-- Alert Message  -->
		<?php display_alert('alert') ?>


		<div class="course-search-container">

			<div class="course-search-wrap">

				<h1> Choose from our awesome courses </h1>

				<form id="course-search-from" action="#">
					<input type="text" class="course_search" name="course_search" placeholder="Search classes">
					<input type="submit" class="course_search_button" type="sibmit" value="search">
				</form>

			</div>
		</div>

		<div class="page-banner">
			<div class="banner-title-wrapper">
				<h1> Courses </h1>
			</div>

			<div class="banner--footer">

			</div>
		</div>


		<div class="main-content">

			<div class="class-container">
				<div class="sk-container course_list_container">
				<?php foreach($courses as $course) { ?>


						<div class="row"> 
							<div class="three columns"> <?php echo $course['course_name'] ?> </div>
							<div class="three columns"> <?php echo $course['course_id'] ?> </div> 
							<div class="three columns"> </div>
							<div class="three columns"> <a href="#"> EDIT </a> </div>
						</div>
					

					
				<?php } ?>
				</div>
			</div>
		</div>


	</body>

</html>
      
<?php

	require($_SERVER['DOCUMENT_ROOT'] . '/reou/controllers/courses_controller.php');
	// list($categories, $one_category) = course_search($db);
	$courses = course_search($db);

	var_dump($courses);

	// Header HTML
	require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/views/layouts/header.php');
?>

<html>

	<head>

		<title> <?php echo "search results" # $one_category['category_name'] ?> </title>


		<!-- Stylesheets -->
		<link rel="stylesheet" type="text/css" href="<?php echo asset_route('css')?>main.css">
	</head>

	<body>

		<!-- Alert Message  -->
		<?php display_alert('alert') ?>


		<div class="course-search-container">

			<div class="course-search-wrap">

				<h1> Select a stage </h1>

				<form id="course-search-from" method="GET" action="<?php echo course_route( 'course_search' ) ?>">
					<input type="text" class="course_search" name="q" placeholder="Search classes">
					<input type="submit" class="course_search_button" type="submit" value="search">
				</form>

			</div>
		</div>

		<div class="page-banner">
			<div class="banner-title-wrapper">
				<h1> <?php # echo $one_category['category_name'] ?> </h1>
			</div>

			<div class="banner--footer">

			</div>
		</div>


		<div class="main-content">

			<div class="class-container">

				<?php foreach ($courses as $k => $course) { ?>

					<a class="class-container--box" href='<?php echo course_route('course_detail', array("id" => $course['course_id']) ) ?>'>
						<div class="class-container--box-body">
							<h1> 
								<?php echo $course['course_name']; ?>
							</h1>
						</div>

						<div class="class-container--box-footer">

							<div class="box-footer--detail-box">
								<div class="detail-box-title"> Hours </div>
								<div class="detail-box-description"> <?php echo numExtract( $course["course_duration_day"] )?> </div>
							</div>


							<div class="box-footer--detail-box">
								<div class="detail-box-title">Price</div>
								<div class="detail-box-description"><?php echo numExtract( $course["course_cost_day"] )?></div>
							</div>
							
						</div>
					</a>
					
				<?php } ?>

			</div>

		</div>


	</body>

</html>


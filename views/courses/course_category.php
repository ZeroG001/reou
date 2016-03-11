<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/controllers/courses_controller.php');
	$categories = course_category($db);


	//Header HTML
	require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/views/layouts/header.php');
?>

	<link rel="stylesheet" type="text/css" href="assets/css/main.css" />

	<div class="main-content">

		<div class="course-container">

		<!-- Show Course Categories -->
		<?php  foreach ($categories as $k => $category) { ?>


				<a class="course-container--box" href='<?php echo course_route("course_classes", ["id" => $category["category_id"] ]) ?>'>

					<div class="course-container--box-header">
							<?php echo $category['category_name'] ?>
					</div>

					<div class="course-container--box-body">
						<p> this is some filler text </p>
					</div>

					<div class="course-container--box-footer"></div>
				</a>
					

		<?php } ?>

		</div>

	</div>
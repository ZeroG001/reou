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
					<!-- background image refactor needed. Right now its just an inline style. -->
					<a class="course-container--box" href='<?php echo course_route("course_classes", array("id" => $category["category_id"]) ) ?>'
					style='background: linear-gradient( rgba(0, 0, 0, 0.05), rgba(0, 0, 0, 0.05) ), url( "<?php echo asset_route('dbimg') . $category['image_filename'] ?>" )'>

						<div class="course-container--box-header">
								<?php echo $category['category_name'] ?>
						</div>

						<div class="course-container--box-body">
							
						</div>

						<div class="course-container--box-footer"></div>
					</a>
			<?php } ?>

		</div>

	</div>
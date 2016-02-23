<?php
	require($_SERVER['DOCUMENT_ROOT'] . '/reou/controllers/courses_controller.php');
	$categories = course_category($db);

	require($_SERVER['DOCUMENT_ROOT'] . '/reou/views/layouts/header.php');
?>

	<link rel="stylesheet" type="text/css" href="<?php echo W_ROOT . 'assets/css/main.css' ?> " />

	<div class="wrap">

		<!-- Show Course Categories -->
		<?php  foreach ($categories as $k => $category) { ?>

			<div class="courses__box">

				<a href='<?php echo course_route("course_classes", ["id" => $category["category_id"] ]) ?>'> 
					<?php echo $category['category_name'] ?> 
				</a>
				
			</div>

			<br />

		<?php } ?>

	</div>


	<!-- Sign in and Sign Out Links -->
	<?php if(userSignedIn()) { ?>

		<a href="<?php echo user_route('sign-out') ?>"> Sign out </a> <br />
		<a href="<?php echo user_route('my-courses') ?>"> My Courses </a> <br />

	<?php } else { ?>

		<a href="<?php echo user_route('sign-in') ?>"> Sign In </a> <br />

	<?php } ?>

		<a href="<?php echo user_router('my-courses')?>"> My Courses </a>
		
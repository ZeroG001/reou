<?php
	require($_SERVER['DOCUMENT_ROOT'] . '/reou/includes/const.php');
	require(D_ROOT . '/reou/helpers/courses_helper.php');
	require(D_ROOT . "/reou/models/Course.php");

	$course = new Course($db);
	$categories = $course->get_course_category();


?>
	<link rel="stylesheet" type="text/css" href="../css/main.css">

	<div class="wrap">
	<?php  foreach ($categories as $k => $category) { ?>


		<div class="courses__box">
			<a href='course_classes.php?id=<?php echo $category['category_id'] ?>'> 
				<?php echo $category['category_name'] ?> 
			</a>
		</div>

		<br />
		
	<?php } ?>
	</div>


</div>

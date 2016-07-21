<?php

	require('../includes/const.php');
	require(D_ROOT . '/reou/classes/course.php');
	require(D_ROOT . '/reou/courses/helpers/helpers.php');


	$course = new Course($db);
	$categories = $course->get_course_category();
?>
<link rel="stylesheet" type="text/css" href="../css/main.css">

<div class="alert">
	<?php display_alert('error') ?>
	<?php display_alert('alert') ?>
</div>

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


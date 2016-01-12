<?php
	require($_SERVER['DOCUMENT_ROOT'] . '/reou/controllers/courses_controller.php');
	$categories = course_category($db);
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

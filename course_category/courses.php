<?php
	if ($_SERVER['REQUEST_METHOD'] == "GET" and isset($_GET['id'])) {

	} else {
		
	}


	require('../includes/const.php');
	require(D_ROOT . '/reou/classes/course.php');

	$course = new Course($db);
	$categories = $course->get_course_category();
?>

<style type="text/css">

	.wrap {
		position: relative;
		display:block;
		max-width: 500px;
		margin:0px auto;
	}

	.box {
		display: inline-block;
		height: 300px;
		width: 100%;
		margin-bottom: 10px;
		border: 1px solid black;
	}
</style>

<div class="courses wrap">

	<?php  foreach ($categories as $category) { ?>

		<div class="courses__box">
			<a href='courses.php?id=<?php echo $category['category_id'] ?>'> 
				<?php echo $category['category_name'] ?> 
			</a>
		</div>

		<br />
		
	<?php } ?>


</div>
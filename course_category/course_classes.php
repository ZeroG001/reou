<?php

	if ($_SERVER['REQUEST_METHOD'] == "GET" and isset($_GET['id'])) {
		$course_id = $_GET['id'];
	} else {
		
	}

	require('../includes/const.php');
	require(D_ROOT . '/reou/classes/course.php');

	$course = new Course($db);
	$categories = $course->get_course_classes($course_id);
?>
<link rel="stylesheet" type="text/css" href="../css/main.css">

<div class="courses wrap">

	<?php  foreach ($categories as $k => $category) { ?>
	
		<div class="courses__box">
			<a href='course_detail.php?id=<?php echo $category['course_id'] ?>'> 
				<?php echo $category['course_name'] ?> 
			</a>
		</div>

		<br />
		
	<?php } ?>



</div>
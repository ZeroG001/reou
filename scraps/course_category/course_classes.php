<?php

	require('../includes/const.php');
	require(D_ROOT . '/reou/classes/course.php');
	require(D_ROOT . '/reou/courses/helpers/helpers.php');

	$course_id = verify_get('id');
	$course = new Course($db);
	$categories = $course->get_course_classes($course_id);


	// Debugging -------------------------

	if(isset($categories[0]) && !empty($categories[0]) ) {
		foreach ($categories[0] as $k => $v) {

			echo $k . " - ";

		};		
	};

	// -----------------------------------

?>

<html>

	<head>

		<title></title>

	</head>

	<body>

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

	</body>

</html>


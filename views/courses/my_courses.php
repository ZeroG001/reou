<?php
	require($_SERVER['DOCUMENT_ROOT'] . '/reou/controllers/courses_controller.php');
	$courses = my_courses($db);
?>

<html>

	<head>

		<title>My Courses</title>

	</head>

	<body>

		<link rel="stylesheet" type="text/css" href="../css/main.css">

		<h1> Show my courses </h1>

		<div class="courses wrap">

			<?php  foreach ($courses as $k => $course) { ?>
			
				<div class="courses__box">

					<a href='<?php echo course_route("course_detail", array("id" => $course['course_id'])) ?>'> 
						<?php echo $course['course_name'] ?> 
					</a>
				</div>

				<br />
				
			<?php } ?>

		</div>

	</body>

</html>


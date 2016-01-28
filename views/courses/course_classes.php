<?php
	require($_SERVER['DOCUMENT_ROOT'] . '/reou/controllers/courses_controller.php');
	$categories = course_classes($db);
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


					<a href='<?php echo course_route("course_detail", array("id" => $category['course_id'])) ?>'> 
						<?php echo $category['course_name'] ?> 
					</a>
				</div>

				<br />
				
			<?php } ?>

		</div>

	</body>

</html>


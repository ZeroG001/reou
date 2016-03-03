<?php
	require($_SERVER['DOCUMENT_ROOT'] . '/reou/controllers/courses_controller.php');
	$categories = course_classes($db);
	require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/views/layouts/header.php');
?>

<html>

	<head>

		<title></title>

	</head>

	<body>

		<link rel="stylesheet" type="text/css" href="../assets/css/main.css">

		<div class="page-banner">

			<div class="banner-title-wrapper">
				<h1> Course Title </h1>
				<p> This is a course description</p>
			</div>
			<div class="banner--footer">

			</div>
		</div>

		<div class="main-content">

			<div class="class-container">

				<?php foreach ($categories as $k => $category) { ?>

					<a class="class-container--box" href='<?php echo course_route('course_detail', ["id" => $category['course_id'] ]) ?>'>


						<div class="class-container--box-body">
							<h1> 
								<?php echo $category['course_name']; ?>
							</h1>
						</div>

						<div class="class-container--box-footer">

							<div class="box-footer--detail-box">
								<div class="detail-box-title"> Hours </div>
								<div class="detail-box-description"> <?php echo numExtract($category["course_duration_day"])?> </div>
							</div>


							<div class="box-footer--detail-box">
								<div class="detail-box-title"> Notes </div>
								<div class="detail-box-description"> V </div>
							</div>


							<div class="box-footer--detail-box">
								<div class="detail-box-title">Price</div>
								<div class="detail-box-description"><?php echo numExtract($category["course_cost_day"])?></div>
							</div>

						</div>

					</a>
					
				<?php } ?>

			</div>

		</div>


	</body>

</html>


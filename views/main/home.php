<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");

	require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/controllers/courses_controller.php');
	$categories = course_category($db);
	$categories = array_slice($categories, 2);

	//Header HTML

	
	# users helpers also included

	//$sign_in_page = "../../controllers/signin.php";
	// sign_in($db, $_POST);
?>

<html>

	<head>
		<title> Home </title>
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?php echo asset_route('css') ?>main.css">
	</head>



	<body>

		<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/views/layouts/header.php'); ?>

		<!-- It should center the text after a certain device width -->

		<section class="main__hero-container"> 

			<div class="main-content">

				<div class="main__header-container">

					<h1>  Join the REO Family. Become an Agent. </h1>
					<h3> Be the One. One with nature</h3>
					<a href="<?php echo user_route('sign-up') ?>" class="main__signup-button"> Sign up today </a>

				</div>

			</div>

		</section>



		<section class="home__subsection"> 

			<div class="section-wrap">

				<h2> Join the top ranked Real Estate Company in Michigan </h2>

				<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat </p>

			</div>

		</section>



		<section class="home__subsection"> 

			<div class="section-wrap">

				<h2> Choose from some of our great programs </h2>

				<div class="home__course-container">

					<!-- Show Course Categories -->
					<?php  foreach ($categories as $k => $category) { ?>
							<!-- background image refactor needed. Right now its just an inline style. -->
							<a class="home__course-container--box" href='<?php echo course_route("course_classes", array("id" => $category["category_id"]) ) ?>'
							style='background: linear-gradient( rgba(0, 0, 0, 0.05), rgba(0, 0, 0, 0.05) ), url( "<?php echo asset_route('dbimg') . $category['image_filename'] ?>" )'>

								<div class="home__course-container--box-header">
										<?php echo $category['category_name'] ?>
								</div>

								<div class="home__course-container--box-body">
									
								</div>

								<div class="home__course-container--box-footer"></div>
							</a>
					<?php } ?>

				</div>

			</div>

		</section>



		<section class="home__subsection icon-box"> 

			<div class="section-wrap">

			<div class="icon-text-block">
				<div class="icon-box-container">
					<img class="icon-text-block__image" src="http://placehold.it/66x68" width="66" height="68">
					<h2 class="icon-text-block__header"> Header 1 </h2>
					<p class="icon-text-block__para">sed do eiusmod tempor incididunt ut labore et dolore ma*gna aliqua. Ut enim a*d minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</p>
				</div>
			</div>


			<div class="icon-text-block">
				<div class="icon-box-container">
					<img class="icon-text-block__image" src="http://placehold.it/66x68" width="66" height="68">
					<h2 class="icon-text-block__header"> Header 2 </h2>
					<p class="icon-text-block__para">sed do eiusmod tempor incididunt ut labore et dolore ma*gna aliqua. Ut enim a*d minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</p>
				</div>
			</div>


			<div class="icon-text-block">
				<div class="icon-box-container">
					<img class="icon-text-block__image" src="http://placehold.it/66x68" width="66" height="68">
					<h2 class="icon-text-block__header"> Header 3 </h2>
					<p class="icon-text-block__para">sed do eiusmod tempor incididunt ut labore et dolore ma*gna aliqua. Ut enim a*d minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</p>
				</div>
			</div>



			</div>

		</section>


	</body>

</html>

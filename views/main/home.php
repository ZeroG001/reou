<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");
	# users helpers also included

	//$sign_in_page = "../../controllers/signin.php";
	// sign_in($db, $_POST);
?>

<html>

	<head>
		<title> Sign In </title>
		<link rel="stylesheet" type="text/css" href="<?php echo asset_route('css') ?>main.css">
	</head>



	<body>

		<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/views/layouts/header.php'); ?>

		<!-- It should center the text after a certain device width -->

		<section class="main__hero-container"> 

			<div class="main-content">

				<div class="main__header-container">

					<h1>  Join the REO Family. Become an Agent. </h1>
					<h3> Some random text. Hi Blayne, put an awesome slogan in here! Loreum ipsum.</h3>
					<a href="<?php echo user_route('sign-up') ?>" class="main__signup-button"> Sign up today </a>

				</div>

			</div>

		</section>

	</body>

</html>

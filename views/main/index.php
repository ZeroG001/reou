<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");
	# users helpers also included

	//$sign_in_page = "../../controllers/signin.php";
	sign_in($db, $_POST);
?>

<html>

	<head>

		<title> Sign In </title>

		<link rel="stylesheet" type="text/css" href="<?php echo asset_route('css') ?>main.css">

	</head>

	<body>

	<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/views/layouts/header.php'); ?>

	<section class="main__hero-container" > 

		<div class="main-content">

			<div class="main__header-container">
				<h1>  Example Title goes here </h1>

				<h3> Here is some lorem ipsum dolor sit amet, consectetur adipiscing elit. </h3>

				<a href="main__signup-button"> Sign up today </a>

			</div>

		</div>



	 <!-- It should have a header and subheader that to the left -->
	 <!-- It should have a button below the header -->
	 <!-- It should have a bright background color with a dark tint -->
	 <!-- It should  -->
	</section>




	</body>

</html>

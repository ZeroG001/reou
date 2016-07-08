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

		<div class="login-container"> 


			<!-- Left Side  -->
			<!-- ============== Login Form ==================== -->

			<form method="POST" action="" class="login__form">

				<h3> Log into the System! </h3>

				<!-- Alert Message  -->
				<div class="alert">
					<?php display_alert('alert') ?>
				</div>
				<!-- end -->


				<div class="login__email">
					<input type="text" name="email" class="login__email-input" placeholder="Email Address">
				</div>

				<div class="login__password">
					<input type="password" name="password" class="login__password-input" placeholder="Password">
				</div>

				<div class="login__submit">
					<input class="login__submit-button" type="submit" value="Log in">
				</div>


				<div class="login__signup">
					<a class="login__signup-link" href="<?php echo user_route('sign-up') ?>"> Sign-Up </a>
				</div>

			</form>


			<!-- Right Side  -->
			<div class="login__picture-container">

				<img class="random-box" src="<?php echo asset_route('site_img') . "green_pattern.png"?>" />
			
			</div>


		</div>



	</body>

</html>


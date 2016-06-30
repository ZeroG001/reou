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

		<div class="login-container"> 



			<!-- ============== Login Form ==================== -->

			<form method="POST" action="" class="login__form">

				<!-- Alert Message  -->
				<div class="alert">
					<?php display_alert('alert') ?>
				</div>
				<!-- end -->


				<div class="login__email">
					<input type="text" name="email" placeholder="email">
				</div>

				<div class="login__password">
					<input type="password" name="password" placeholder="password">
				</div>

				<div class="login__submit">
					<input type="submit" value="Log in">
				</div>


				<div class="">
					<a class="login__signup" href="<?php echo user_route('sign-up') ?>"> Sign-Up </a>
				</div>

			</form>

		</div>

	</body>

</html>


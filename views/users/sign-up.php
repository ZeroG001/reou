<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");

		sign_up($db, $_POST);

?>

<html>

	<head>
		<title> Sign Up </title>

		<link rel="stylesheet" type="text/css" href="<?php echo asset_route('css') ?>main.css">


	</head>

	<body>

	<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/views/layouts/header.php'); ?>


	<!--

	========== THE PLAN ============

	Down the line I plan on making this a popup that is triggered by a click
	event on the main page.

	-->

	<div class="signup-container"> 


		<div class="login__logo">
			<div class="login__logo-image"> </div>
		</div>


		<form method="POST" action="" class="signup__form">

			<h1> Sign up </h1>

			<?php display_alert('alert') ?>

			<div class="signup__firstName">
				<input type="text" name="firstName" class="signup__input" placeholder="First Name">
			</div>


			<div class="signup__lastName"> 
				<input type="text" name="lastName" class="signup__input" placeholder="Last Name">
			</div>


			<div class="signup__email">
				<input type="text" name="email" placeholder="Email" class="signup__input">
			</div>
			

			<div class="signup__password"> 
				<input type="password" name="password" class="signup__input" placeholder="Password" />
			</div>
			
			<div class="signup__submit">
				<input class="signup__submit-button" type="submit" value="Sign Up">
			</div>

		</form>


	</div>









	</body>

</html>
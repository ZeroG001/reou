<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");

		sign_up($db, $_POST);

?>

<html>

	<head>
		<title> Sign Up </title>
	</head>

	<body>

	<!--

	========== THE PLAN ============

	Down the line I plan on making this a popup that is triggered by a click
	event on the main page.

	-->
		<h1> Sign up </h1>

		<form method="POST" action="">

			<div class="alert">
				<?php display_alert('alert') ?>
			</div>

			<label for="firstName"> First Name </label>
			<input type="text" name="firstName">

			<label for="lastName"> Last Name </label>
			<input type="text" name="lastName">

			<label for="email"> Email Address </label> 
			<input type="text" name="email">

			<label for="password"> Password </label>
			<input type="password" name="password">


			<input type="submit" value="Sign Up">

		</form>

	</body>

</html>
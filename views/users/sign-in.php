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
	</head>

	<body>
		<form method="POST" action="" >

			<!-- Alert Message  -->
			<div class="alert">
				<?php display_alert('alert') ?>
			</div>

			<label for="email"> Emails </label>
			<input type="text" name="email">

			<label for="password"> Password </label>
			<input type="password" name="password">

			<input type="submit" value="Log in">

		</form>
	</body>

</html>


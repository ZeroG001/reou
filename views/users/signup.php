<?php
	$create_user_path = "../../controllers/signup.php";
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

		<form method="POST" action="<?php echo $create_user_path ?>">

			<!-- Full Name -->
			<!-- Password -->
			<!-- Eamil -->

			<label for="firstName"> First Name </label>
			<input type="text" name="firstName">

			<label for="lastName"> Last Name </label>
			<input type="text" name="lastName">

			<label for="email"> Email Address </label> 
			<input type="text" name="email">

			<label for="password"> Password </label>
			<input type="text" name="password">


			<input type="submit" value="Sign Up">

		</form>

	</body>

</html>
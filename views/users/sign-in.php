<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");
	$sign_in_page = "../../controllers/signin.php";

	if($_SERVER['REQUEST_METHOD'] == "POST") {
		sign_in($db, $_POST);
	} elseif(userSignedIn()) {
		header("location: ../courses/course_category.php");
		echo "move to the page they were just on";
	} 
?>

<html>

	<head>
		<title> Sign In </title>
	</head>

	<body>
		<form method="POST" action="" >

			<label for="email"> Email </label>
			<input type="text" name="email">

			<label for="password"> Password </label>
			<input type="password" name="password">

			<input type="submit" value="Log in">

		</form>
	</body>

</html>


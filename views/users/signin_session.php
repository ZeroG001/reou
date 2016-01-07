<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	// $sign_in_page = D_ROOT . "/reou/controllers/users/signin_session.php";

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		echo $_SERVER['HTTP_REFERER'];
	}
?>

<html>
<head>
	<title> Sign In </title>
</head>
<body>
	<form method="POST" action="#" >
		<input type="text" name="email">
		<input type="password" name="password">
		<input type="submit" value="Log in">
	</form>

</body>
</html>


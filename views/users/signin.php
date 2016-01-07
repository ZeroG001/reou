<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	$sign_in_page = "../../controllers/signin.php";
?>

<html>
<head>
	<title> Sign In </title>
</head>
<body>
	<form method="POST" action="<?php echo $sign_in_page ?>" >
		<input type="text" name="email">
		<input type="password" name="password">
		<input type="submit" value="Log in">
	</form>

</body>
</html>


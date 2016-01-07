<?php

if ( $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['email']) 
	&& isset($_POST['password'])) {

	require_once $_SERVER['DOCUMENT_ROOT'] . '/reou/includes/const.php';
	require_once(D_ROOT . "/reou/classes/database.php");

	function __autoload($class_name) {
		require_once("classes/". $class_name . '.php');
	}

	// -------- Load POST Variables -------- //
	$params = array();
	$params['email'] = $_POST['email'];
	$params['password'] = $_POST['password'];


	// -------- Attempt To Sign in -------- //
	$user = new User($db);
	$results = $user->sign_in($params); 

	// -------- Load Sesion Variables -------- //
	if($results) {
		session_start();
		foreach($results[0] as $k => $v) {
			$_SESSION[$k] = $v;

		}
	}

// ---------------- Debugging ------------------- //

session_destroy();
echo $_SESSION['first_name'];


	


}

// Get Post variables
// Clean post variables
// Run 
// Create Session
?>


<html>
<head>
	<title></title>
</head>
<body>
	<form method="POST" action="#">
		<input type="text" name="email">
		<input type="password" name="password">
		<input type="submit" value="Log in">
	</form>

</body>
</html>


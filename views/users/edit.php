<?php
	//Get the user info for the given session id
	// But up date.
	// If the user is an admin then get the user ID from the POST variables
	// Sure the results in an array. That way I can separate the results based on who's logged in
	
	// IF admin is logged in
		// Admin array with POST/GET
	// IF user is logged in
		// User Array with $_SESSION;
	
?>

<html>

	<head>
		<title>Edit Profile</title>
	</head>

<body>
	<form>
		<h2> Profile Info </h2>
		<label for="first_name"> First Name </label>
		<input type="text" id="first_name" name="first_name">

		<label for="last_name"> Last Name </label>
		<input type="text" id="last_name" name="last_name">

		<label for="phone"> Phone Number </label>
		<input type="text" id="phone" name="phone">

		<label for="email"> Email Address </label>
		<input type="email" id="email" name="email">
		
		<label for="password"> Password </label>
		<input type="password" name="password" id="password">


		<!-- Only Students -->
		<label for="licensed"> Lisenced? </label>
		<input type="checkbox" name="licensed" id="licensed">

		<label for="student_number"> Student Number </label> 
		<input type="text" name="student_number" id="student_number">

		<!-- Only Admins -->
		<label for="title"> Title </label>
		<input type="text" id="title" name="title" id="title">

		<input type="hidden" value="22"> <!-- This should only be in here for admins. Its the student ID -->
	</form>
</body>
</html>
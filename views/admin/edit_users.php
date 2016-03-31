<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");
	$users = show_users($db);
?>


<div class="container">



	<form class="update_user--form">

		<label for="firstName"> First Name </label>
		<input type="text" id="firstName" name="firstName">

		<label for="lastName"> Last Name </label>
		<input type="text" id="lastName">

		<!-- For this you need a way for the user to confirm their new email address. Dont make this site live until you can do that -->
		<label for="lastName"> Email Address(see comments) </label>
		<input type="text" id="email"> 


		<label for="lastName"> Change Password </label>
		<input type="text" name="password" />

		<label for="bio"> About Yourself </label>
		<textarea tid="bio" name="bio"> </textarea>

		<label for="profilePicture"> Profile Picture </label>
		<input type="file" name="profilePicture"> Upload File </input>


		<!-- ===== Possably for instructor info ===== -->

		<label for="lastName"> Phone Number </label>
		<input type="text" id="phone" />

		<!-- ===== Admin Functions ===== -->

		<label for="role"> Role </label>

		<select  id="role" name="role">
			<option value="admin"> Administrator </option>
			<option value="instructor"> Instructor </option>
			<option value="Student"> </option>
		</select>

		<label for="studentNumber"> Student Number </label>
		<input type="text" name="studentNumber" id="studentNumber" />

		<label for="active"> User Active </label>
		<input type="checkbox" name="active" id="active">

		<label> Date Created </label>
		<span> 12/20/2015 (filler text) </span>

		<label> Last Updated On </label>
		<span> 1/20/2016 (filler text) </span>


		<!-- use the hiddent field to tell which user needs to be updated -->
		<input type="hidden" id="userId" value="userIDfromPHP">

		<input type="submit"> Update User </input>
	</form>


</div>
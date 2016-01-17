<?php
	require($_SERVER['DOCUMENT_ROOT'] . '/reou/controllers/courses_controller.php');
	$categories = course_category($db);

	// ---------- Testing ---------------

	include("../../helpers/users_helper.php");

	if(userSignedIn()) {

		// Debug - Remove this
		var_dump($_SESSION);
		// debug remove this
		echo "Signed in? : Yes - Hello" . $_SESSION['first_name'];
	} else {
		echo "Signed In? : No";
	}

	// ----------------------------------
?>


	<link rel="stylesheet" type="text/css" href="../css/main.css">

	<div class="wrap">
	<?php  foreach ($categories as $k => $category) { ?>


		<div class="courses__box">
			<a href='course_classes.php?id=<?php echo $category['category_id'] ?>'> 
				<?php echo $category['category_name'] ?> 
			</a>
		</div>

		<br />
	<?php } ?>
	</div>

	<a href="../../users/sign-out.php"> Sign out </a> <br />
	<a href="../../users/sign-in.php"> Sign In </a>


</div>

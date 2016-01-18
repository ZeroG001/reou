<?php
	require($_SERVER['DOCUMENT_ROOT'] . '/reou/controllers/courses_controller.php');
	$categories = course_category($db);

	// ---------- Testing ---------------

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

				<a href='<?php echo course_route("course_classes", ["id" => $category["category_id"] ]) ?>'> 
					<?php echo $category['category_name'] ?> 
				</a>
				
			</div>

			<br />
		<?php } ?>
	</div>

	<a href="<?php echo user_route('sign-out') ?>"> Sign out </a> <br />
	<a href="<?php echo user_route('sign-in') ?>"> Sign In </a>


</div>

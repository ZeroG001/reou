<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	require_once(D_ROOT . "/reou/helpers/users_helper.php");
	require_once(D_ROOT . "/reou/helpers/courses_helper.php");


	if($_SERVER['REQUEST_METHOD'] == "POST") {
		

		if( userSignedIn() && userIsAdmin() ) {

			if( isset($_POST['keyword']) ) {


	
				require_once(D_ROOT . "/reou/controllers/courses_controller.php");

				$search_keyword = $_POST['keyword'];


				$user = new Course($db);
				$result = $user->search_courses($search_keyword);

				echo trim(json_encode($result));

			}

		}

	}

	
?>

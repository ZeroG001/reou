<?php
	// require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	// require_once(D_ROOT . "/reou/helpers/users_helper.php");


	if($_SERVER['REQUEST_METHOD'] == "POST") {
		

		if( userSignedIn() && userIsAdmin() ) {

			if( isset($_POST['keyword']) ) {


				require_once("../../includes/const.php");
				require_once(D_ROOT . "/reou/controllers/course_controller.php");

				$search_keyword = $_POST['keyword'];


				$user = new User($db);
				$result = $user->get_users_info('search_users', $search_keyword);

				echo trim(json_encode($result));

			}

		}

	}

	
?>

<?php
	
	// Perhaps use this down the line when you are releasing the app.;
	$absolute_path = "http://reoacademy.com/something";
	// Routes for th entire program


	// ===================== Users Routes =====================

	function user_route($route, $getVars = "") {

		// Takes the array you pass in and converts it into a query string
		if (is_array($getVars)) {
			//$querystring = "?".http_build_query($getVars);
			$querystring = $getVars['id'];
		} else {
			$querystring = $getVars;
		}

		switch ($route) {

			case 'edit':
				return "edit/".$querystring;
				break;

			case 'sign-in':
				return "sign-in.php/".$querystring;
				break;

			case 'sign-out':
				return "sign-out/".$querystring;
				break;

			case 'sign-up':
				return "sign-up/".$querystring;
				break;

			case 'my-courses':
				return "my-courses/".$querystring;
				break;
			
			default:
				return "course-category/".$querystring;
				break;

		}

	}


	// ===================== Courses Routes =====================

	function course_route($route, $getVars = "") {

		// Takes the array you pass in and converts it into a query string
		if (is_array($getVars)) {
			// $querystring = "?".http_build_query($getVars);
			$querystring = $getVars['id'];
		} else {
			$querystring = $getVars;
		}


		switch ($route) {

			case 'course_category':
				return "/reou/course-category/".$querystring;
				break;

			case 'course_classes':
				return "/reou/courses/".$querystring;
				break;

			case 'course_detail':
				return "/reou/course-detail/".$querystring;
				break;

			case 'course_register':
				return "/reou/course-register/".$querystring;
				break;
			
			default:
				return "/reou/course-category/".$querystring;
				break;

		}

	}







// --------------------------------------- Old Code ---------------------------------------

	// 		// Takes the array you pass in and converts it into a query string
	// 	if (is_array($getVars)) {
	// 		//$querystring = "?".http_build_query($getVars);
	// 		$querystring = $getVars['id'];
	// 	} else {
	// 		$querystring = $getVars;
	// 	}

	// 	switch ($route) {
	// 		case 'edit':
	// 			return "/reou/views/users/edit.php".$querystring;
	// 			break;

	// 		case 'sign-in':
	// 			return "/reou/views/users/sign-in.php".$querystring;
	// 			break;

	// 		case 'sign-out':
	// 			return "/reou/views/users/sign-out.php".$querystring;
	// 			break;

	// 		case 'sign-up':
	// 			return "/reou/views/users/sign-up.php".$querystring;
	// 			break;

	// 		case 'my-courses':
	// 			return "/reou/views/users/my-courses.php".$querystring;
	// 			break;
			
	// 		default:
	// 			return "/reou/views/courses/course_category.php".$querystring;
	// 			break;
	// 	}

	// }


	// // ===================== Courses Routes =====================

	// function course_route($route, $getVars = "") {

	// 	// Takes the array you pass in and converts it into a query string
	// 	if (is_array($getVars)) {
	// 		// $querystring = "?".http_build_query($getVars);
	// 		$querystring = $getVars['id'];
	// 	} else {
	// 		$querystring = $getVars;
	// 	}


	// 	switch ($route) {
	// 		case 'course_category':
	// 			return "/reou/views/courses/course-category.php".$querystring;
	// 			break;

	// 		case 'course_classes':
	// 			return "/reou/views/courses/course_classes.php".$querystring;
	// 			break;

	// 		case 'course_detail':
	// 			return "/reou/views/courses/course_detail.php".$querystring;
	// 			break;

	// 		case 'course_register':
	// 			return "/reou/views/courses/course_register.php".$querystring;
	// 			break;
			
	// 		default:
	// 			return "/reou/views/courses/course_category.php".$querystring;
	// 			break;
	// 	}
?>
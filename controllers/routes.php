<?php
	
	// ** ALL "PRETTY LINKS" are handled by the .htassess file. **

	// Perhaps use this down the line when you are releasing the app.;
	$absolute_path = "http://reoacademy.com/something";
	// Routes for th entire program



	// ===================== Home Routes =====================

	function main_route($route, $getVars = "") {

		// Takes the array you pass in and converts it into a query string
		if (is_array($getVars)) {
			//$querystring = "?".http_build_query($getVars);
			$querystring = $getVars['id'];
		} else {
			$querystring = $getVars;
		}

		switch ($route) {

			case 'home':
				// return something
				break;

			case 'about-us':
				// return something
				break;

			case 'success-stories':
				// return something
				break;

			case 'contact':
				// return something
				break;

			case '404':
				return "/reou/views/main/404.php";
				break;

			case '':
				// return something
				break;
			
			default:
				// return something
				break;

		}

	}




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
				return "/reou/edit-profile".$querystring;
				break;

			case 'sign-in':
				return "/reou/sign-in".$querystring;
				break;

			case 'sign-out':
				return "/reou/sign-out".$querystring;
				break;

			case 'sign-up':
				return "/reou/sign-up".$querystring;
				break;

			case 'my-courses':
				return "/reou/my-courses".$querystring;
				break;

			case 'show-users':
				return "/reou/admin/show-users";
				break;
			
			default:
				return "/reou/course-category".$querystring;
				break;

		}

	}




	// ===================== Courses Routes =====================

	function course_route($route, $getVars = "") {

		// Takes the array you pass in and converts it into a query string
		if (is_array($getVars)) {
			// $querystring = "?".http_build_query($getVars);
			$querystring = $getVars['id'];
		} 
		else {
			$querystring = $getVars;
		}


		switch ($route) {

			case 'home':
				return "/reou/course-category".$querystring;
				break;

			case 'course_category':
				return "/reou/course-category".$querystring;
				break;

			case 'course_classes':
				return "/reou/courses/".$querystring;
				break;

			case 'course_detail':
				return "/reou/course-detail/".$querystring;
				break;

			case 'course_register':
				return "/reou/course-register".$querystring;
				break;

			case 'course_search':
				return "/reou/course/search".$querystring;
				break;

			case 'admin':
				return "/reou/admin";
				break;

			case 'my_courses':
				return "/reou/my-courses".$querystring;
				break;

			case 'create_course':
				return "/reou/create-course".$querystring;
				break;

			case 'course_edit':
				return "/reou/course-edit".$querystring;
				break;

			case 'show_courses':
				return '/reou/admin/show-courses'.$querystring;
				break;
			
			default:
				return "/reou/course-category/".$querystring;
				break;


		}

	}




	// ===================== Asset Routes =====================

		function asset_route($route) {

		switch ($route) {

			case 'js':
				return "/reou/assets/js/";
				break;

			case 'css':
				return "/reou/assets/css/";
				break;

			case 'img':
				return "/reou/assets/img/";
				break;

			case 'site_img':
				return "/reou/assets/img/site_img/";
				break;

			case 'dbimg':
				return "/reou/assets/img/dbimg/";
				break;

			case 'classes':
				return "/reou/assets/classes/";
				break;
			
			default:
				return "/reou/course-category";
				break;

		}

	}




	// ===================== Admin Routes =====================

	function admin_route($route, $getVars = "") {

		// Takes the array you pass in and converts it into a query string
		if (is_array($getVars)) {
			//$querystring = "?".http_build_query($getVars);
			$querystring = $getVars['id'];
		} else {
			$querystring = $getVars;
		}

		switch ($route) {

			// case 'edit':
			// 	return "/reou/views/admin/edit_user.php" . $querystring;
			// 	break;

			case 'create-user':
				return "reou/admin/create-user";


			case 'show-users':
				return "/reou/admin/show-users";

			default:
				return "/reou/course-category" . $querystring;
				break;

		}

	}




	// ===================== Mailer Routes =====================

	function mailer_route($route) {

		switch ($route) {

			case 'password_reset_template':
			return "/";
			break;
			
			case 'email_reset_template';
			return "/";
			break;

		}



	}



	// ===================== Helper Routes =====================

	function helpers_route($route) {

		switch ($route) {

			case 'ajax_actions':
				return "/reou/helpers/ajax_actions/";
				break;
			
			default:
				return "/reou/course-category";
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
<?php 

require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
require_once(D_ROOT . "/reou/models/database.php");
// This is the corse class. Please do not erase it again

class User {

	protected static $flash_message = array(
			"alert" => array(),
			"error" => array(),
			"success" => array(),
			"notice" => array()
	);

	protected $user_info = array(
		"name" => "name",
		"email" => "email",
		"address" => "address"
	);

	// Class Dependencies
	protected $db;

	public function __construct(PDO $db) {
	 	$this->db = $db;
	}



	// Create USer Information
	// =====================================================

	public function create_user($params) {


	 	// Check if post variable names are acceptable
	 	$this->checkAcceptedParams($params);

	 	if(!$this->validateParams()) {
	 		die("This validation failed, check Users.php to fix");
	 	}

		// Clean Parameters
		$params = $this->sanitizeParams($params);
		$date_enetered = date('m/d/Y');


		// Check if user exists
		if ( $this->unique_user_exists($params['email']) ) {
			return false;
		}

		else {

			// ------------------- Run the INSERT QUERY -------------------
		 	$students_query = "INSERT INTO users 
		 	(first_name, last_name, email, password, date_created) 
		 	VALUES (:firstName, :lastName, :email, :password, :createdOn)";

		 	$stmt = $this->db->prepare($students_query);
		 	$stmt->bindParam(':firstName', $params['firstName'], PDO::PARAM_STR);
		 	$stmt->bindParam(':lastName', $params['lastName'], PDO::PARAM_STR);
		 	$stmt->bindParam(':email', $params['email'], PDO::PARAM_STR);
		 	$stmt->bindParam(':password', md5($params['password']), PDO::PARAM_STR);	
		 	$stmt->bindParam(':createdOn', $date_enetered, PDO::PARAM_STR);
		 	$stmt->execute();

		 	return true;
		}

	}




	// Get User Information
	// ============================================================


	 public function get_users_info() {

	 	// Things needed from user search
	 	/*
			- Give me a list of all users
			- Give me a list of a range of user
			- Give me a list of users from a specified search
	 	*/

		$query = array(
			"all_users" => "SELECT * FROM users",
			"range_of_users" => " SELECT * FROM users LIMIT 10 OFFSET ?",
			"search_users" => "SELECT * FROM users WHERE email LIKE %?%"
			);

			$stmt = $this->db->prepare($query["all_users"]);
			$stmt->execute();

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;

		}


		// Gets specific information of one user
		// Accepts an array, should be GET or POSt array.
		// ensures that the userId field is in there
		public function get_user_details($params) {

			// Make sure the params submitted are accepted

			$this->checkAcceptedParams($params);
			$params = $this->sanitizeParams($params);

			$cols = array(
					"id",
					"student_number",
					"first_name",
					"last_name",
					"address",
					"city",
					"state",
					"zip",
					"phone",
					"email",
					"licensed",
					"role",
					"bio",
					"active"
				);


			$cols = implode(", ", $cols);

			$query = "SELECT $cols FROM users WHERE id = :id";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(':id', $params['userId'], PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);

			return $result;
		}



	// Update User Profile Photo
	// ==========================================

	/**
	 * 
	 * @param (Array) The post params that are passed in. Should only be userId and file name
	 * @return (Array)
	 */
	public function updateProfilePicture($params) {

		$query = "UPDATE users SET profile_picture = ? WHERE userId = ?";

		$this->checkAcceptedParams($params);
		$this->sanitizeParams($params);

		$stmt = $this->db->prepare($query);
		$stmt->bindParam(1, $params['profilePicture']);
		$stmt->bindParam(2, $params['userId']);

		try {

			if ( $stmt->execute() ) {
				return true;
			} 
			else {
				return false;
			}
		} 
		catch (Exception $e) {
			echo "There was a problem uploading the profile picure";
			return false;
		}

	}


	public function getProfilePictureName($params) {

		$query = "SELECT profile_picture FROM users WHERE userID = ?";


		$this->checkAcceptedParams($params);
		$this->sanitizeParams($params);

		$stmt = $this->db->prepare($query);
		$stmt->bindParam(1, $params['userId']);

		try {
			if($stmt->execute()) {
				$result = $stmt->fetch(PDO::FETCH_ASSOC);
				return $result;
				
			} else  {
				return false;
			}
		} 
		catch (Exception $e) {
			echo "There was a problem getting the profile picture";

		}

	}





	 // Update User Info
	// ============================================================

	public function update_user($params) {

		// Make sure params are accepted
		$this->checkAcceptedParams($params);
		$params = $this->sanitizeParams($params);

		$query = "UPDATE users SET first_name = ?, last_name = ?, email = ?, bio = ?, role = ?, active = ? WHERE id = ?";
		$stmt = $this->db->prepare($query);

		$stmt->bindParam(1, $params['firstName']);
		$stmt->bindParam(2, $params['lastName']);
		$stmt->bindParam(3, $params['email']);
		$stmt->bindParam(4, $params['bio']);
		$stmt->bindParam(5, $params['role']);
		$stmt->bindParam(6, $params['active']);
		$stmt->bindParam(7, $params['userId']);

		// Try to execute the query
		try {
			$stmt->execute();
			return true;
		}
		catch (Exception $e) {
			echo $e->getMessage();
			return false;
		}
		

		//Automatically add the current date to the updated_at field
	}



	// ------------------------ Delete ------------------------

	public function delete_user() {
	// Not sure is im eveen going to code this one in. Udemy has it...so...
	}



	public function delete_class() {
	// Deletes a class (school) that a user is assigned to

	}



	// Other
	// ============================================================




	public function get_user_classes($student_id) {

		// I don't feel this is the most efficient query but it works;
		$query = "SELECT * FROM students_courses 
		INNER JOIN users on students_courses.student_id = users.id 
		INNER JOIN courses on students_courses.course_id = courses.course_id 
		INNER JOIN course_schedules on students_courses.schedule_id = course_schedules.schedule_id 
		WHERE students_courses.student_id = :student_id";

		$stmt = $this->db->prepare($query);

		$stmt->bindParam('student_id',$student_id ,PDO::PARAM_INT);

		try {

			$stmt->execute();

		} 
		catch (Exception $e) {
			die("There was a problem getting user classes. Please try again later");
		}

		$results = $stmt->fetch(PDO::FETCH_ASSOC);

		return $results;		
	}




	public function sign_in($params) {

		// Make sure params are accepted params
		$this->checkAcceptedParams($params);


		$cols = array(
			"id",
			"first_name",
			"last_name",
			"email",
			"licensed",
			"role",
			"active",
		);

		$cols = implode(", ", $cols);

		$query = "SELECT $cols 
		FROM  users
	 	WHERE email = :email and password = :password";


	 	$stmt = $this->db->prepare($query);
	 	$stmt->bindParam(':email', $params['email'], FILTER_SANITIZE_EMAIL);
	 	$stmt->bindParam(':password', md5($params['password']));

	 	try {
	 		$stmt->execute();


		 	if($stmt->rowCount() == 1) {
		 		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		 		return $result;
		 		
		 	} elseif ($stmt->rowCount() > 1) {
		 		echo $stmt->rowCount();
		 		die("Error in sign_in controller code. More than one of the same record found");
		 	} else {
		 		return false;
		 	}

	 	} 

	 	catch(Exception $e) {
	 		echo "There was a problem getting user information from database";
	 		echo $e->getMessage();
	 	}

	 	
	 	// ------- Return Result Or False if Nothing Comes up -------- //

	}


	/**
	 *	unique_user_exists
	 *
	 *	Check whether the user exists in the system. 
	 *
	 * @param (String) username (which is the email) that is to be checked.
	 * @return (Boolean) whether the user exists or not.
	 */
	 function unique_user_exists($username) {

	 	if(trim($username) == "") {
	 		die("email is invalid (make me a reutrn value or flash message)");
	 	}

	 	$query = "SELECT email FROM users
	 	WHERE email = :username";

	 	$stmt = $this->db->prepare($query);
	 	$stmt->bindParam(':username', $username, PDO::PARAM_STR);
	 	$stmt->execute();

	 	if($stmt->rowCount() > 1) {
	 		die("uh oh look like there are duplicate records in the database.");
	 	}

	 	if($stmt->rowCount() == 1) {
	 		return true;
	 	} else {
	 		return false;
	 	}
	 }


	/**
	 * scrubParams
	 *
	 * Takes each parameter and cleans it using rules set in function. Each parameter is clearn a certain way
	 *
	 * @param (Array) The Array containing $_POST params that are to be checked
	 * @return (Boolean)
	 */
	 public function sanitizeParams($params) {


	 	foreach ($params as $k => $param) {
	 		switch($k) {
	 			case "firstName" or "lastName" :
	 				$params[$k] = filter_var(trim($param), FILTER_SANITIZE_STRING);
	 			break;

	 			case "email":
	 				$params[$k] = filter_var(trim($param), FILTER_SANITIZE_EMAIL);
	 			break;

	 			case "studentNumber":
	 				$params[$k] = filter_var(trim($param), FILTER_SANITIZE_NUMBER_INT); 
	 			break;

	 			case "userId":
	 				$params[$k] = filter_var(trim($param), FILTER_SANITIZE_NUMBER_INT); 
	 			break;

	 			case "bio":
	 				$params[$k] = filter_var(trim($param), FILTER_SANITIZE_STRING);
	 			break;

	 			case "profilePicture":
	 				$params[$k] = filter_var( trim($param),
	 				FILTER_SANITIZE_STRING );
	 			break;

	 			default:
	 				$params[$k] = $params[$k];
	 			break;
	 		}
	 	}

	 	return $params;
	 }

	public function convert_camel_case($string) {
		$pattern ="/([a-z])([A-Z])/";
		$replacement = "$1" . "_" . "$2";
		$string = preg_replace($pattern, $replacement, $string);
		$string = strtolower($string);
		return $string;
	}




	/*
	 * add_message();
	 *
	 * Add a message to the flash_alert array
	 *
	 * @type (String) $message set the message type as "Alert", "Notice", "Success", or "Error"
	 * @return (boolean)
	 */
	public static function add_message($type, $message) {
		$acceptable_message_types = array("alert","notice","success","error");
		if(!in_array(strtolower($type), $acceptable_message_types) && is_string($type)) {
			throw new Exception("The function accepts types of alert, notice, success, and error", 1);
		}
		array_push(User::$flash_message[$type], $message);
	}


	/*
	 * validateParams();
	 *
	 * Ensures that the parameters sent are valid
	 *
	 * @type (String) $message set the message type as "Alert", "Notice", "Success", or "Error"
	 * @return (boolean)
	 */
	public function validateParams($params) {

	 	$paramsValid = true;


	 	foreach ($params as $k => $param) {
	 		switch($k) {
	 			case "firstName" :
	 				$params[$k] = filter_var(trim($param), FILTER_SANITIZE_STRING);
	 				add_message("alert", "First Name invalid");
	 				$paramsValid = false;
	 			break;

	 			case "lastName" :
	 				$params[$k] = filter_var(trim($param), FILTER_SANITIZE_STRING);
	 				add_message("alert", "First Name invalid");
	 				$paramsValid = false;
	 			break;

	 			case "email":
	 				$params[$k] = filter_var(trim($param), FILTER_VALIDATE_EMAIL);
	 				add_message("alert", "First Name invalid");
	 				$paramsValid = false;
	 			break;

	 			case "studentNumber":
	 				$params[$k] = filter_var(trim($param), FILTER_SANITIZE_NUMBER_INT);
	 				add_message("alert", "Student Number Invalid");
	 				$paramsValid = false;
	 			break;

	 			default:
	 				$params[$k] = $params[$k];
	 			break;
	 		}
	 	}

	 	if($paramsValid) {
	 		return true;
	 	} else {
	 		return false;
	 	}

	}





	/*
	 * checkAcceptedParams
	 *
	 * Checks to see if the POST parameters are on a lit of parameters that are acccepted. The Script will stop if the parameters are bad.
	 * the params HAVE to the the camel case
	 *
	 * @param (Array) The Array containing $_POST params that are to be checked
	 * @return (Boolean)
	 */
	public function checkAcceptedParams($params) {
		$accepted_params = array("firstName",
		 "lastName",
		 "email",
		 "password",
		 "userId",
		 "dateCreated",
		 "lisenced",
		 "phone",
		 "profilePicture",
		 "role",
		 "state",
		 "active",
		 "studentNumber",
		 "createdAt",
		 "zip",
		 "bio"
			);

		foreach ($params as $param => $value) {
		 	if( !in_array($param, $accepted_params) ) {
		 		die("Form Field " . $param . "is not acceptable.");	
		 		return false;
		 	}
		}

		return true;
	}


} // Class End


// ----------------------- Testing Area ----------------------- //

	// $blayne = new User($db);

	// $arr = array("firstName" => "test", "lastName" => "<h1>tester</h1>", "email" => "blayne@hotmail.com", "password" => "12345");
	// $blayne->create_user($arr);

// -------------------------------------------------------------- //
?>

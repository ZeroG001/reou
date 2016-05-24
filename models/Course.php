<?php 

require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
require_once(D_ROOT . "/reou/models/database.php");
// This is the corse class. Please do not erase it again

class Course {

	public static $message = array(
		"alert" => "",
		"error" => "",
		"success" => "",
		"notice" => ""
	);

	// Class Dependencies
	 public $db;
	 public function __construct(PDO $db) {
	 	$this->db = $db;
	 }



	 // -------- Get Corse Information -------- //

	 public function get_course_category() {

	 	$query = "SELECT * FROM course_category";
	 	$stmt = $this->db->prepare($query);
	 	$stmt->execute();
	 	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	 	return $result;
	 }

	 public function get_one_course_category($course_id) {
	 	$query = "SELECT * FROM course_category WHERE category_id = ? LIMIT 1";
	 	$stmt = $this->db->prepare($query);
	 	$stmt->bindParam(1, $course_id, PDO::PARAM_INT);
	 	$stmt->execute();
	 	$result = $stmt->fetch(PDO::FETCH_ASSOC);

	 	return $result;
	 }



	 public function get_course_classes($course_id) {
	 	$cols = array(
	 		"course_id",
			"course_name",
			"course_number",
			"course_duration_day",
			"course_duration_evening",
			"course_location",
			"course_hours_day",
			"course_credits",
			"course_cost_day",
			"course_cost_evening",
			"course_hours_evening",
			"course_duration_day",
			"course_notes"
	 	);

	 	$cols = implode(", ", $cols);
	
	 	$query = "SELECT $cols FROM courses c 
	 	INNER JOIN course_category cc 
	 	ON c.category_id=cc.category_id
	 	WHERE c.category_id = ? AND active = 1";
	 	$stmt = $this->db->prepare($query);
	 	$stmt->bindParam(1, $course_id);
	 	$stmt->execute();
	 	$result_array = $stmt->fetchAll(PDO::FETCH_ASSOC);

	 	return $result_array;
	 }


	 public function get_class_details($class_id) {

	 	$query = "SELECT * FROM courses WHERE course_id = ? LIMIT 1";

	 	$stmt = $this->db->prepare($query);
	 	$stmt->bindParam(1, $class_id);

	 	try {
	 		$stmt->execute();
	 	} 
	 	catch (Exception $e) {
	 		echo "There was a problem getting the class details";
	 	}
	 	
	 	$results = $stmt->fetch(PDO::FETCH_ASSOC);

	 	return $results;

	 }



	 public function get_course_schedule($course_id) {
	 	$cols = array(
	 		"location",
	 		"staff_id",
	 		"class_date",
	 		"active",
	 		"class_begin_time",
	 		"class_end_time",
	 		"course_id",
	 		"course_number",
	 		"course_name",
	 		"course_desc",
	 	);

	 	$query = "SELECT * FROM course_schedules cs 
		INNER JOIN courses c 
		ON cs.course_id=c.course_id 
		WHERE cs.course_id = ?";

		$stmt = $this->db->prepare($query);
		$stmt->bindParam(1, $course_id);
		$stmt->execute();

		$resutls = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $resutls;
	 }



	 
	// ---------- edit courses ---------- //

	 public function register_course($params) {

	 	// Check if the Params are in the accepted params List
		foreach ($params as $param => $value) {
		 	if(!in_array($param, $this->accepted_params())) {
		 		die("Form Field " . $param . " is not accepted");	
		 	}
		}

		// If the User is already registered fot class
		if($this->userRegisteredforClass($params['student_id'], $params['course_id'], $params['schedule_id'])) {
			die("You are already registered for this class (make a popup?)");
		}


	 	$query = "INSERT INTO students_courses (student_id, course_id, schedule_id) 
	 	VALUES (:student_id, :course_id, :schedule_id)";

	 	$stmt = $this->db->prepare($query);
		$stmt->bindParam(':student_id', $params['student_id'], PDO::PARAM_INT);
		$stmt->bindParam(':course_id', $params['course_id'], PDO::PARAM_INT);
		$stmt->bindParam(':schedule_id', $params['schedule_id'], PDO::PARAM_INT);

		try {

			$stmt->execute();

		} catch (Exception $e) {

			echo "There was a problem registering for the course";
			echo $e->getMessage();
		}
	 }




	 // ------------- Show all classes a student is registered for ----------------------
	 public function get_registered_courses($student_id) {

	 	$query = "SELECT DISTINCT(course_name), sc.course_id from reou.courses c INNER JOIN students_courses sc ON c.course_id = sc.course_id WHERE sc.student_id = ?";

	 	$stmt = $this->db->prepare($query);
	 	$stmt->bindParam(1, $student_id);
	 	$stmt->execute();

	 	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	 	return $results;

	 }




	 // Check to see if a user is already registered for a class
	 public function userRegisteredforClass($student_id, $course_id, $schedule_id) {

	 	$query = "SELECT * FROM students_courses 
	 	WHERE student_id = :student_id
	 	AND course_id = :course_id
	 	AND schedule_id = :schedule_id LIMIT 1";

	 	$stmt = $this->db->prepare($query);
	 	$stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
		$stmt->bindParam(':course_id', $course_id, PDO::PARAM_INT);
		$stmt->bindParam(':schedule_id', $schedule_id, PDO::PARAM_INT);

		$stmt->execute();

		if($stmt->rowCount() > 0) {
			return true;
		} else {
			return false;
		}

	 }




	 public function edit_course() {}




	 public function edit_course_category() {}


	 // ---------- remove courses (admin) ---------- //

	 function create_course($params) {

	 	//Scrub the Params. Verify, Filter and Sanitize.

	 	if(!$this->checkAcceptedParams($params)) {
	 		die("those params aren't acceptable");
	 	}


	 	if(!$this->validateParams($params)) {
	 		return false;
	 	};


	 	// Build Params
	 	$columnNames = array();
	 	$columnValues = array();

	 	foreach( $params as $key => $value ) {
	 		array_push($columnNames, convert_camel_case($key));
	 		array_push($columnValues, ":".$key);
	 	}

	 	$nameString = implode(",", $columnNames);
	 	$valueString = implode("," , $columnValues);

		$query = "INSERT INTO courses (".$nameString.") VALUES (".$valueString.") ";


		try {

			$stmt = $this->db->prepare($query);

		 	$stmt->bindParam(':courseName', $params['courseName']);
		 	$stmt->bindParam(':courseDesc', $params['courseDesc']);
		 	$stmt->bindParam(':courseNumber', $params['courseNumber']);
		 	$stmt->bindParam(':courseCost', $params['courseCost']);
		 	$stmt->bindParam(':courseLocation', $params['courseLocation']);
		 	$stmt->bindParam(':courseCredits', $params['courseCredits']);
		 	$stmt->bindParam(':courseNotes', $params['courseNotes']);
		 	$stmt->bindParam(':instructorId', $params['instructorId']);
		 	$stmt->bindParam(':minClassSize', $params['minClassSize']);
		 	$stmt->bindParam(':maxClassSize', $params['maxClassSize']);
		 	$stmt->bindParam(':courseHours', $params['courseHours']);
		 	$stmt->bindParam(':courseDuration', $params['courseDuration']);
		 	$stmt->bindParam(':active', $params['active']);
		 	
		 	$stmt->execute();

		 	return true;

		} 
		catch (Excaption $e) {

			return false;

		}

	 }

	// ---------- remove courses (admin) ---------- //


	// Remove a course
	public function remove_course() {
		$query = "DELETE FROM courses WHERE course_id = ?";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(1, $course_id);
	}


	// Remove Course category
	public function remove_course_category() {
	 	$quert = "DELETE FROM courses_category WHERE course_id = ?";
	 	$stmt = $this->db->prepare($query);
	}




	/**
	 * checkAcceptedParams
	 *
	 * Checks to see if the POST parameters are on a lit of parameters that are acccepted. The Script will stop if the parameters are bad.
	 * the params HAVE to the the camel case
	 *
	 * @param (Array) The Array containing $_POST params that are to be checked
	 * @return (Boolean)
	 */
	public function checkAcceptedParams($params) {
		$accepted_params = array(
	 		"courseName",
	 		"courseDesc",
	 		"courseNumber",
	 		"courseCost",
	 		"courseLocation",
	 		"courseCredits",
	 		"courseNotes",
	 		"instructorId",
	 		"minClassSize",
	 		"maxClassSize",
	 		"courseHours",
	 		"courseDuration",
	 		"active"
	 	);


		foreach ($params as $param => $value) {
		 	if( !in_array($param, $accepted_params) ) {
		 		die("Form Field " . $param . "is not acceptable.");	
		 		return false;
		 	}
		}

		return true;
	}




	/**
	 * validateParams();
	 *
	 * Ensures that the parameters sent are valid
	 *
	 * @param(String) $message set the message type as "Alert", "Notice", "Success", or "Error"
	 * @return (boolean)
	 */
	public function validateParams($params, $display_errors = true) {

	 	$paramsValid = true;
	 	$error_messages = array(); // array("type" => "alert", "message" => "First name is invalid");

	 	// List of required params
	 	$required_vars = array("courseName", "courseNumber", "courseCost", "courseLocation");

	 	foreach ($required_vars as $key => $value) {
	 		if(empty($params[$value]) || is_null($params[$value])) {
	 			array_push($error_messages, array("type" => "alert", "message" => $this->convert_camel_case_space($value) . " is required" ));
	 			$paramsValid = false;
	 		}

	 	}

	 	foreach ($params as $k => $param) {

	 		switch($k) {


	 			case "courseName" :

	 				if(!filter_var(trim($param), FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/[\w]{2,50}/")))) {
	 					array_push($error_messages, array("type" => "alert", "message" => "The Course name is invalid"));
	 					$paramsValid = false;
	 				}

	 			break;


	 			default:
	 				$params[$k] = $params[$k];
	 			break;
	 		}
	 	}

	 	//If display error is on then the error will show
	 	if($display_errors) {
	 		foreach ($error_messages as $k => $error_message) {
	 		$this->add_message($error_message['type'], $error_message['message']);
	 		}	
	 	}

	 	if($paramsValid) {
	 		return true;
	 	} 
	 	else {
	 		return false;
	 	}

	}




	/**
	 * add_message();
	 *
	 * Add a message to the $_SESSION['flash_message'] array
	 *
	 * @param (String) $message set the message type as "Alert", "Notice", "Success", or "Error"
	 * @return (boolean)
	 */
	public static function add_message($type, $message) {
		$acceptable_message_types = array("alert","notice","success","error");


		// For my sake, check to make sure I put in the right session type.
		if(!in_array(strtolower($type), $acceptable_message_types) && is_string($type)) {
			throw new Exception("The function accepts types of alert, notice, success, and error", 1);
		}	

		if (session_status() == PHP_SESSION_ACTIVE) {

			if(!isset($_SESSION['flash_message'])) {
				$_SESSION['flash_message'] = array();


				if(!isset($_SESSION['flash_message'][$type]) ) {
					$_SESSION['flash_message'][$type] = array();
				}
			}

			// add messages to the flash message array
			array_push($_SESSION['flash_message'][$type], $message);

		} else {
			die(" To add a , you must be logged in.");
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




	/**
	 * convert_camel_case
	 *
	 * the param key are in camel case format. This coverts said string to this_type_of_format.
	 * 
	 *
	 * @param (Array) The Array containing $_POST params that are to be checked
	 * @return (Boolean)
	 */
	public function convert_camel_case($string) {
		$pattern ="/([a-z])([A-Z])/";
		$replacement = "$1" . "_" . "$2";
		$string = preg_replace($pattern, $replacement, $string);
		$string = strtolower($string);
		return $string;
	}

	public function convert_camel_case_space($string) {
		$pattern ="/([a-z])([A-Z])/";
		$replacement = "$1" . " " . "$2";
		$string = preg_replace($pattern, $replacement, $string);
		$string = ucwords($string);
		return $string;
	}
	
}// end object

?>

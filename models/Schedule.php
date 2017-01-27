<?php 

require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
require_once(D_ROOT . "/reou/models/database.php");
// This is the corse class. Please do not erase it again

class Schedule {

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




	 // -------- Get Schedule Information -------- //




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

	 	try {

	 		$stmt = $this->db->prepare($query);
	 		$stmt->bindParam(1, $course_id);
	 		$stmt->execute();
	 		$result_array = $stmt->fetchAll(PDO::FETCH_ASSOC);

	 		return $result_array;

	 	} 
	 	catch (Exception $e) {

	 		// Flash message saying there wasy a porblem with the data
	 		$this->add_message("alert", "There was a problem getting the course classes");

	 		// Return empty array to surpress any other errors
	 		return array();
	 		
	 	}

	}




	 // Get the information for one class.
	public function get_class_details($class_id) {

	 	$query = "SELECT * FROM courses WHERE course_id = :id LIMIT 1";

	 	$stmt = $this->db->prepare($query);
	 	$stmt->bindParam(':id', $class_id);

	 	try {

	 		$stmt->execute();
	 		$results = $stmt->fetch(PDO::FETCH_ASSOC);
	 		return $results;

	 	} 

	 	catch (Exception $e) {

	 		die("There was a peoblem getting the class details, this should not be a die message");
	 		$this->add_message("alert", "There was a porblem getting the class details");

	 		// Return an empty array to surpress info
	 		return array();


	 	}
	 	
	}



	// Gets all course schedules based on the course_id you pass in;
	public function get_course_schedule($course_id) {
	 	$cols = array(
	 		"schedule_id",
	 		"course_id",
	 		"staff_id",
	 		"location",
	 		"class_date",
	 		"active",
	 		"class_begin_date",
	 		"class_end_date",
	 		"class_begin_time",
	 		"class_end_time",
	 		"course_id",
	 		"days_available",
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
	 	$this->checkAcceptedParams($params);

		// If the User is already registered fot class
		if($this->userRegisteredforClass($params['student_id'], $params['course_id'], $params['schedule_id'])) {
			die("You are already registered for this class (make a popup?)");
		}

		//TODO - Make sure user has paid for the class for signing them up.

		// Sign User up for class
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




	// ------------- Show Schedule Information ----------------------
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




	// ---------- Create Courses (admin) ----------
	public function create_course($params) {

	 	//Scrub the Params. Verify, Filter and Sanitize.
	 	if(!$this->checkAcceptedParams($params)) {
	 		die("those params aren't acceptable");
	 	}


	 	// Validate Params Before Sending
	 	if(!$this->validateCourseParams($params)) {
	 		return false;
	 	};

	 	// Build the query
		$query = $this->build_insert_query("courses", $params);

		// To to execute the query
		try {

			$stmt = $this->db->prepare($query);

			// bind params using parameters submitted.
			foreach ($params as $key => $value) {
				$stmt->bindParam(':'.$key, $params[$key]);
			}
		 	
		 	$stmt->execute();

		 	return true;

		} 
		catch (Excaption $e) {

			$error_message = $e->getMessage();
			return false;

		}

	}



	
	public function create_course_schedule($params) {


	 	//Scrub the Params. Verify, Filter and Sanitize.
	 	if(!$this->checkAcceptedParams($params)) {
	 		die("those params aren't acceptable");
	 	}

	 	// Validate Params Before Sending
	 	if(!$this->validateScheduleParams($params)) {
	 		return false;
	 	};

	 	// Make sure that the date given isn't before 
	 	//convert time parameter before sending
	 	var_dump($params);
	 	$params['classBeginDate'] = $this->convertPhpToMysqlDate($params['classBeginDate']);
	 	$params['classEndDate'] = $this->convertPhpToMysqlDate($params['classEndDate']);


	 	//Verify Start Time does not come after end time
	 	if(!$this->verifyTimeOrder( $params['classBeginDate'], $params['classEndDate'] ) ) {
	 		$this->add_message("alert", "Start date occurs after end date");
	 		return false;
	 	}
	 	
	 	// Build the query
		$query = $this->build_insert_query("course_schedules", $params);

		// To to execute the query
		try {

			$stmt = $this->db->prepare($query);

			// bind params using parameters submitted.
			foreach ($params as $key => $value) {
				$stmt->bindParam(':'.$key, $params[$key]);
			}
		 	
		 	$stmt->execute();

		 	return true;
		} 
		catch (Excaption $e) {

			$error_message = $e->getMessage();
			return false;

		}

		// In case all else fails
		return false;
		
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
	 * Checks to see if the POST parameters are on a lit of parameters that are acccepted. Script stops if the parameters are bad.
	 * the params HAVE to the the camel case
	 *
	 * @param (Array) The Array containing $_POST params that are to be checked
	 * @return (Boolean)
	 */
	public function checkAcceptedParams($params) {
		$accepted_params = array(
	 		"courseName",
	 		"courseDesc",
	 		"courseId",
	 		"courseNumber",
	 		"courseCost",
	 		"categoryId",
	 		"scheduleId",
	 		"daysAvailable",
	 		"location",
	 		"classBeginDate",
	 		"classEndDate",
	 		"courseLocation",
	 		"courseCredits",
	 		"courseNotes",
	 		"instructorId",
	 		"minClassSize",
	 		"maxClassSize",
	 		"courseHours",
	 		"courseDuration",
	 		"active",
	 		"course_id",
	 		"student_id",
	 		"schedule_id"
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
	 * validateCourseParams();
	 *
	 * Ensures that the parameters sent are valid
	 *
	 * @param(String) $message set the message type as "Alert", "Notice", "Success", or "Error"
	 * @return (boolean)
	 */
	public function validateCourseParams($params, $display_errors = true) {

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


	 			// case "courseName" :

	 			// 	if(!filter_var(trim($param), FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/[\w]{2,50}/")))) {
	 			// 		array_push($error_messages, array("type" => "alert", "message" => "The Course name is invalid"));
	 			// 		$paramsValid = false;
	 			// 	}
	 			// break;


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

	 	// Returns True or False;
	 	return $paramsValid;

	}



	/**
	 * validateScheduleParams();
	 *
	 * Ensures that the parameters sent are valid
	 *
	 * @param(String) $message set the message type as "Alert", "Notice", "Success", or "Error"
	 * @return (boolean)
	 */
	public function validateScheduleParams($params, $display_errors = true) {

	 	$paramsValid = true;
	 	$error_messages = array(); // array("type" => "alert", "message" => "First name is invalid");

	 	// Required Parameters
	 	$required_vars = array (
	 		"courseId", 
	 		"classBeginDate", 
	 		"classEndDate",
	 		"daysAvailable"
	 	);

	 	foreach ($required_vars as $key => $value) {
	 		if(empty($params[$value]) || is_null($params[$value])) {
	 			array_push($error_messages, array("type" => "alert", "message" => $this->convert_camel_case_space($value) . " is required" ));
	 			$paramsValid = false;
	 		}

	 	}



	 	// Check Fromatting of Params
	 	foreach ($params as $k => $param) {

	 		switch($k) {


	 			case "classBeginDate" :

	 				if(!filter_var(trim($param), FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/\d{1,2}\/\d{1,2}\/\d{4}/")))) {
	 					array_push($error_messages, array("type" => "alert", "message" => "Begin Date Format Incorrect"));
	 					$paramsValid = false;
	 				}
	 			break;


	 			case "classEndDate" :

	 				if(!filter_var(trim($param), FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/\d{1,2}\/\d{1,2}\/\d{4}/")))) {
	 					array_push($error_messages, array("type" => "alert", "message" => "End Date Format Incorrect"));
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

	 	// Returns True or False;
	 	return $paramsValid;

	}




	 /* add_message();
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


						// It should show the message even when a user isn't logged in

			// 1. Create a session
			// 2. Show the message
			// 3. If the user isn't logged in then unset() that session
			// 4. return false is the session is null

			// For flash messages, if you aren't loggeed in then show tthe message and clear the session
			// die("to add a messgae, you must be logged in. this needs to change");

		} else {
			die("session message was not able to show, make it so that something useful happens when the flash message does not show up");
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
	public function update_user($params) {

		// Make sure params are accepted
		$this->checkAcceptedParams($params);
		$params = $this->sanitizeParams($params);

		// Validates the params
		if(!$this->validateParams($params)) {
			header("Location:". $_SERVER['HTTP_REFERER']); 
			die();
		}

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
		

		// Todo. Automatically update the 'updatedAt' field in the database.
	}

	public function update_course($params) {

		// Make sure params are accepted
		$this->checkAcceptedParams($params);
		$params = $this->sanitizeParams($params);

		// Validates the params
		if(!$this->validateParams($params)) {
			header("Location:". $_SERVER['HTTP_REFERER']); 
			die();
		}

		// Execute update quesy;
		$query = "UPDATE course SET username = ?, password = ?, email = ?";
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



	/** 
	* @return (String) the insert query in all its
	*/
	public function build_insert_query($table, $params) {

		//This insert query uses PDO style params


		// Make sure that the date given isn't before today


		// Make sure the begin date is before the end date

	 	// Build Dynamic Insert Query
	 	$columnNames = array();
	 	$columnValues = array();

	 	foreach( $params as $key => $value ) {
	 		array_push($columnNames, convert_camel_case($key));
	 		array_push($columnValues, ":".$key);
	 	}

	 	$nameString = implode(",", $columnNames);
	 	$valueString = implode("," , $columnValues);

	 	$query = "INSERT INTO $table (".$nameString.") VALUES (".$valueString.") ";

	 	return $query;

	}




	/**
	 * verifyTimeOrder
	 *
	 * Verifies that the start time does not occur after the end time second time give
	 *  
	 * @param (String) Date in the m/d/Y format 
	 * @param (String) Date in the m/d/Y format 
	 *
	 * @return (boolean)
	 */
	public function verifyTimeOrder($startDate, $endDate) {

		$startTimeStamp = strtotime($startDate);
		$endTimeStamp = strtotime($endDate);

		if($startTimeStamp > $endTimeStamp) {

			return false;

		} else {

			return true;
		}

		
	}




	/**
	 * Convert MySql to PHP date
	 *
	 * Converts 2015-12-01 00:00:00 to 12/1/2015
	 *  
	 *
	 * @param (String) Date String in Y-m-d
	 *
	 *
	 */
	public function convertMysqlToPhpDate($date) {

		// Make sure that the date given isn't before today

		// if ( date provided is less than today's date ) {
		//	return false
		// }
		

		// Make sure the begin date is before the end date


		// Date Format Taken "2015-12-01 00:00:00";
		if( preg_match('/\d{4}\-\d{2}\-\d{2}\s\d{2}:\d{2}:\d{2}/', $date) ) {
			
			$mysqltimestamp = strtotime($date);
			$phpDate = date("m/d/Y", $mysqltimestamp);
			
			return $phpDate;
			
		} else {

			return false;

		}
		
	}




	/**
	 * Convert PHP to MySql Date
	 *
	 * Converts 12/1/2015 to 2015-12-01 00:00:00
	 *  
	 * @param (String) Date in the m/d/Y format 
	 *
	 */
	public function convertPhpToMysqlDate($date) {
		
		// Ensure that the date given is the correct format
		
		if ( preg_match('/\d{1,2}\/\d{1,2}\/\d{4}/', $date) ) {

			$phptimestamp = strtotime($date);
			$sqlDate = date("Y-m-d H:i:s", $phptimestamp);
			
			return $sqlDate;
			
		} else {
			
			return false;
			
		}
		
	}



	
}// end object

?>
                                                                                                                                                                                                                                                                                                                                                                   
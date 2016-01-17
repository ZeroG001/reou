<?php 

require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
require_once(D_ROOT . "/reou/models/database.php");
// This is the corse class. Please do not erase it again

class User {

	public $user_info = array(
		"name" => "name",
		"email" => "email",
		"address" => "address"
	);

	// Class Dependencies
	public $db;
	public function __construct(PDO $db) {
	 	$this->db = $db;
	}


	public function sign_in($params) {

		// Make sure params are accepted params
		foreach ($params as $param => $value) {
		 	if(!in_array($param, $this->accepted_params())) {
		 		die("Form Field " . $param . " is not accepted");	
		 	}
		}


		$cols = [
			"id",
			"first_name",
			"last_name",
			"email",
			"licensed",
			"type",
			"active",
			"title"
		];

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
		 		die("Username or password invalid - make me a pop up message");
		 	}

	 	} 

	 	catch(Exception $e) {
	 		echo "There was a problem getting user information from database";
	 		echo $e->getMessage();
	 	}

	 	
	 	// ------- Return Result Or False if Nothing Comes up -------- //


	}

	public function create_user($params) {
	 	// Accepts POST array items or an array you create.

	 	/* 
	 	$params = [
	 		"firstName" => "John", 
	 		"lastName" => "Doe", 
	 		"email" => "test@hotmail.com",
	 		"password" => "secret" (as hash)
	 	]
	 	*/

		foreach ($params as $param => $value) {

		 	if(!in_array($param, $this->accepted_params())) {
		 		die("Form Field " . $param . " is not accepted");	
		 	}

		}

		$params['password'] = md5(trim($params['password']));

		$params['firstName'] = filter_var(trim($params['firstName']), FILTER_SANITIZE_STRING);
		$params['lastName'] = filter_var(trim($params['lastName']), FILTER_SANITIZE_STRING);
		$params['email'] = filter_var(trim($params['email']), FILTER_SANITIZE_EMAIL);

		$date_enetered = date('m/d/Y');

		if ( $this->unique_user_exists($params['email']) ) {
			die("this user already exisis");
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
		 	$stmt->bindParam(':password', $params['password'], PDO::PARAM_STR);	
		 	$stmt->bindParam(':createdOn', $date_enetered, PDO::PARAM_STR);
		 	$stmt->execute();

		 	echo "updated";
		}


	 }

	 function unique_user_exists($username) {
	 	// String - Username to check for 'johndoe@hotmail.com'
	 	// Check the the Student security table to see if that record exists. Alerts if there are dupes
	 	//Well does the user exist? return true of false.
	 	// For the die() statement. make it so that some soft of popup shows up.
	 	// If the User

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

	 // -------- Get User Information -------- //

	 public function get_user_details($id) {

	 	$cols = [
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
	 		"type",
	 		"bio",
	 		"active",
	 		"title"
	 	];

	 	$cols = implode(", ", $cols);

	 	$query = "SELECT $cols FROM users WHERE id = :id";
	 	$stmt = $this->db->prepare($query);
	 	$stmt->bingParam(':id', $id, PDO::PARAM_INT);
	 	$stmt->execute();
	 	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	 	return $result;
	 }


	
	public function class_signup($student_id, $course_id, $schedule_id) {

		$query = "INSERT INTO courses_classes (id) VALUES (:student_id, :course_id, :schedule_id)";

		$stmt = $this->db->prepare($query);
		$stmt->bindParam(':student_id',1, PDO::PARAM_INT);
		$stmt->bindParams(':course_id',2, PDO::PARAM_INT);
		$stmt->bindParams(':schedule_id',3,PDO::PARAM_INT);

		try {
			$stmt->execute();
			
		} catch(Exception $e) {
			echo "Oh no we were unable to assign you to a class </br>";
			echo "Please send this message to helpdesk@realestateone.com <br />";
			echo $e->getMessage();
		}
	}

	public function get_user_classes($student_id) {
		$query = "SELECT * FROM courses";
	}



	 // -------- Update User Information --------

	public function update_user($params) {
		$cols = [];
		
		foreach ($params as $key => $value) {
		
		}


		$query = "UPDATE users () VALUES ()";

	}


	// -------- *** Delete User *** --------

	public function delete_user() {
	// Not sure is im eveen going to code this one in. Udemy has it...so...
	}

	public function delete_class() {
	// Deletes a class (school) that a user is assigned to

	}

	// Accepted params from user forms. list should be bigger.
	function accepted_params() {
		return array( 
	 		"firstName",
	 		"lastName",
	 		"email", 
	 		"password",
	 		"userId",
	 		"courseId"
	 	);
	}

}


// ----------------------- Testing Area ----------------------- //

	// $blayne = new User($db);

	// $arr = array("firstName" => "test", "lastName" => "<h1>tester</h1>", "email" => "blayne@hotmail.com", "password" => "12345");
	// $blayne->create_user($arr);

// -------------------------------------------------------------- //
?>

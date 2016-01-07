<?php 

require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
require_once(D_ROOT . "/reou/classes/database.php");
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


		foreach ($params as $param => $value) {
		 	if(!in_array($param, $this->accepted_params())) {
		 		die("Form Field " . $param . " is not accepted");	
		 	}
		}

		$query = "SELECT 
		student_id,
		first_name, 
		last_name, 
		address, city, 
		state, 
		zip, 
		phone, 
		email, 
		licensed
		FROM  students
	 	WHERE email = :email and password = :password";

	 	$stmt = $this->db->prepare($query);
	 	$stmt->bindParam(':email', $params['email'], FILTER_SANITIZE_EMAIL);
	 	$stmt->bindParam(':password', md5($params['password']));

	 	try {
	 		$stmt->execute();
	 	} 

	 	catch(Exception $e) {
	 		echo "There was a problem getting user information from database";
	 		echo $e->getMessage();
	 	}

	 	
	 	// ------- Return Result Or False if Nothing Comes up -------- //
	 	if($stmt->rowCount() == 1) {
	 		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	 		return $result;
	 	} else {
	 		return false;
	 	}

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

		$data_enetered = date('m/d/Y');

		if ( $this->user_exists($params['email']) ) {
			die("this user already exisis");
		}

		else {

			// Run the INSERT QUERY -------------------------------------
		 	$students_query = "INSERT INTO students 
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

	 function user_exists($username) {
	 	// String - Username to check for 'johndoe@hotmail.com'
	 	// Check the the Student security table to see if that record exists. Alerts if there are dupes
	 	//Well does the user exist? return true of false.
	 	// For the die() statement. make it so that some soft of popup shows up.
	 	// If the User

	 	$students_query = "SELECT email FROM students
	 	WHERE email = :username";

	 	$stmt = $this->db->prepare($students_query);
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

	 public function get_user_details() {

	 	$query = "SELECT * FROM course_category";
	 	$stmt = $this->db->prepare($query);
	 	$stmt->execute();
	 	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	 	return $result;
	 }



	 public function get_user_classes() {

	 }


	 // -------- Update User Information --------

	public function update_user() {

	}


	// -------- *** Delete User *** --------

	public function delete_user() {
		// Not sure is im eveen going to code this one in. Udemy has it...so...
	}


	// Deletes a class (school) that a user is assigned to

	public function delete_class() {

	}

	function accepted_params() {
		return array( 
	 		"firstName",
	 		"lastName",
	 		"email", 
	 		"password"
	 	);
	}

}


// ----------------------- Testing Area ----------------------- //

	// $blayne = new User($db);

	// $arr = array("firstName" => "test", "lastName" => "<h1>tester</h1>", "email" => "blayne@hotmail.com", "password" => "12345");
	// $blayne->create_user($arr);

// -------------------------------------------------------------- //
?>

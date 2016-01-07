<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/reou/includes/const.php';

	try {

		$db = new PDO("mysql:host=".DB_HOST.";port=".DB_PORT."; dbname=".DB_NAME."", "root", "s0n!crush");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Turns on error reporting and catches the exception
		$db->exec("SET NAMES 'utf8'");
	} 

	catch (Exception $e) {

		echo "There was a problem connecting to the database";
		
	}

?>
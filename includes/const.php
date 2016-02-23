<?php

	// Document Root Variables

	define('D_ROOT', $_SERVER['DOCUMENT_ROOT']);
	define('P_ROOT', $_SERVER['DOCUMENT_ROOT'] . "/reou");
	define('W_ROOT', 'http://127.0.0.1/reou/');


	// --------------- ** MySQL settings ** --------------- //
	define('DB_NAME', 'reou');

	/** MySQL database username */
	define('DB_USER', 'root');


	/** MySQL database port */
	define('DB_PORT', '3306');

	/** MySQL database password */
	define('DB_PASSWORD', 's0n!crush');

	/** MySQL hostname */
	define('DB_HOST', 'localhost');

	/** Database Charset to use in creating database tables. */
	define('DB_CHARSET', 'utf8');

	date_default_timezone_set('America/Detroit');

?>
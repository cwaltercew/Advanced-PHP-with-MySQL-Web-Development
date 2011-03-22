<?php
function mysql_dbconnect() {
	$host = 'localhost';
	$database = 'guestbook';
	$username = 'dbuser';
	$password = 'password';
	
	$link = new PDO("mysql:host=$host;dbname=$database", $username, $password);
	
	if ($link === FALSE) {
		$private_error = 'mysql_dbconnect: could not open connection to mysql:'
			.'<li>errno:'.mysql_errno()
			.'<li>error:'.mysql_error()
		;
		error_log($private_error, 0);
		die('Error: could not connect to database server. Please contact the system administrator.');
		exit;
	}
	return $link;
}
?>

<?php # Script: config.inc

// This script sets the error reporting and logging for the site.

//error_reporting (0); // Production level
error_reporting (E_All); // Development level

// Use my own error handling function.
function my_error_handler ($e_number, $e_message, $e_file, $e_line) {

	$message = 'An error occurred in script ' . $e_file . ' on line ' . $e_line . ": $e_message";
	//error_log ($message, 1, 'phpmysql@dmcinsights.com'); // Production (send email)
	echo '<font color="red" size="+1">', $message, '</font>'; // Development (print the error in red)
}
set_error_handler('my_error_handler');
?>
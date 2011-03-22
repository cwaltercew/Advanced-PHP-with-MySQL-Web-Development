<?php

// function definitions

// int safe_mysql_query([string query])

function safe_mysql_query ($query='')
{
	if (empty($query))
	{
		return FALSE;
	}
	
	$link = mysql_dbconnect();

	$result = $link->prepare($query);

	if ($result === FALSE)
	{
		// if there was an error executing the query, write out the
		// details to the error log 

		$private_error = 'ack! query failed: '
			.'<li>errorno='.mysql_errno()
			.'<li>error='.mysql_error()
			.'<li>query='.$query
		;
		error_log($private_error, 0);

		// send a generic error message to the user

		die('There was an error executing a query. Please contact the system administrator.');
	}
	return $result;  
}
?>

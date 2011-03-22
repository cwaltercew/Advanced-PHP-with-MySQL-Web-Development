<?php
// void guestbook_authenticate([string realm [, string errmsg]])
// Require a valid username and password from the user.

// On Apache servers, because this function uses HTTP uses headers 
// to prompt the user for a name and password, it must be called 
// before any output - even a blank line or space - is sent to the browser. 

// $realm is the label that will appear in the pop-up window that
// asks for name and address, or as the title of the form.
// $errmsg is the text that will be displayed if the user hits the 'Cancel'
// button in the pop-up

function guestbook_authenticate($realm = 'Guest Book Administration'
 , $errmsg = 'You must enter a valid name and password to access this function'
)
{
// check if we can use HTTP authentication - as of now, that means checking
// if we are running as an Apache module
//	$http_auth_OK = (PHP_SAPI == 'apache');

// $_SERVER['PHP_AUTH_USER'] and $_SERVER['PHP_AUTH_PW'] are values 
// supplied by PHP, corresponding to the user name and password the user has 
// entered in the pop-up window created by an HTTP authentication header. 
// If no authentication header has ever been sent, these variables will be 
// empty. If we are not using HTTP authentication, the login form will
// create entries in the $_POST superglobal with the same names.

  if ($_POST['submit'] == 'Submit')
  {
	$_SESSION['PHP_AUTH_USER'] = $_POST['PHP_AUTH_USER'];
        $_SESSION['PHP_AUTH_PW'] = $_POST['PHP_AUTH_PW'];
  }
	$found_user = 0;
	if (!empty($_SESSION['PHP_AUTH_USER']))
	{
		// ignore case, even if MySQL has been set to pay attention to it
		$query = <<<EOQ
select 1 from guestbook_admin
where password = sha1(lower(?))
and lower(username) = lower(?)
EOQ;
		$result = safe_mysql_query($query, $_SESSION['PHP_AUTH_PW'], $_SESSION['PHP_AUTH_USER']);
		if ($result)
		{
			$password = $_SESSION['PHP_AUTH_PW'];
			$username = $_SESSION['PHP_AUTH_USER'];
			$result->bindParam(1, $password, PDO::PARAM_STR);
			$result->bindParam(2, $username, PDO::PARAM_STR);
			$result->execute();
			$found_user = $result->rowCount();
		}
		else
		{
// if the query didn't work at all (which should have been caught by
// safe_mysql_query() in theory), we're not going to be able to confirm 
// the password, so fail.
			$private_error = "problem running authentication query ($query): "
				.mysql_error()
			;
			error_log($private_error, 0);
			die('Database error: could not check password. Please contact the system administrator.');
			exit;
		}

// if the query ran but didn't find a match for the user name and password, 
// $found_user will not be set to anything. if this is so, have the user 
// try again.  

		if ($found_user == 0)
		{ 
			$errmsg .= <<<EOQ
<li>Could not find entry for username ({$_SESSION['PHP_AUTH_USER']}) -
please try again.
EOQ;
		}
	}
	if ($found_user == 0)
	{ 
//		if ($http_auth_OK)
//		{
// Send a WWW-Authenticate header, to perform HTTP authentication.
//			Header("WWW-Authenticate: Basic realm=\"$realm\"");
//			Header("HTTP/1.0 401 Unauthorized");

// The user should only see this after hitting the 'Cancel' button
// in the pop-up form.
//			print $errmsg;

//			exit;
//		}
//		else
//		{
// Print out an HTML form to obtain a name and password for authentication.

		if (!empty($errmsg)) { $errmsg = "<p>$errmsg</p>"; }
			print <<<EOQ
<h2>$realm</h2>
$errmsg
<form method=post>
Username: <input type=text name="PHP_AUTH_USER" value="{$_SESSION['PHP_AUTH_USER']}">
<br>
Password: <input type=password name="PHP_AUTH_PW" value="{$_SESSION['PHP_AUTH_PW']}">
<br>
<input type=submit name=submit value=Submit>
</form>
EOQ;
			exit;
//		}
		// should never get here
//		$private_error = 'authenticate: error: continued after requesting password';
//		error_log($private_error, 0);
//		die('System error: please contact the system administrator.');
//		exit;
	}
	else
	{
		print <<<EOQ
<p><b>Editing as {$_SESSION['PHP_AUTH_USER']}</b></p>
EOQ;
	}
}
?>

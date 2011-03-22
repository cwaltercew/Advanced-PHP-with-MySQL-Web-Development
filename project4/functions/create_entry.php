<?php
// string create_entry (string name, string location, string email, string url
// 	, string comments)
// Validate and insert a guestbook entry into the database. If all validation 
// tests are passed, prints out a confirmation; if not, prints out error 
// messages. Returns an empty string or relevant error messages.

function create_entry($name='',$location='',$email='',$url='',$comments='')
{
	// remove all HTML tags, and escape any other special characters
	$name = cleanup_text($name);
	$location = cleanup_text($location);
	$email = cleanup_text($email);
	$url = cleanup_text($url);
	$comments = cleanup_text($comments);
	
	// start out with an empty error message. as validation tests fail,
	// add errors to it.
	$errmsg = '';
	if (empty($name))
	{
		$errmsg .= "<li>you have to put in a name, at least!\n";
	}

	// do a very simple check on the format of the email address
	// supplied by the user. an email address is required.
	if (!empty($email) && !preg_match(
			'/^[A-Za-z0-9\_.\-]+@[A-Za-z0-9\_.\--]+\.[A-Za-z0-9\_-]+/', $email
	))
	{
		$errmsg .= "<li>$email doesn't look like a valid email address\n";
	}
	else
	{
		// if the format is OK, check to see if this user has already
		// signed the guestbook. multiple entries are not allowed.
		$query = "select * from guestbook where email = ?";
		$result = safe_mysql_query($query);
		$result->bindParam(1, $email,PDO::PARAM_STR);
		$result->execute();
		if (!$result)
		{
			$errmsg .= "<li>couldn't check the guestbook for $email.\n"; 
		}
		elseif ($result->rowCount() > 0)
		{
				$errmsg .= "<li>The email address '$email' has already signed this guestbook.\n";
		}
	}

	// perform a very simple check on the format of the url supplied
	// by the user (if any)

	if (!empty($url) && !preg_match('^http://[A-Za-z0-9\%\?\_\:\~\/\.-]+$',$url))
	{
		$errmsg .= "<li>$url doesn't look like a valid URL\n";
	}

	if (empty($errmsg))
	{
		$query = <<<EOQ
insert into guestbook (name,location,email,url,comments,remote_addr)
values (?,?,?,?,?,?)
EOQ;

		$params = array($name, $location, $email, $url, $comments, $_SERVER['REMOTE_ADDR']);
		$result = safe_mysql_query($query);
		$result->execute($params);

		print "<h2>Thanks, $name!!</h2>\n";
	}
	else
	{
		print <<<EOQ
<p>
<font color=red>
<b>
<ul>
$errmsg
</ul>
Please try again
</font>
</p>
EOQ;
	}
	return $errmsg;
}
?>

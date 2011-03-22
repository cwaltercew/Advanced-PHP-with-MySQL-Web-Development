<?php
/*
********************************************************
*** This script from MySQL/PHP Database Applications ***
***         by Jay Greenspan and Brad Bulger         ***
***                                                  ***
***   You are free to reuse the material in this     ***
***   script in any manner you see fit. There is     ***
***   no need to ask for permission or provide       ***
***   credit.                                        ***
********************************************************
*/

/*
Application: Guestbook2K
Described in: Chapter 8
Name: view.php
Purpose: Browse entries in the guestbook. 

This script is accessed in two ways:

- The user has clicked on the 'View My Guest Book!!' link displayed
  by the guestbook_end_page.php script. This will start at the most recent
  entry in the guestbook.

- The user has clicked on the 'Previous Entries' or 'Next Entries'
  displayed by the nav() function (declared in header.php). This 
  will display entries starting at a particular point in the guestbook.

This script can be run by any user.
*/

require_once('header.php');

guestbook_start_page('View My Guest Book!!');

?>

<table border="0">

<?php

// $preserve is passed into the cleanup_text() function (declared in
// /book/functions/basic.php). setting it to an empty value will cause
// any HTML tags in an entry to be stripped out before being displayed.

$preserve = '';

// select_entries() (declared in header.php) should return a mysql
// result set identifier

$result = select_entries($offset);

while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
{
	if (!print_entry($row,$preserve,'name','location','email','URL','entry date','comments'))
	{
		print "Error: could not print row\n";
		var_dump($row);
		break;
	}
	print "<tr><td colspan=2>&nbsp;</td></tr>\n";
}

// release memory associated with this mysql result set
//mysql_free_result($result);

?>

</table>

<?php

nav($offset);

guestbook_end_page();

?>

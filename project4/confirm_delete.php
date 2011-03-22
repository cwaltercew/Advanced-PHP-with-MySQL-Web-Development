<?php
  session_start();
/*
********************************************************
*** This script from MySQL/PHP Database Applications ***
***         by Jay Greenspan and Brad Bulger         ***
***                                                  ***
***   You are free to resuse the material in this    ***
***   script in any manner you see fit. There is     ***
***   no need to ask for permission or provide       ***
***   credit.                                        ***
********************************************************
*/

/*
Application: Guestbook2k
Described in: Chapter 8
Name: confirm_delete.php
Purpose: Confirm, then perform, deletion of entries from the 
guestbook.

This script will be accessed in two circumstances:

- The 'Delete Entries' button on the edit.php page was pressed.
  This should be the first time that the script is called. The ids
  of the records to be deleted should be passed in via the entry_id[]
  array.

- The 'Confirm Delete' button on this page was pressed. This confirms
  the deletions and will run the delete queries against the database.

The $offset variable is preserved to allow navigation to other entries
in the guestbook after or instead of confirming the deletion.

This script must be run by an authenticated user - i.e., only 
guestbook administrators.

*/

// turn on PHP output buffering - only HTTP headers will be sent
// to the browser while this is on. it will prevent an accidental
// blank line or some such from breaking HTTP authentication.

ob_start();

require_once('header.php');
guestbook_authenticate();

// turn off output buffering and send the accumulated output
// to the browser

ob_end_flush();

guestbook_start_page('Confirm Changes');


$submit = (string)array_key_value($_POST,'submit');

// if $entry_id hasn't been passed in - because the user
// hit the 'Delete' button without checking off any
// entries, say - initialize it to an empty array.

$entry_id = (array)array_key_value($_POST,'entry_id',array());

if ($submit == 'Delete Entries' && !empty($entry_id))
{
	// presumably coming from edit.php. print out id values to be
	// deleted and the 'Confirm Delete' submit button

	// because the <form> tag contains no action attribute, it
	// will submit back to this script

	print "<form method=post>\n<ul>\n";

	foreach ((array)$entry_id as $value)
	{
		print <<<EOQ
<li>Delete entry #$value?
<input type=hidden name="entry_id[]" value="$value">
EOQ;
	}

	print <<<EOQ
</ul>
<br>
<input type=submit name=submit value="Confirm Delete">
<input type=hidden name=offset value="$offset">
</form>
EOQ;

}
elseif ($submit == 'Confirm Delete')
{
	// presumably coming from the above form on this page.
	// delete entries in the entry_id[] array
	foreach ($entry_id as $value)
	{
		print "<li>Deleting entry #$value\n";
		$result = safe_mysql_query('delete from guestbook where entry_id = ?');
		$result->execute(array($value));
	}
}
else
{
	// just in case this script is called directly or in some other
	// unanticipated manner
	print "<h4>No action to confirm</h4>\n";
}

// display navigational links and end the page
nav($offset, 'edit.php');
guestbook_end_page();

?>

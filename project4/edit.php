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
Name: edit.php
Purpose: Allow a guestbook administrator to review and delete entries
in the guestbook.  

This script is accessed in two ways:

- The user has clicked on the 'Administer the Guest Book' link displayed by 
  end_page.php. The offset variable will not be set in this case, and so
  the user will begin with the most recent entry in the guestbook.

- The user has clicked on either the 'Previous Entries' or 'Next Entries'
  links displayed by the nav() function (declared in functions.php).
  This passes in a value for the offset variable that will be used
  to select a particular range of entries in the guestbook.

From here, the user may view other entries in the guestbook, or mark
the displayed entries for deletion and call the confirm_delete.php script.

The script will not run unless the user has successfully logged in.

*/

ob_start();

require_once('header.php');
guestbook_authenticate();

ob_end_flush();

guestbook_start_page('Edit The Guest Book');

?>

<form method="post" action="confirm_delete.php">

<table border=1>

<?php
// if we haven't been asked to start anywhere in particular, then start
// with the most recent entry. Entries are viewed in descending date order.

// select_entries() returns a mysql result set identifier
$result = select_entries($offset);

// $preserve will be passed in to the cleanup_text() function (declared
// in /book/functions/basic.php). setting it to a non-empty value keeps
// the function from stripping out any tags the user has entered; instead,
// they will be converted from <tagname> to &lt;tagname&gt; 
$preserve = 'yes';

while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
{
	// call the normal function to display a guestbook entry
	print_entry($row,$preserve,'name','entry date','location','email'
		,'URL','comments'
	);

	// now add an extra row to allow the user to mark this entry
	// for deletion
	print <<<EOQ
 <tr>
  <td valign=top align=right><b>Delete?</b></td>
  <td valign=top align=left>
   <input type=checkbox name="entry_id[]" value="{$row['entry_id']}">
   Yes, delete entry #{$row['entry_id']}
  </td>
 </tr>
 <tr><td colspan=2>&nbsp;</td></tr>
EOQ;
}
// release all memory used by the result set
mysql_free_result($result);
?>

</table>

<input type=submit name=submit value="Delete Entries">
<input type=reset>

</form>

<?php 

// display navigational links and end the page
nav($offset);

guestbook_end_page();

?>

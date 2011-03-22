<?php 

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
Application: Guestbook2K
Described in: Chapter 8
Name: sign.php
Purpose: Make an entry in the guestbook.

This script expects to be called in two circumstances:

- The user has clicked on the 'Sign My Guest Book!!' link displayed
  by the guestbook_end_page.php script. In this case, the submit variable
  will be empty, and a blank form will be printed out for the user
  to fill in and submit back to this script.

- The user has filled in the form displayed by this page and submitted it.
  In this case, the submit variable will have a value of "Sign!", and
  the script will attempt to create an entry in the guestbook. If the
  attempt fails, error messages will be printed out, and the form will
  be re-displayed, filled in with whatever the user had typed in before.
  If the attempt succeeds, a confirmation message will be printed out
  and the script will exit.

*/

require_once('header.php');

guestbook_start_page('Sign My Guest Book!!');

extract($_POST);

if ($submit == 'Sign!')
{
	// the user has filled in this form and pressed the 'Sign!'
	// button - try to create an entry
	//$name = array_key_value($_POST,'name');
	//$location = array_key_value($_POST,'location');
	//$email = array_key_value($_POST,'email');
	//$url = array_key_value($_POST,'url');
	//$comments = array_key_value($_POST,'comments');

	$errmsg = create_entry($name,$location,$email,$url,$comments);

	if (empty($errmsg)) 
	{ 
		guestbook_end_page();
		exit; 
	}
}
?>

<form method=post>

<table>

<?php 

// print out HTML text entry fields for a guestbook entry. if the user
// is coming into this script for the first time, these variables will
// be empty and the form will be blank - otherwise, the values they
// typed in previously will be displayed. 

print_input_fields('name','location','email','url'); 

$comments = array_key_value($_POST,'comments');
?>

 <tr>
  <td valign=top align=right>
   <b>Comments:</b>
  </td>
  <td valign=top align=left>
   <textarea name=comments cols=40 rows=4><?php print $comments; ?></textarea>
  </td>
 </tr>

</table>

<input type=submit name=submit value="Sign!">
<input type=reset name=reset value="Start Over">

</form>

<?php

guestbook_end_page();

?>

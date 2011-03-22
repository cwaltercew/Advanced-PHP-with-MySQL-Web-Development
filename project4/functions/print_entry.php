<?php
// void print_entry (array row [, string preserve] [, string ...])
// Prints out a guestbook entry. The first argument is expected be a row 
// from a MySQL result set, but could be any valid array. The second
// argument is passed to cleanup_text() and controls the stripping-out
// of HTML tags.  The names of the fields to be printed are passed
// in as a variable number of arguments following the first two.

function print_entry($row,$preserve='')
{
	if (!is_assoc($row))
	{
		return FALSE;
	}

	// walk through any arguments passed in after the first two
	$numargs = func_num_args();
	for ($i = 2; $i < $numargs; $i++)
	{
		$field = func_get_arg($i);

		// This will transform a label string to a valid database 
		// field name - e.g., 'Last Name' becomes 'last_name'
		$dbfield = str_replace(' ', '_', strtolower($field));

		$dbvalue = cleanup_text($row[$dbfield],$preserve);
		$name = ucwords($field);
		print <<<EOQ
 <tr>
  <td valign=top align=right><b>$name:</b></td>
  <td valign=top align=left>$dbvalue</td>
 </tr>
EOQ;
	}
	return TRUE;
}
?>

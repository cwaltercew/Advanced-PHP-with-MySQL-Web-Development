<?php
// void print_input_fields([string name [, string ...]])
// Print out a variable number of arguments, presumed to be the names
// of currently defined _POST variables, as HTML form input fields.

function print_input_fields()
{
	$fields = func_get_args();
	foreach ($fields as $field)
	{
		$value = array_key_value($_POST,$field,'');
		$label = ucwords(str_replace('_',' ',$field));
		if ($field == "url" && $value == '') {
			$value = 'http://';
		}
		print <<<EOQ
 <tr>
  <td valign=top align=right>
   <b>$label:</b>
  </td>
  <td valign=top align=left>
   <input type="text" name="$field" size="40" value="$value">
  </td>
 </tr>
EOQ;
	}
}
?>

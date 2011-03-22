<?php
// void nav ([string this_script [, int limit]])
// Print out navigational links for moving through entries in the guestbook.
// The first argument indicates where to start - the default value is zero,
// meaning the first (most recent) record. The second argument is the name
// of the script to use in the link - if empty, the value of the predefined
// global variable PHP_SELF will be used - this will be the name of the file 
// being displayed to the user (i.e., if bla.php includes display.php, which 
// includes bottom.php, which calls this function, PHP_SELF will be 'bla.php').

function nav ($offset=0, $this_script='', $limit=DEFAULT_LIMIT)
{
	$offset = (int)$offset;
	$limit = (int)$limit;

	// don't run things from outside this directory
	if ( empty($this_script) or 
		dirname(realpath(__FILE__)) != dirname(realpath($this_script)) 
	)
	{
		$this_script = $_SERVER['PHP_SELF'];
	}

	// get the total number of entries in the guest book -
	// we need this to know if we can go forward from where we are

	$result = safe_mysql_query('select * from guestbook');
	$result->execute();
	$total_rows = $result->rowCount();
	print "<p>\n";
	if ($offset > 0) 
	{ 
		// if we're not on the first record, we can always go backwards
		$poffset = $offset - $limit < 0 ? 0 : $offset - $limit;
		print <<<EOQ
<a href="${this_script}?offset=${poffset}">&lt;&lt;Previous Entries</a>
&nbsp;
EOQ;
	}
	if ($offset+$limit < $total_rows)
	{
		// offset + limit gives us the maximum record number 
		// that we could have displayed on this page. if it's
		// less than the total number of entries, that means
		// there are more entries to see, and we can go forward
		$noffset = $offset + $limit;
		print <<<EOQ
<a href="${this_script}?offset=${noffset}">Next Entries&gt;&gt;</a>
EOQ;
	}
	print "</p>\n";
}
?>

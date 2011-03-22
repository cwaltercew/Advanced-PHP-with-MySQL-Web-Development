<?php
// int select_entries ([int offset [. int limit]])
// Select a set of entries from the guestbook. The number of entries selected
// is determined by the value of the $limit argument, defaulting to the
// constant DEFAULT_LIMIT. The $offset argument determines where to start 
// - the default value is zero, meaning the first record. Entries are 
// retrieved in descending order of the date they were created. Return 
// the mysql data set identifier for the rows retrieved.

function select_entries ($offset=0, $limit=DEFAULT_LIMIT)
{
	// cast to make sure that these are integer values
	$limit = (int)$limit;
	$offset = (int)$offset;

	$query = <<<EOQ
select *, date_format(created,'%e %M, %Y %h:%i %p') as entry_date
from guestbook
order by created desc
limit ?, ?
EOQ;
	$result = safe_mysql_query($query);
	
	$result->bindParam(1, $offset, PDO::PARAM_INT);
	$result->bindParam(2, $limit, PDO::PARAM_INT);
	$result->execute();
	return $result;

}
?>

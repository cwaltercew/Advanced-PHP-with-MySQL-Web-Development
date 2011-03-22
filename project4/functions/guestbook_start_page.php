<?php
function guestbook_start_page ($title='')
{
	if (empty($title))
	{
		$title = 'Welcome to my Guest Book!';
	}
	$page_title = make_page_title($title);
	print <<<EOQ
<html>
<title>$page_title</title>
<head>
</head>
<body bgcolor=white>

<h2>$title</h2>

EOQ;
}
?>

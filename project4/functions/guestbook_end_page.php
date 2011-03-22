<?php
function guestbook_end_page ()
{
	print <<<EOQ
<p><br></p>
<p><br></p>
<p>
<a href="index.php">Home</a>
&nbsp; | &nbsp;
<a href="view.php">View My Guest Book!!</a>
&nbsp; | &nbsp;
<a href="sign.php">Sign My Guest Book!!</a>
&nbsp; | &nbsp;
<a href="edit.php">Administer the Guest Book</a>
</p>

<br>
<br>
<br>
<br>
<br>
EOQ;
	$gpos = strpos(__FILE__, 'guestbook2k');
//	$end_page_file = substr(__FILE__, 0, $gpos).'/functions/html/end_page.php';
//	echo default_end_page();
}
?>

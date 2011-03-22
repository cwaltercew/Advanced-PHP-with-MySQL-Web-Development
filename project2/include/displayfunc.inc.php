<?php
define("_DEBUGGING", 0);

///////////////////////////////////////////////////////////////
// Writes the HTML Header to the page
///////////////////////////////////////////////////////////////
function WriteHTMLHeader()
{
	echo "<HTML>\n";
	echo "<HEAD><TITLE>My Application</TITLE></HEAD>\n";
	echo "<BODY bgcolor=#ffffff>]n";
}

///////////////////////////////////////////////////////////////
// Writes the HTML Footer to the page
///////////////////////////////////////////////////////////////
function WriteHTMLFooter()
{
	echo "</BODY>\n";
	echo "</HTML>\n";
}

///////////////////////////////////////////////////////////////
// Writes our table header of the framework
///////////////////////////////////////////////////////////////
function WriteTableHeader()
{
	echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"750\">";
	echo "<tr>";
	echo "<td align=\"left\" valign=\"top\"><img src=\"images/topleft.jpg\" border=\"0\"></td>";
	echo "<td align=\"left\" valign=\"top\"><img src=\"images/topcenter.jpg\" border=\"0\"></td>";
	echo "<td align=\"left\" valign=\"top\"><img src=\"images/topright.jpg\" border=\"0\"></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td align=\"left\" valign=\"top\"><img src=\"images/leftbar.jpg\" border=\"0\"></td>";
	echo "<td align=\"left\" valign=\"top\">";
}

///////////////////////////////////////////////////////////////
// Writes our table footer of the framework
///////////////////////////////////////////////////////////////
function WriteTableFooter()
{
	echo "</td>";
	echo "<td align=\"left\" valign=\"top\"><img src=\"images/rightbar.jpg\" border=\"0\"></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td align=\"left\" valign=\"top\"><img src=\"images/btmleft.jpg\" border=\"0\"></td>";
	echo "<td align=\"left\" valign=\"top\"><img src=\"images/btmcenter.jpg\" border=\"0\"></td>";
	echo "<td align=\"left\" valign=\"top\"><img src=\"images/btmright.jpg\" border=\"0\"></td>";
	echo "</tr>";
	echo "</table>";
}

///////////////////////////////////////////////////////////////
// Writes a Java Script Alert window to the page
///////////////////////////////////////////////////////////////
function ErrorPopup($msg)
{
	// Create a JavaScript alert
	echo "<SCRIPT LANGUAGE='JavaScript'>\n";
	echo "<!--\n";
	echo "alert(\"$msg\");\n";
	echo "//-->\n";
	echo "</SCRIPT>\n";
}

//////////////////////////////////////////////////////////////
// Writes a debugging string to the page if debugging is on
//////////////////////////////////////////////////////////////
function Trace($msg)
{
	if(_DEBUGGING)
		echo $msg;
}
?>
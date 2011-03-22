<?php # Script: browse_prints.php
// This page displays the available prints (products).

// Set the page title and include the HTML header.
$page_title = 'Browse the Prints';
include_once ('includes/header.html');

require_once ('../mysql_connect.php'); // Connect to the database.

// Are we looking at a particular artist?
if (isset($_GET['aid'])) {
	$query = "SELECT * FROM artists, prints WHERE artists.artist_id = prints.artist_id AND prints.artist_id = {$_GET['aid']} ORDER BY prints.print_name";
} else {
	$query = "SELECT * FROM artists, prints WHERE artists.artist_id = prints.artist_id ORDER BY artists.last_name ASC, prints.print_name ASC";
}

echo '<table border="0" width="90%" cellspacing="3" cellpadding="3" align="center">
<tr>
<td align="left" width="20%"><b>Artist</b></td>
<td align="left" width="20%"><b>Print Name</b></td>
<td align="left" width="40%"><b>Description</b></td>
<td align="right" width="20%"><b>Price</b></td>
</tr>';

// Display all the URLs.
$result = mysqli_query($dbc, $query);
while ($row = mysqli_fetch_assoc($result)) {
	// Display each record.
	echo "	<tr>
		<td align=\"left\"><a href=\"browse_prints.php?aid={$row['artist_id']}\">{$row['last_name']}, {$row['first_name']}</a></td>
		<td align=\"left\"><a href=\"view_print.php?pid={$row['print_id']}\">{$row['print_name']}</td>
		<td align=\"left\">" . stripslashes($row['description']) . "</td>
		<td align=\"right\">\${$row['price']}</td>
	</tr>\n";
	
} // End of while loop.

echo '</table>'; // Close the table.

mysqli_close($dbc); // Close the database connection.
include_once ('includes/footer.html'); // Require the HTML footer.
?>
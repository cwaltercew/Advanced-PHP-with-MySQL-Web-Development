<?php # Script: view_print.php
// This page displays the details for a particular print.

if (is_numeric ($_GET['pid'])) { // Make sure there's a print ID.
	
	require_once ('../mysql_connect.php'); // Connect to the database.
	$query = "SELECT * FROM artists, prints WHERE artists.artist_id = prints.artist_id AND prints.print_id = {$_GET['pid']}";
	$result = mysqli_query($dbc, $query);
	$row = mysqli_fetch_assoc($result);
	mysqli_close($dbc); // Close the database connection.
	
	// Set the page title and include the HTML header.
	$page_title = $row['print_name'];
	include_once ('includes/header.html');

	// Display a header.
	echo "<div align=\"center\">
<b>{$row['print_name']}</b> by 
{$row['first_name']} {$row['last_name']}
<br />{$row['size']}
<br />\${$row['price']} 
<a href=\"add_cart.php?pid={$row['print_id']}\">Add to Cart</a>
</div><br />";

	// Get the image information and display the image.
	if ($image = @getimagesize ("../uploads/{$row['image_name']}")) {
		echo "<div align=\"center\"><img src=\"../uploads/{$row['image_name']}\" $image[3] alt=\"{$row['print_name']}\" />";	
	} else {
		echo "<div align=\"center\">No image available."; 
	}
	echo '<br />' . stripslashes($row['description']) . '</div>';

	include_once ('includes/footer.html'); // Require the HTML footer.

} else { // Redirect
	header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/index.php");
	exit();
}

?>
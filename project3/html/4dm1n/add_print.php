<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/2000/REC-xhtml1-20000126/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<title>Add a Print</title>
</head>
<body>
<?php # Script: add_product.php
// This page allows the administrator to add a print (product).

require_once ('../../mysql_connect.php'); // Connect to the database.

if (isset($_POST['submit'])) { // Handle the form.
	
	// Validate the print_name, image, artist (existing or first_name, last_name, middle_name), size, price, and description.

	// Check for a print name.
	if (!empty($_POST['print_name'])) {
		$pn = escape_data($_POST['print_name']);
	} else {
		$pn = FALSE;
		echo '<p><font color="red">Please enter the print\'s name!</font></p>';
	}
	
	// Check for an image (not required).
	if (is_uploaded_file ($_FILES['image']['tmp_name'])) {
		if (move_uploaded_file($_FILES['image']['tmp_name'], "../../uploads/{$_FILES['image']['name']}")) { // Move the file over.

			echo '<p>The file has been uploaded!</p>';

		} else { // Couldn't move the file over.
			echo '<p><font color="red">The file could not be moved.</font></p>';
			$i = '';
		}
		$i = $_FILES['image']['name'];
	} else {
		$i = '';
	}
	
	// Check for a size (not required).
	if (!empty($_POST['size'])) {
		$s = escape_data($_POST['size']);
	} else {
		$s = '<i>Size information not available.</i>';
	}
	
	// Check for a price.
	if (is_numeric($_POST['price'])) {
		$p = $_POST['price'];
	} else {
		$p = FALSE;
		echo '<p><font color="red">Please enter the print\'s price!</font></p>';
	}
	
	// Check for a description (not required).
	if (!empty($_POST['description'])) {
		$d = escape_data($_POST['description']);
	} else {
		$d = '<i>No description available.</i>';
	}
	
	// Validate the artist.
	if ($_POST['artist'] == 'new') {

		// If it's a new artist, add the artist to the database.
		$query = 'INSERT INTO artists (artist_id, first_name, last_name) VALUES (NULL, ';

		if (!empty($_POST['first_name'])) {
			$query .= "'" . escape_data($_POST['first_name']) . "', ";
		} else {
			$query .= 'NULL, ';
		}

//		if (!empty($_POST['middle_name'])) {
//			$query .= "'" . escape_data($_POST['middle_name']) . "', ";
//		} else {
//			$query .= 'NULL, ';
//		}

		// Check for a last_name.
		if (!empty($_POST['last_name'])) {
			$query .= "'" . escape_data($_POST['last_name']) . "')";
			$result = @mysqli_query($dbc, $query); // Run the query.
			$a = @mysqli_insert_id($dbc); // Get the artist ID.		
		} else {
			$a = FALSE;
			echo '<p><font color="red">Please enter the artist\'s last name!</font></p>';
		}
		
	} elseif ( ($_POST['artist'] == 'existing') && ($_POST['existing'] > 0)) {
		$a = $_POST['existing'];
	} else {
		$a = FALSE;
		echo '<p><font color="red">Please enter or select the print\'s artist!</font></p>';
	}
	
	if ($pn && $p && $a) {
	
		// Add the print to the database.
		$query = "INSERT INTO prints (artist_id, print_name, price, size, description, image_name) VALUES ($a, '$pn', $p, '$s', '$d', '$i')";
		if ($result = @mysqli_query ($dbc, $query)) { // Worked.
			echo '<p>The print has been added.</p>';
		} else { // If the query did not run OK.
			echo '<p><font color="red">Your submission could not be processed due to a system error.</font></p>'; 
		}
		
	} else { // Failed a test.
			echo '<p><font color="red">Please click "back" and try again.</font></p>';
	}
	
} else { // Display the form.
?>
	
<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<input type="hidden" name="MAX_FILE_SIZE" value="524288">

<fieldset><legend>Fill out the form to add a print to the catalog:</legend>

<p><b>Print Name:</b> <input type="text" name="print_name" size="30" maxlength="60" /></p>

<p><b>Image:</b> <input type="file" name="image" /></p>

<p><b>Artist:</b>
Existing <input type="radio" name="artist" value="existing" /> 
<select name="existing"><option>Select One</option>
<?php // Retrieve all the artists and add to the pull-down menu.
$query = "SELECT artist_id, CONCAT(last_name, ', ', first_name) AS name FROM artists ORDER BY last_name ASC";		
$result = @mysqli_query($dbc, $query);
while ($row = mysqli_fetch_assoc($result)) {
	echo "<option value=\"{$row['artist_id']}\">{$row['name']}</option>\n";
}
mysqli_close($dbc); // Close the database connection.
?>
</select><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
New <input type="radio" name="artist" value="new" /> 
First Name: <input type="text" name="first_name" size="15" maxlength="40" />
Last Name: <input type="text" name="last_name" size="20" maxlength="40" />
</p>

<p><b>Size:</b> <input type="text" name="size" size="30" maxlength="60" /></p>

<p><b>Price:</b> <input type="text" name="price" size="10" maxlength="10" /><br /><small>Do not include the dollar sign or commas.</small></p>

<p><b>Description:</b> <textarea name="description" cols="40" rows="5"></textarea></p>

</fieldset>
	
<div align="center"><input type="submit" name="submit" value="Submit" /></div>

</form><!-- End of Form -->
<?php
} // End of main conditional.
?>
</body>
</html>
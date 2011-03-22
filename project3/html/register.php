<?php # Script: register.php
// This is the registration page for the site.

// Include the configuration file for error management and such.
require_once ('includes/config.inc'); 

// Set the page title and include the HTML header.
$page_title = 'Register';
include ('includes/header.html');

if (isset($_POST['submit'])) { // Handle the form.

	require_once ('../mysql_connect.php'); // Connect to the database.
	
	// Check for a first name.
	if (eregi ("^[[:alpha:].' -]{2,40}$", stripslashes(trim($_POST['first_name'])))) {
		$fn = escape_data($_POST['first_name']);
	} else {
		$fn = FALSE;
		echo '<p><font color="red" size="+1">Please enter your first name!</font></p>';
	}
	
	// Check for a last name.
	if (eregi ("^[[:alpha:].' -]{2,40}$", stripslashes(trim($_POST['last_name'])))) {
		$ln = escape_data($_POST['last_name']);
	} else {
		$ln = FALSE;
		echo '<p><font color="red" size="+1">Please enter your last name!</font></p>';
	}
	
	// Check for an email address.
	if (eregi ("^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$", stripslashes(trim($_POST['email'])))) {
		$e = escape_data($_POST['email']);
	} else {
		$e = FALSE;
		echo '<p><font color="red" size="+1">Please enter a valid email address!</font></p>';
	}

	// Check for a shipping address.
	if (stripslashes(trim($_POST['address']))) {
		$adr = escape_data($_POST['address']);
	} else {
		$adr = FALSE;
	//	echo '<p><font color="red" size="+1">Please enter a valid shipping address!</font></p>';
	}

	// Check for a city.
	if (eregi ("^[[:alpha:].' -]{2,30}$", stripslashes(trim($_POST['city'])))) {
		$city = escape_data($_POST['city']);
	} else {
		$city = FALSE;
		echo '<p><font color="red" size="+1">Please enter a city to ship to!</font></p>';
	}
	
	// Check for a state.
	if (eregi ("^[[:alpha:].]{2}$", stripslashes(trim($_POST['state'])))) {
		$st = escape_data($_POST['state']);
	} else {
		$st = FALSE;
		echo '<p><font color="red" size="+1">Please enter a state to ship to!</font></p>';
	}
	
	// Check for a zipcode.
	if (eregi ("^[[:digit:].-]{5,10}$", stripslashes(trim($_POST['zipcode'])))) {
		$zip = escape_data($_POST['zipcode']);
	} else {
		$zip = FALSE;
		echo '<p><font color="red" size="+1">Please enter a valid zip code!</font></p>';
	}
    
	// Check for a credit card type.
	if ($_POST['type'] == 'V' || $_POST['type'] == 'M'
     || $_POST['type'] == 'A' || $_POST['type'] == 'D' ) {
		$type = escape_data($_POST['type']);
	} else {
		$type = FALSE;
		echo '<p><font color="red" size="+1">Please enter a credit card type!</font></p>';
	}
	
	// Check for a credit card number.
	if (eregi ("^[[:digit:].]{16}$", stripslashes(trim($_POST['card'])))) {
		$card = escape_data($_POST['card']);
	} else {
		$card = FALSE;
		echo '<p><font color="red" size="+1">Please enter a valid credit card number!</font></p>';
	}
    
	// Check for a username.
	if (eregi ("^[[:alnum:]_]{4,20}$", stripslashes(trim($_POST['username'])))) {
		$u = escape_data($_POST['username']);
	} else {
		$u = FALSE;
		echo '<p><font color="red" size="+1">Please enter a valid username!</font></p>';
	}
	
	// Check for a password and match against the confirmed password.
	if (eregi ("^[[:alnum:]]{4,20}$", stripslashes(trim($_POST['password1'])))) {
		if ($_POST['password1'] == $_POST['password2']) {
			$p = escape_data($_POST['password1']);
		} else {
			$p = FALSE;
			echo '<p><font color="red" size="+1">Your password did not match the confirmed password!</font></p>';
		}
	} else {
		$p = FALSE;
		echo '<p><font color="red" size="+1">Please enter a valid password!</font></p>';
	}
	
	if ($fn && $ln && $e && $city && $st && $type && $card && $u && $p) {
    // If everything's OK.
		// Make sure the username is available.
		$query = "SELECT username FROM customers WHERE username='$u'";		
		@ $result = mysqli_query($dbc, $query);
		
		if (mysqli_num_rows($result) == 0) { // Available.
		
			// Add the user.
			$query = "INSERT INTO customers (username, first_name, last_name,"
                   . " email, address, city, state, zipcode, password,"
                   . " card_type, card_number, registration_date)"
                   . " VALUES ('$u', '$fn', '$ln', '$e', '$adr', '$city', '$st',"
                   . " '$zip', SHA1('$p'), '$type', '$card', NOW() )";
			$result = @mysqli_query($dbc, $query); // Run the query.

			if ($result) { // If it ran OK.
				// Send an email, if desired.
				echo '<h3>Thank you for registering!</h3>';
				include ('includes/footer.html'); // Include the HTML footer.
				exit();				
				
			} else { // If it did not run OK.
				// Send a message to the error log, if desired.
				echo '<p><font color="red" size="+1">You could not be registered due to a system error. We apologize for any inconvenience.</font></p>'; 
			}		
			
		} else { // The username is not available.
			echo '<p><font color="red" size="+1">That username is already taken.</font></p>'; 
		}
		
		mysqli_close($dbc); // Close the database connection.

	} else { // If one of the data tests failed.
		echo '<p><font color="red" size="+1">Please try again.</font></p>';		
	}

} // End of the main Submit conditional.
?>
	
	<h1>Register</h1>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<fieldset>
	
	<p><b>First Name:</b> <input type="text" name="first_name" size="20" maxlength="40" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" /></p>
	
	<p><b>Last Name:</b> <input type="text" name="last_name" size="30" maxlength="40" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>" /></p>
	
	<p><b>Email Address:</b> <input type="text" name="email" size="40" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" /> </p>
	
	<p><b>Ship To Address:</b> <input type="text" name="address" size="40" maxlength="40" value="<?php if (isset($_POST['address'])) echo $_POST['address']; ?>" /> </p>
	
	<p><b>Ship To City:</b> <input type="text" name="city" size="20" maxlength="30" value="<?php if (isset($_POST['city'])) echo $_POST['city']; ?>" />
       <b>State:</b> <input type="text" name="state" size="2" maxlength="2" value="<?php if (isset($_POST['state'])) echo $_POST['state']; ?>" />
       <b>Zip:</b> <input type="text" name="zipcode" size="10" maxlength="10" value="<?php if (isset($_POST['zipcode'])) echo $_POST['zipcode']; ?>" />
       </p>
	
<table>
 <tr>
  <td><b>Credit Card Type:</b></td>
  <td><input type="radio" name="type" value="V">Visa</td>
  <td><input type="radio" name="type" value="M">Master Card</td>
  <td><input type="radio" name="type" value="A">American Express</td>
  <td><input type="radio" name="type" value="D">Discover</td>
 </tr>
</table>
	<p><b>Credit Card Number:</b> <input type="text" name="card" size="20" maxlength="20" value="<?php if (isset($_POST['card'])) echo $_POST['card']; ?>" /> </p>
	
	<p><b>User Name:</b> <input type="text" name="username" size="15" maxlength="20" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>" /><br>
    <small>Use only letters, numbers, and the underscore. Must be between 4 and 20 characters long.</small></p>
	
	<p><b>Password:</b> <input type="password" name="password1" size="20" maxlength="20" /><br>
    <small>Use only letters and numbers. Must be between 4 and 20 characters long.</small></p>
	
	<p><b>Confirm Password:</b> <input type="password" name="password2" size="20" maxlength="20" /></p>
	</fieldset>
	
	<div align="center"><input type="submit" name="submit" value="Register" /></div>
	
	</form><!-- End of Form -->

<?php // Include the HTML footer.
include ('includes/footer.html');
?>
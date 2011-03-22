<?php # Script: final.php
// This is the last of the checkout pages.

// Set the page title and include the HTML header.
$page_title = 'Checkout';
include_once ('includes/header.html');

# *** This page will receive the approval code. *** #
$approved = 'Y'; // Practice

require_once ('../mysql_connect.php'); // Connect to the database.

// Turn the cart into a database-safe version.
$c = addslashes (serialize($_SESSION['cart']));

// Add the record to the database.
$query = "INSERT INTO orders (customer_id, total, order_date, approved, cart)"
       . " VALUES ({$_SESSION['cid']}, {$_SESSION['total']}, NOW(), '$approved', '$c' )";
$result = mysqli_query($dbc, $query);

// Kill the session data.
$_SESSION = array(); // Destroy the variables.
session_destroy(); // Destroy the session itself.

if ($approved == 'Y') {
	// Send an email.
	echo '<p>Thank you for your order!</p>';
} else {
	echo '<p>Your order could not be placed!</p>';
}

mysqli_close($dbc);
include_once ('includes/footer.html'); // Require the HTML footer.
?>
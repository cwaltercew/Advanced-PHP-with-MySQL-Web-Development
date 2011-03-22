<?php # Script: add_cart.php
// This page adds prints to the shopping cart.

if (is_numeric ($_GET['pid'])) { // Check for a print ID.

	$pid = $_GET['pid'];
	
	// Set the page title and include the HTML header.
	$page_title = 'Add to Cart';
	include_once ('includes/header.html');

	// Check if the cart already contains one of these prints.
	if (isset ($_SESSION['cart'][$pid])) {
		$qty = $_SESSION['cart'][$pid] + 1;
	} else {
		$qty = 1;
	}
	
	// Add to the cart session variable.
	$_SESSION['cart'][$pid] = $qty;

	// Display a message.
	echo '<p>The print has been added to your shopping cart.</p>';

	include_once ('includes/footer.html'); // Require the HTML footer.

} else { // Redirect
	header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/index.php");
	exit();
}

?>
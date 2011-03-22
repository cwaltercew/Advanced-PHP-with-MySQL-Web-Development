<?php # Script: confirm.php
// This is the second of the checkout pages.

// Set the page title and include the HTML header.
extract($_POST);
session_start();
require_once('includes/customer.php');
$page_title = 'Checkout';
if (!isset($_SESSION['cid'])) {
	$customer = new Customer($username, $password);
} else {
	$customer = new Customer($_SESSION['cid']);
}

//
// The purpose of this PHP script is to confirm the login from checkout.php
// and display the customer information. If the customer confirms the order
// you should write out the order record with the current contents of the
// "cart" session variable. Script final.php does this, use it if you wish.
//
// Then you should create a "smart" HTMl form (similar to the one in register.php)
// to allow the customer to update their name, address and credit card information.
// Note that the register.php script will allow you to add one or more customers for testing.
//

if ($customer->getId() <> 0) {

	//Begin Displaying the Page
	include_once ('includes/header.html');

	// Register the customer ID to the session.
	$_SESSION['cid'] = $customer->getId();
	
	// Create a form.
?>
	<form action="final.php" method="post">
		<h3>Please Confirm Your Billing Information</h3>
		<p><?php echo $customer; ?></p>
		<input type="submit" name="submit" value="Submit My Order" />
		<input type="button" value="Edit Info" onClick="window.location='edit.php';">
	</form>
<?php
	include_once ('includes/footer.html'); // Require the HTML footer.
} else {

	header('location: checkout.php');

}
?>
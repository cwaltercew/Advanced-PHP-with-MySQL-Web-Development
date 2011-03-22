<?php # Script 13.x - view_order.php
// This is the first of the checkout pages.

// Set the page title and include the HTML header.
$page_title = 'View An Order';
include_once ('../includes/header.html');

require_once ('../../admin_mysql_connect.php'); // Connect to the database.

// Retrieve all of the information for the prints in the cart.
$query = "SELECT * FROM customers, orders WHERE customers.customer_id = orders.customer_id AND orders.order_id = {$_GET['oid']}";
$result = mysql_query ($query);
$row = mysql_fetch_array ($result, MYSQL_ASSOC);

$c = unserialize (stripslashes($row['cart']));
echo '<pre>';
print_r ($c);
print_r ($row);
echo '</pre>';
mysql_close(); // Close the database connection.

include_once ('../includes/footer.html'); // Require the HTML footer.
?>
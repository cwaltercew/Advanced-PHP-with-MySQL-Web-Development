<?php # Script: checkout.php
if($_SERVER['HTTPS']!="on")
 {
    $redirect= "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    header("Location:$redirect");
 }
// This is the first of the checkout pages.

// Set the page title and include the HTML header.
$page_title = 'Checkout';
include_once ('includes/header.html');

require_once ('../mysql_connect.php'); // Connect to the database.

// Retrieve all of the information for the prints in the cart.
$query = 'SELECT * FROM artists, prints WHERE artists.artist_id = prints.artist_id AND prints.print_id IN (';
foreach ($_SESSION['cart'] as $key => $value) {
	$query .= $key . ',';
}
$query = substr ($query, 0, -1) . ') ORDER BY artists.last_name ASC';
$result = mysqli_query($dbc, $query);

// Create a table and a form.
echo '<table border="0" width="90%" cellspacing="3" cellpadding="3" align="center">
<tr>
	<td align="left" width="30%"><b>Artist</b></td>
	<td align="left" width="30%"><b>Print Name</b></td>
	<td align="right" width="10%"><b>Price</b></td>
	<td align="center" width="10%"><b>Qty</b></td>
	<td align="right" width="10%"><b>Total Price</b></td>
</tr>
<form action="confirm.php" method="post">';

// Print each item.
$total = 0; // Total cost of the order.
while ($row = mysqli_fetch_assoc($result)) {
	
	// Calculate the total and sub-totals.
	$sub_total = $_SESSION['cart'][$row['print_id']] * $row['price'];
	$total += $sub_total;
	
	// Print the row.
	echo "	<tr>
	<td align=\"left\">{$row['first_name']} {$row['middle_name']} {$row['last_name']}</td>
	<td align=\"left\">{$row['print_name']}</td>
	<td align=\"right\">\${$row['price']}</td>
	<td align=\"center\">{$_SESSION['cart'][$row['print_id']]}</td>
	<td align=\"right\">$" . number_format ($sub_total, 2) . "</td>
</tr>\n";
} // End of the WHILE loop.

mysqli_close($dbc); // Close the database connection.

// Print the footer, close the table, and the form.
echo '	<tr>
	<td colspan="4" align="right"><b>Total:<b></td>
	<td align="right">$' . number_format ($total, 2) . '</td>
</tr>
</table>';

// Register the total to the session.
$_SESSION['total'] = $total;

// Display the form.
?>
	<p>Please log-in to complete your order:<br />
	Username: <input type="text" name="username" size="20" maxsize="20" /><br />
	Password: <input type="password" name="password" size="20" maxsize="20" /><br />
	<input type="submit" name="submit" value="Log-in" /></form><br /><br />
	New users: click <a href="register.php">here</a> to register.</p>
	
<?php
include_once ('includes/footer.html'); // Require the HTML footer.
?>
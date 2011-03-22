<?php
  // Adv.PHP MySQL exam 2 - Fall 2010 - problem 4 (15 pts.)
require "exam2p4db.inc.php";

if (!($connection = @ mysqli_connect($hostname, $username, $password)))
   die("Could not connect to database");

// Remove special characters from the input
// You should check that the mysqliclean() function (in exam2p3db.inc.php)
// escapes user input adequately.
$status = mysqliclean($connection, $_GET, "status", 1);

switch ($status)
{
  case "T":
    $phonebook_id = mysqliclean($connection, $_GET, "phonebook_id", 5);

    if (!empty($phonebook_id))
    {
      if (! mysqli_select_db($connection, $databasename))
         showerror($connection);

     // Problem 4: modify query to use "prepare" syntax
      $query = "SELECT * FROM phonebook WHERE 
                phonebook_id = {$phonebook_id}";

      if (!($result = @mysqli_query($connection, $query)))
        showerror($connection);

      $row = @ mysqli_fetch_array($result);
      // filter data for HTML and PHP tags before displaying it

      echo '<html>';
      echo '<head>';
      echo '<title>Phonebook Entry Receipt</title>';
      echo '</head>';
      echo '<body>';
      echo '<h1>Added a Phonebook Entry</h1>';
      echo '<table>';
      echo '<tr>';
      echo '<td>Surname:';
      echo "<td>{$row['surname']}";
      echo '</tr>';
      echo '<tr>';
      echo '<td>First name:';
      echo "<td>{$row['firstname']}";
      echo '</tr>';
      echo '<tr>';
      echo '<td>Phone number:';
      echo "<td>{$row['phone']}";
      echo '</tr>';
      echo '</table>';
      break;
    }

  case "F":
    echo '<h1>A database error occurred.</h1>';
    break;

  default:
    echo '<h1>You arrived here unexpectedly.</h1>';
    break;
}
echo '</body>';
echo '</html>';
?>

<!DOCTYPE HTML PUBLIC
                 "-//W3C//DTD HTML 4.01 Transitional//EN"
                 "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>Adv.PHP MySQL exam 2 - Fall 2010 - problem 2</title>
</head>
<body>
 <h2 align="center">Adv.PHP MySQL exam 2 - Fall 2010 - problem 2 (10 pts.)</h2>
 <pre>
<?php
  // This script contains the PHP code to connect to the winestore
  // database and store data from the wine table in several arrays.
  // You are to modify the function that displays the wines so that all
  // columns of the "wines" table are displayed.
  //
  // Task: Modify the include file to use your MySQL user and password.
  //       Add code to the "wineryDisplay" function so it will display all
  //       the wines for one winery and all columns of the "wines" table.
  //       The ID of the winery will be in the $inpWinery input parameter.
  //       Follow the directions in-line in the "wineryDisplay" function.
  //
  // Student Name:
  // Date of Exam: December 2010
  //
  // Submit your finished scripts (both files) using the
  // Blackboard project submission procedure
  //
  require 'exam2p2db.inc.php';
  
  // Select the wines and store data in arrays
  function wineSelect($result)
  {

     // declare the arrays to hold the columns of the wine table
     global $wineID;
     $wineID = array();
     global $wineName;
     $wineName = array();
     global $wineType;
     $wineType = array();
     global $wineYear;
     $wineYear = array();
     global $wineryID;
     $wineryID = array();
     global $wineDesc;  
     $wineDesc = array();
     // and an index variable to hold the number of rows
     global $rowCtr;
     $rowCtr = 0;
     
     // Until there are no rows in the result set, fetch a row into 
     // the $row array and ...
     while ($row = $result->fetch_row())     {
       $rowCtr++;
       // ... and save each column in that row to an
       // array element.
       $wineID[$rowCtr] = $row[0];
       $wineName[$rowCtr] = $row[1];
       $wineType[$rowCtr] = $row[2];
       $wineYear[$rowCtr] = $row[3];
       $wineryID[$rowCtr] = $row[4];
       $wineDesc[$rowCtr] = $row[5]; 
     }
  }

  function wineryDisplay($inpWinery, &$rowCtr, &$wineID, &$wineName, 
                         &$wineType, &$wineYear, &$wineryID, &$wineDesc)
  {
     // Note that even though the variables (other than $inpWinery) are global
     // they must be passed as parameters to the function.
     
     // display a header
     echo '<h1 align="center">Wines by Winery</h1>';

     // Start a table, with column headers
     echo '<table width="990" border="1" align="center" cellpadding="2" cellspacing="0" bgcolor="#CCCCCC"><tr>';
     echo "<th>Wine ID</th>";
     echo "<th>Wine Name</th>";
     echo "<th>Type</th>";
     echo "<th>Year</th>";
     echo "<th>Winery ID</th>";
     echo "<th>Description</th>";
     echo "</tr>";

     // For each row in the arrays, this should be a for loop;
     // filter output to the browser to be sure no HTML tags are passed
     // the range will be elements 1 through $rowCtr for each array
     for ($i = 0; $i<$rowCtr; $i++) {
       // test for the winery ID equal to $inpWinery 
       if ($wineryID[$i] == $inpWinery) {
         // ... start a TABLE row ...
         echo "<tr>";
         // ... and print out each of the columns in that row as a
         // separate TD (Table Data).
         // Here is what a print statement for the Wine ID might 
         // look like, assuming your loop control variable is $i
         echo "<td> {$wineID[$i]} </td>";
         // You must add print or echo statements for the other 5 columns
         // Make sure they are in the same order as in the header!
         echo "<td> {$wineName[$i]} </td>";
         echo "<td> {$wineType[$i]} </td>";
         echo "<td> {$wineYear[$i]} </td>";
         echo "<td> {$wineryID[$i]} </td>";
         echo "<td> {$wineDesc[$i]} </td>";
         // Finish the row
         echo "</tr>";
       }
     }
     // Then, finish the table
     echo "</table>";
  }

  // create the query string to select all wines
  // In this case there are no bind variables!
  $query = "SELECT * FROM wine";

  // Connect to the MySQL server and the winestore schema
   @ $db = new mysqli($hostname, $username, $password, $databasename);
   if (mysqli_connect_errno()) {
     echo 'Error: Could not connect to the database winestore at this time.<br>';
     exit;
   }

  // Run the query on the connection
   $result = $db->query($query);
   
  // Get the result set
  wineSelect($result);
  // Then display wines with a description
  // The winery ID is hard-coded. Try some different ones to test your code
  wineryDisplay(33, $rowCtr, $wineID, $wineName, $wineType,
                $wineYear, $wineryID, $wineDesc);
?>
  </pre>
 </body>
</html>
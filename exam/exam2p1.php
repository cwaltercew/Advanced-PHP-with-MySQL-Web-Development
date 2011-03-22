<html>
 <head>
  <title>Adv.PHP MySQL exam 2 - Fall 2010 - problem 1</title>
 </head>
 <body>
  <h2 align="center">Adv.PHP MySQL exam 2 - Fall 2010 - problem 1 (10 pts.)</h2>
<?php
  // This script contains the PHP code to initialize 4 variables,
  // three of which are arrays. You will test the exception handling
  // of a function named "average" in the include file "exam2p1func.inc.php"
  // using the 4 variables.
  //
  // Task: Add a directive to include the file "exam2p1func.inc.php"
  //       as a required include file. Then write a series of four 
  //       try...catch blocks that each call the "average" function 
  //       with a different variable. The try part of each block
  //       should print the value returned by the average function,
  //       if no exception occurs. The catch part of each block 
  //       should print the string returned by the "formatException" 
  //       function from the exam2p1func.inc.php file.
  //
  // Hint: Be sure to save the exam2p1func.inc.php file to the same 
  //       directory you save this file to.
  //
  // Student Name: 
  // Date of Exam: December 2010
  //
  // Submit your finished scripts (both files, even if only 1 was modified)
  // using the Blackboard project submission procedure
  //
  // place the file inclusion directive here:
    
  // Variables for testing the average() function
  require_once('exam2p1func.inc.php');
  $myArray = array(10, 15, 17, 23, 9, 11, 13);
  $myString = "I am not an array";
  $emptyArray = array();
  $badArray = array(1, 2.2, 3.25, "four", 5.0, 66);
  
  // place try...catch block 1 here:
  try {
      echo average($myArray) . '<br>';
  } catch (Exception $e) {
      echo formatException($e) . '<br>';
  }
  
  // place try...catch block 2 here:
  try {
      echo average($myString) . '<br>';
  } catch (Exception $e) {
      echo formatException($e) . '<br>';
  }
  
  // place try...catch block 3 here:
  try {
      echo average($emptyArray) . '<br>';
  } catch (Exception $e) {
      echo formatException($e) . '<br>';
  }
  
  // place try...catch block 4 here:
  try {
      echo average($badArray) . '<br>';
  } catch (Exception $e) {
      echo formatException($e) . '<br>';
  }
  
  // do not delete the end-of-PHP tag below
?>
 </body>
</html>
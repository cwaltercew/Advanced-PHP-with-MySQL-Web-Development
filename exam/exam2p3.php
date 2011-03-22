<?php
  session_start();
  require('exam2p3db.inc.php');
  echo '<html>';
  echo '<head>';
  echo '<title>Adv.PHP MySQL exam 2 - Fall 2010 - problem 3</title>';
  echo '</head>';
  echo '<body>';
  echo '<h2 align="center">Adv.PHP MySQL exam 2 - Fall 2010 - problem 3 (15 pts.)</h2>';

  if (isset($_POST['userid']) && isset($_POST['password']))
  {
    // if the user has just tried to log in
    $userid = $_POST['userid'];
    $userpass = $_POST['password'];
    //
    // This script contains the PHP code to accept a user name and password,
    // and then grant the user access to member-only content if the user
    // is a valid user whose user name and password are in a MySQL table.
    // Note: This problem uses the "mysqli" library of functions.
    //
    // Task: Add code to validate the user name and password against a 
    //       table named "site_users" in the MySQL database "winestore" on
    //       the class server, itins3.matcmadison.edu .
    //       Along with this file, you will need the following files from 
    //       Blackboard:
    //
    //                      exam2p3db.inc.php
    //                      exam2p3logout.php
    //                      exam2p3members_only.php
    //
    // Student Name:
    // Date of Exam: December 2010
    //
    // Submit your finished script (all files even if some are unchanged)
    // using the Blackboard project submission procedure
    //
    // First connect to MySQL on the class server with your user name 
    // and password, and use the "winestore" database (schema).
    // Use the variables from the exam2p3db.inc.php file rather than hardcoding
    // values.
    
    // Give an error message and exit if connection to the database fails
  
    // Put the query to test the username and password in variable $query .
    // But use the "prepare" syntax and bind variables for the DB query!
    // The table to query is site_users in database winestore. Table site_users
    // contains two columns: name & password . There are 3 rows in the table as
    // follows:
    //              name        password
    //              ----        --------
    //              dilbert     dogbert
    //              dogbert     dilbert
    //              catbert     catbert
    //
    // The names are in plain text, but the passwords are encrypted using 
    // the MySQL sha1() function.
    //
    $query = "select count(*) from site_users where username = ? and password = SHA1(?)";
    @$db = new mysqli($hostname, $username, $password, $databasename);
    if (mysqli_connect_errno()) {
      echo 'Error: Could not connect to the database winestore at this time.<br>';
      exit;
    }        
    $stmt = new mysqli_stmt($db, $query) or die('prepare failed');
    $stmt->bind_param("ss", $userid, $userpass);
    $stmt->execute();
    $stmt->bind_result($usersFound);
    $stmt->fetch();
    //echo $userid . ':' .$userpass . ' ' . $usersFound;

    // Fix the query to use "prepare" syntax, run the query and save the
    // result in a variable
  
    // Test the result set to see if the user and password exist in the table

    if ($usersFound == 1)
    {
      // if they are in the database register the user id
      $_SESSION['valid_user'] = $userid;
    }
    // Close the database here, if required by the way you connected
    $db->close();
  }
  if (isset($_SESSION['valid_user']))
  {
    echo 'You are logged in as: '.$_SESSION['valid_user'].' <br />';
    echo '<a href="exam2p3logout.php">Log out</a><br />';
  }
  else
  {
    if (isset($userid))
    {
      // if they've tried and failed to log in
      echo 'Could not log you in.<br />';
    }
    else 
    {
      // they have not tried to log in yet or have logged out
      echo 'You are not logged in.<br />';
    }

    // provide form to log in 
    echo '<form method="post" action="exam2p3.php">';
    echo '<table>';
    echo '<tr><td>Userid:</td>';
    echo '<td><input type="text" name="userid"></td></tr>';
    echo '<tr><td>Password:</td>';
    echo '<td><input type="password" name="password"></td></tr>';
    echo '<tr><td colspan="2" align="center">';
    echo '<input type="submit" value="Log in"></td></tr>';
    echo '</table></form>';
  }
?>
<br />
<a href="exam2p3members_only.php">Members section</a>
</body>
</html>
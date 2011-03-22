<?php
  session_start();
  // Adv.PHP MySQL exam 2 - Fall 2010 - problem 3 (15 pts.)
  // store to test if they *were* logged in
  $old_user = $_SESSION['valid_user'];
  unset($_SESSION['valid_user']);
  session_destroy();
?>
<html>
<body>
<h1>Log out</h1>
<?php 
  if (!empty($old_user))
  {
    echo 'Logged out.<br />';
  }
  else
  {
    // if they weren't logged in but came to this page somehow
    echo 'You were not logged in, and so have not been logged out.<br />'; 
  }
?> 
<a href="exam2p3.php">Back to main page</a>
</body>
</html>

<?php
  session_start();
  // Adv.PHP MySQL exam 2 - Fall 2010 - problem 3 (15 pts.)
  echo '<h1>Members only</h1>';

  // check session variable

  if (isset($_SESSION['valid_user']))
  {
    echo '<p>You are logged in as '.$_SESSION['valid_user'].'</p>';
    echo '<p>This is the special Members only content!</p>';
    echo '<p>Your authentication code appears to be working!</p>';
    echo '<p>Congratulations.</p>';
  }
  else
  {
    echo '<p>You are not logged in.</p>';
    echo '<p>Only logged in members may see <br>';
    echo 'the special Members Only content.</p>';
  }

  echo '<a href="exam2p3.php">Back to main page</a>';
?>

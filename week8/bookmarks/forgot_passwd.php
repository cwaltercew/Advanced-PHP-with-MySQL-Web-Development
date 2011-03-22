<?php
  require_once("bookmark_fns.php");
  do_html_header("Resetting password");

  // creating short variable name
  $username = $_POST['username'];

  try
  {
    $password = reset_password($username);
    notify_password($username, $password);
    echo 'Your new password has been emailed to you.<br />';
  }
  catch (Exception $e)
  {
    echo 'Your password could not be reset - please try again later.';
    echo '<br />Exception: '. $e->getCode(). ': '. $e->getMessage().'<br />'
        .' in '. $e->getFile(). ' on line '. $e->getLine(). '<br />';    
  }
  do_html_url('login.php', 'Login');
  do_html_footer();
?>

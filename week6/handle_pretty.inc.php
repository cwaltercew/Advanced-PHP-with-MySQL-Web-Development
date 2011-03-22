<?php
  // The error handler function
  function myErrorHandler ($errno, $errstr, $errfile, $errline)
  {
    echo "<br /><table bgcolor='#cccccc'><tr><td>
          <p><b>ERROR:</b> $errstr</p>
          <p>Please try again, or contact us and tell us that
          the error occurred in line $errline of file '$errfile'</p>";
    if ($errno == E_USER_ERROR||$errno == E_ERROR)
    {
      echo '<p>This error was fatal, program ending</p>';
      echo '</td></tr></table>';
      //close open resources, include page footer, etc
      exit;
    }
    echo '</td></tr></table>';
  }
?>



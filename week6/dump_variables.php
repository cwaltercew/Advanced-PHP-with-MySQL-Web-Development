<?php
  // these lines format the output as HTML comments
  // and call dump_array repeatedly

  echo "\n<!-- BEGIN VARIABLE DUMP -->\n\n";

  echo "<!-- BEGIN GET VARS -->\n";
  echo '<!-- '.dump_array($_GET)." -->\n";

  echo "<!-- BEGIN POST VARS -->\n";
  echo '<!-- '.dump_array($_POST)." -->\n";

  echo "<!-- BEGIN SESSION VARS -->\n";
  echo '<!-- '.dump_array($_SESSION)." -->\n";

  echo "<!-- BEGIN COOKIE VARS -->\n";
  echo '<!-- '.dump_array($_COOKIE)." -->\n";

  echo "\n<!-- END VARIABLE DUMP -->\n";

  // dump_array() uses the builtin print_r
  // and escapes out any HTML end comments

  function dump_array($array)
  {
    $output = print_r($array, true);
    $output = str_replace('-->', '-- >', $output);
    return $output;
  }
?>

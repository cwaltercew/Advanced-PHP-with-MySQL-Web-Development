<?php
function backTrace($context)
{
   // Get a backtrace of the function calls
   $trace = debug_backtrace();

   $calls = "\nBacktrace:";

   // Start at 2 -- ignore this function (0) and the customHandler() (1)
   for($x=2; $x < count($trace); $x++)
   {
     $callNo = $x - 2;
     $calls .= "\n  {$callNo}: {$trace[$x]["function"]} ";
     $calls .= "(line {$trace[$x]["line"]} in {$trace[$x]["file"]})";
   }

   $calls .= "\nVariables in {$trace[2]["function"]} ():";

   // Use the $context to get variable information for the function
   // with the error
   foreach($context as $name => $value)
   {
     if (!empty($value))
       $calls .= "\n  {$name} is {$value}";
     else
       $calls .= "\n  {$name} is NULL";
   }
   return ($calls);
}

function customHandler($number, $string, $file, $line, $context)
{
  $error = "";

  switch ($number)
  {
     case E_WARNING:
       $error .= "\nE_WARNING on line {$line} in {$file}.\n";
       break;
     case E_NOTICE:
       $error .= "\nE_NOTICE on line {$line} in {$file}.\n";
       break;
     default:
       $error .= "UNHANDLED ERROR on line {$line} in {$file}.\n";
  }
  $error .= "Error: \"{$string}\" (error #{$number}).";
  $error .= backTrace($context);
  $error .= "\nClient IP: {$_SERVER["REMOTE_ADDR"]}";

  $prepend = "\n[PHP Error " . date("YmdHis") . "]";
  $error = ereg_replace("\n", $prepend, $error);

  // Output the error as pre-formatted text
  print "<pre>{$error}</pre>";
  // Log to a user-defined filename
  // error_log($error, 3, "/home/hugh/php_error_log");

}
?>

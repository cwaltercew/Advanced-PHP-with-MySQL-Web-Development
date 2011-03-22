<?php
  // Adv.PHP MySQL exam 2 - Fall 2010 - problem 1
  // This include file contains two functions you will use
  // in your problem 1 script.
  //
  function formatException(Exception $e)
  {
    return "Error {$e->getCode()}: {$e->getMessage()} " .
          "(line: {$e->getline()} of {$e->getfile()})";
  }
  
  function average($numArray) {
    if (! is_array($numArray))
      throw new Exception("Input parameter not an array", 10001);
        
    $total = 0;
    $itemCount = count($numArray);

    if ($itemCount == 0)
      throw new Exception("Number of items to average = 0", 10002);

    foreach ($numArray as $i) {
      if (is_int($i) || is_float($i))
        $total += $i;
      else
        throw new Exception("Array element not numeric", 10003);
    }
    return $total / $itemCount;
  }
?>

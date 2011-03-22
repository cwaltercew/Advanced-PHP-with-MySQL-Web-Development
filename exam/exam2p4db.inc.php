<?php
  // Adv.PHP MySQL exam 2 - Fall 2010 - problem 4 (15 pts.)
  // Use this file with file exam2p3.php

   $hostname = "itins3.matcmadison.edu";
   $databasename = "nstier";
   $username = "nstier";
   $password = "s2633583";


   function showerror($dbconnect)
   {
      die("Error " . mysqli_errno($dbconnect) . " : " . mysqli_error($dbconnect));
   }

   function mysqliclean($dbconnect, $array, $index, $maxlength)
   {
     if (isset($array["{$index}"]))
     {
        $input = substr($array["{$index}"], 0, $maxlength);
        $input = mysqli_real_escape_string($dbconnect, $input);
        return ($input);
     }
     return NULL;
   }

   function shellclean($array, $index, $maxlength)
   {
     if (isset($array["{$index}"]))
     {
       $input = substr($array["{$index}"], 0, $maxlength);
       $input = EscapeShellArg($input);
       return ($input);
     }
     return NULL;
   }
?>

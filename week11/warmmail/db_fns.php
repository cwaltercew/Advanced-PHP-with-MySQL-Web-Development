<?php

function db_connect()
{
   $result = new mysqli('localhost', 'mail', 'mail', 'mail'); 
   if (!$result)
      return false;
   return $result;
}

?>

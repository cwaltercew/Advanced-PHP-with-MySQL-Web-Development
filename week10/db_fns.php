<?php

function db_connect()
{
   $dsn = "mysql:dbname={book_sc};host={localhost}";
   $result = new PDO($dsn, 'djefferson', '');
   
   if (!$result)
      return false;
   return $result;
}

function db_result_to_array($result)
{
   $res_array = array();

   for ($count=0; $row = $result->fetch(PDO::FETCH_ASSOC); $count++)
     $res_array[$count] = $row;

   return $res_array;
}

?>

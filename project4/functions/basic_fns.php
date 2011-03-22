<?php
// I have combined several functions from the original application in this 
// single file. No attempt was made to organize them. The original authors
// had just a single fuction per file! -- D.jefferson

// set the default character set
function charset($charset='',$mimetype='')
{
   if (empty($charset))
   {
      $charset = 'ISO-8859-1';
   }
   if (empty($mimetype))
   {
      $mimetype = 'text/html';
   }

   header("Content-Type: $mimetype; charset=$charset");
}

function array_key_value($arr='', $name='', $default='', $mode='list')
{
   // cast in case $arr is an object
   $arr = (array)$arr;
   if (!is_array($name))
   {
      if (array_key_exists($name,$arr))
         $default = $arr[$name];
      return $default;
   }
   $results = array();
   foreach ($name as $n)
   {
      if (array_key_exists($n,$arr))
      {
         $results[$n] = $arr[$n];
      }
      else
      {
         $results[$n] = $default;
      }
   }
   if ($mode == 'list')
   {
      return array_values($results);
   }
   return $results;
}

// This function will clean up a string to make it suitable for use
// as the value of an HTML <TITLE> tag, removing any HTML tags and
// replacing any HTML entities with their literal character equivalents.

// string make_page_title ([string title])
function make_page_title ($title='')
{
   return reverse_cleanup_text(cleanup_text($title));
}

function reverse_cleanup_text($value)
{
   static $reverse_entities = NULL;
   if ($reverse_entities === NULL)
   {
      $reverse_entities = array_flip(
         get_html_translation_table(HTML_ENTITIES)
      );
   }
   return strtr($value,$reverse_entities);
}

// This function uses the PHP function htmlentities() to convert
// special HTML characters in the first argument (e.g., &,",',<, and >) 
// to the equivalent HTML entities. If the optional second argument is empty,
// any HTML tags in the first argument will be removed. The optional
// third argument lets you specify specific tags to be spared from
// this cleansing. The format for the argument is "<tag1><tag2>".

// string cleanup_text ([string value [, string preserve [, string allowed_tags]]])
function cleanup_text ($value='', $preserve='', $allowed_tags='')
{
   if (empty($preserve)) 
   { 
      $value = strip_tags($value, $allowed_tags);
   }
   $value = stripSlashes($value);
   $value = htmlentities($value);
   return $value;
}

function is_assoc($a)
{
	if (is_object($a))
		return TRUE;
	if (empty($a))
		return FALSE;
	if (!is_array($a))
		return FALSE;
	$k = array_keys($a);
	return ($k !== array_keys($k));
}


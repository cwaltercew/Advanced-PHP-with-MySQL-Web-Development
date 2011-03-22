<?php

// constants
define('DEFAULT_LIMIT', 2);

// global variables

// we'll look for offset in the $_REQUEST superglobal because it 
// could be coming in from either the URL or a form. $_REQUEST is
// a combination of GET, POST, and cookie-based values.

$offset = array_key_value($_REQUEST,'offset',0);

?>

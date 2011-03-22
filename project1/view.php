<?php

/* ===============================
== Revised PHP/MySQL Authentication 
== by Nathan Stier 
== Email: Nathan.Stier@gmail.com
================================*/

require_once('inc/auth.inc.php');
require_once('inc/layout.inc.php');

$data = new data;

$user = $data->authenticateSession($_COOKIE);

/* if user gets here they are authenticated */
/* the stuff below here is my test data */

require('inc/begin.inc.html');
require('inc/nav.inc.html');
require('inc/gooduser.inc.html');
require('inc/end.inc.html');
?>
<?php

/* ===============================
== Revised PHP/MySQL Authentication 
== by Nathan Stier
== Email: Nathan.Stier@gmail.com
================================*/

require_once("inc/auth.inc.php");
$data = new data;
$user = $data->authenticateSession($_COOKIE);
$data->logoutUser($_COOKIE);
?>
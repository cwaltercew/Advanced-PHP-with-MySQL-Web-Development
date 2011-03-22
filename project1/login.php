<?php

/* ===============================
== Revised PHP/MySQL Authentication 
== by Nathan Stier
== Email: Nathan.Stier@gmail.com
================================*/

session_start();
require_once("inc/auth.inc.php");
require_once("inc/layout.inc.php");

alreadyLogged($_COOKIE);
cleanArray($_POST);
extract($_POST);

$data = new data;

if($token === $_SESSION['TOKEN']){
  $userId = $data->authenticateUser($user, $pass);
  if($userId === 0) {
    $token = md5(uniqid(rand(), TRUE));
    $_SESSION['TOKEN'] = $token;
    require('inc/begin.inc.html');
    require('inc/loginbox.inc.php');
  } else {
    session_regenerate_id();
    $data->setCookie($user_data, $rem, session_id(), $user);
    header("location: index.php");
  }
} else {
  $token = md5(uniqid(rand(), TRUE));
  $_SESSION['TOKEN'] = $token;
  require('inc/begin.inc.html');
  require('inc/loginbox.inc.php');
}
?>
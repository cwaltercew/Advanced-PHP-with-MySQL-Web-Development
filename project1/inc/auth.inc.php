<?php

/* ===============================
== Revised PHP/MySQL Authentication 
== by Nathan Stier 
== Email: Nathan.Stier@gmail.com
================================*/

class data {
  
  //Authenticates the user and returns their userid or zero if not authenticated
  public static function authenticateUser($user, $pass)
  {
    $userId = 0;
        
    require('db.cfg.inc.php');
    
    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if(mysqli_errno($db)) {
      echo mysqli_error($db);
      exit();
    }
    
    $sql = "SELECT user_id FROM users WHERE user_name=? AND user_pass=sha1(?)";

    $stmt = $db->prepare($sql);
    
    $stmt->bind_param("ss", $user, $pass);
    
    $stmt->execute();
    
    if($stmt->field_count !== 0) {
    
      $stmt->bind_result($userId);
      
      $stmt->fetch();

    }
    
    $stmt->close();
    mysqli_close($db);
    return $userId; 
  }
  
  //Returns the user id for the session of forwards to the login page
  function authenticateSession($cookie)
  {
    
    require('db.cfg.inc.php');
      
    $user = array();
    $session = $cookie['SESSION'];
  
    
    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if(mysqli_errno($db)) {
      echo mysqli_error($db);
      exit();
    }
    
    $sql = 'SELECT user_id, user_name FROM sessions WHERE session=?';

    $stmt = $db->prepare($sql);
    
    $stmt->bind_param("s", $session);
    
    $stmt->execute();
    
    
    if($stmt->field_count === 0) {
      header('location: header.php');
    } else {
      $stmt->bind_result($userId, $userName);
      $stmt->fetch();
      $user['user_id']   = $userId;
      $user['user_name'] = $userName;
    }
    
    $stmt->close();
    mysqli_close($db);
    
    return $user;
  }
  
  //Saves the current session id to a cookie and then the database with user data
  function setCookie($userId, $rem, $session, $userName) {

    if($rem == 1) {
      setcookie('SESSION', $session, time() + 186400);
    } else {
      setcookie('SESSION', $session);
    }

    require('db.cfg.inc.php');
    
    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if(mysqli_errno($db)) {
      echo mysqli_error($db);
    }
    
    $sqlSelect = "SELECT * FROM sessions WHERE user_id = ? AND user_name = ?";
    $sqlInsert = "INSERT INTO sessions (session, user_id, user_name) VALUES (?, ?, ?)";
    $sqlUpdate = "UPDATE sessions SET session = ? WHERE user_id = ? AND user_name = ?";
    
    $stmt = new mysqli_stmt($db, $sqlSelect);
    
    $stmt->bind_param("ss", $userID, $userName);
    
    $stmt->execute();
    
    if($stmt->field_count === 0) {
      $stmt->close();
      $stmt = $db->prepare($sqlInsert);
    } else {
      $stmt->close();  
      $stmt = $db->prepare($sqlUpdate);
    }
    
    $stmt->bind_param("sss", $session, $userId, $userName);

    $stmt->execute();
    
    $stmt->close();
    
    mysqli_close($db);
    
  }
  
  //Removes session and user data from the DB
  function logoutUser($cookie)
  {
    require('db.cfg.inc.php');
    $session = $cookie['SESSION'];
    
    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if(mysqli_errno($db)) {
      echo mysqli_error($db);
    }
      
    $sql = 'DELETE FROM sessions WHERE session = ?';
    
    $stmt = $db->prepare($sql);
    
    $stmt->bind_param("s", $session);

    $stmt->execute();
    
    $stmt->close();
    
    mysqli_close($db);
    
    setcookie('SESSION', '', 0);
    header("location: login.php");
  }
}

function generateToken() {

    $token = md5(uniqid(rand(), TRUE));
    
    $_SESSION['TOKEN'] = $token;
    
    echo $token;
    
    return $token;
}

function alreadyLogged($cookie) {
  if(isset($cookie['SESSION'])) {
    header("location: index.php");
  }
}

function cleanArray($array){
    
    foreach($array as $index => $string) {
      $array[$index] = addslashes(strip_tags($String));
    }
    
    return $array;
}
?>
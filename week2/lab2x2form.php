<?php

    session_start();

    $token              = md5(uniqid(rand(), TRUE));
    $_SESSION['token']  = $token

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Lab 2.2</title>
</head>
<body>
    <form action="lab2x2login.php" method="post">
        
        <label for="username">Username: </label>
        <input type="text" id="username" name="username">
        
        <label for="username">Password: </label>
        <input type="password" id="password" name="password">
        
        <input type="hidden" name="token" value="<?php echo $token; ?>">
        
        <input type="submit" value="Submit">
        
    </form>
</body>
</html>

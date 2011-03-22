<?php session_start();?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Lab 2.2</title>
</head>
<body>

<?php if (!isset($_POST)) : ?>

    <h1>Err 23: Parameters unset!</h1>
    
<?php elseif(!isset($_SESSION['token'])) : ?>

    <h1>Err 5: Token not found!
    
<?php elseif($_POST['token'] != $_SESSION['token']) : ?>
    
    <h1>Err 7: Token mismatch</h1>
    
<?php else : ?>

    <ul>
        <li><?php echo $_POST['username']; ?></li>
        <li><?php echo $_POST['password']; ?></li>
        <li><?php echo $_POST['token']; ?></li>


<?php endif; ?>

</body>
</html>


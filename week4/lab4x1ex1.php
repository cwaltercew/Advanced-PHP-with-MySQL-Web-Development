<!DOCTYPE HTML>
<html>
<head>
    <title>Lab 4.1 ex 1</title>
</head>
<body>
    
<?php if (!isset($_POST['month'])) :?>

    <form action="lab4x1ex1.php" method="post">
        <label>Birthday(MM/DD/YYYY):</label>
        <input type="text" 
               name="month" 
               maxlength="2">
        <input type="text" 
               name="day" 
               maxlength="2">
        <input type="text" 
               name="year"
               maxlength="4">
        <input type="submit" value="Submit">
    </form>
    
<?php else : ?>

    <?php
        $SECONDS_PER_YEAR    = 31557600;
        
        $month              = $_POST['month'];
        $day                = $_POST['day'];
        $year               = $_POST['year'];
        $birthday           = mktime(0, 0, 0, $month, $day, $year);
        $ageInSeconds       = time() - $birthday;
        $age                = floor($ageInSeconds / $SECONDS_PER_YEAR);
    ?>
    
    <h1>Your birthday is: <?php echo "$month/$day/$year"; ?></h1>
    <h2>We calculate your age as: <?php echo $age ?> </h2>

<?php endif; ?>

</body>
</html>

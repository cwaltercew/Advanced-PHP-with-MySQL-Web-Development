<!DOCTYPE HTML>
<html>
<head>
    <title>Lab 4.1 ex 1</title>
</head>
<body>

    <?php
        $day = 07;
        $month = 08;
        $year = 1972;
        
        $bday = date("c", mktime(0,0,0, $month, $day, $year));
        
        $db = mysqli_connect('localhost', 'root', '');
        $res = mysqli_query($db, "select datediff(now(), '$bday')");
        $age = mysqli_fetch_array($res);
        $age = floor($age[0]/365.25);
    ?>
    
    <h1>Your birthday is: <?php echo "$month/$day/$year"; ?></h1>
    <h2>We calculate your age as: <?php echo $age ?> </h2>

</body>
</html>

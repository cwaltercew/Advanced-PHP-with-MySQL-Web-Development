<?php
    
    extract($_POST);
    
    if(mail($to, $subject, $message, "From: Me@nathanstier.com")){
        $success = "<p>Mail Sent</p>";
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Lab 11.1</title>
    </head>
    <body>
        <?php echo $success; ?>
        <form action="lab11x1.php" method="post">
            <label>To:<input name="to"></label><br>
            <label>Subject:<input name="subject"></label><br>
            <label>Body:<br>
                <textarea rows="8" cols="20" name="message"></textarea>
            </label>
            <br>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>
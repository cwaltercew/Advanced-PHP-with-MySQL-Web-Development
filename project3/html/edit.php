<?php

    require_once('includes/customer.php');
    $page_title = 'Edit Billing Information';

    if (!isset($_POST['write'])) {

        //Begin Displaying the Page
        include_once ('includes/header.html');
        
        //Create customer object
        $customer = new Customer($_SESSION['cid']);
        
        //Assign variable to check correct radio button
        $cardType = $customer->getCardType();
        if ($cardType == 'V') {
            $vCheck = 'checked';
        } elseif ($cardType == 'A') {
            $aCheck = 'checked';
        } elseif ($cardType == 'M') {
            $mCheck = 'checked';
        } elseif ($cardType == 'D') {
            $dCheck = 'checked';
        }
        
        // Create a form.
?>
    <form action="edit.php" method="post">
            <h3>Edit You Billing Info:</h3>
            <label for="firstname">First Name: </label><input type="text" id="firstname" name="firstName" value="<?php echo  $customer->getFirstName(); ?>"><br>
            <label for="lastname">Last Name: </label><input type="text" id="lastname" name="lastName" value="<?php echo $customer->getLastName(); ?>"><br>
            <label for="address">Address: </label><input type="text" id="address" name="address" value="<?php echo $customer->getAddress(); ?>"><br>
            <label for="city">City: </label><input type="text" id="city" name="city" value="<?php echo $customer->getCity(); ?>"><br>
            <label for="state">State: </label><input type="text" id="state" name="state" value="<?php echo $customer->getState(); ?>"><br>
            <label for="zip">Zip: </label><input type="text" id="zip" name="zip" value="<?php echo $customer->getZip(); ?>"><br>
            <label for="email">Email: </label><input type="text" id="email" name="email" value="<?php echo $customer->getEmail(); ?>"><br>
            <input type="radio" name="cardType" id="visa" value="V" <?php echo $vCheck; ?>><label for="visa">Visa</label><br>
            <input type="radio" name="cardType" id="amex" value="A" <?php echo $aCheck; ?>><label for="amex">American Express</label><br>
            <input type="radio" name="cardType" id="mastercard" value="M" <?php echo $mCheck; ?>><label for="mastercard">MasterCard</label><br>
            <input type="radio" name="cardType" id="discover" value="D" <?php echo $dCheck; ?>><label for="discover">Discover</label><br>
            <label for="cardnumber">Card Number: </label><input type="text" id="cardnumber" name="cardNumber" value="<?php echo $customer->getCardNumber(); ?>"><br>
            <input type="hidden" name="write" value="true">
            <input type="submit" name="submit" value="Change Billing Info" />
    </form>
<?php
        include_once ('includes/footer.html'); // Require the HTML footer.
    } else {
        
        session_start();
        extract($_POST);
        $customer = new Customer($_SESSION['cid']);
        $customer->setFirstName($firstName);
        $customer->setLastName($lastName);
        $customer->setAddress($address);
        $customer->setCity($city);
        $customer->setState($state);
        $customer->setZip($zip);
        $customer->setEmail($email);
        $customer->setCardType($cardType);
        $customer->setCardNumber($cardNumber);
        header('location: confirm.php');

    }
?>
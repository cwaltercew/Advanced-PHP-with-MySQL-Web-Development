<?
//If you use this use ssl
if($_SERVER['HTTPS']!="on")
{
    $redirect= "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    header("Location:$redirect");
}

class Customer {
    
    private $myDB;
    private $myId;

    //Constructors and Destructor
    public function __construct()
    {
        $a = func_get_args();
        $i = func_num_args();
        if (method_exists($this,$f='__construct'.$i)) {
            call_user_func_array(array($this,$f),$a);
        }
    } 
    
    public function __construct1($id) {
        $this->myId = $id;
        $this->myDB = new mysqli('localhost','printsdb','project3','printsdb');
        
    }
    
    public function __construct2($username, $password) {

        $this->myDB = new mysqli('localhost','printsdb','project3','printsdb');
        
        $query = "SELECT customer_id FROM customers WHERE username = ? AND password = SHA1(?)";
        
        $stmt = mysqli_prepare($this->myDB, $query);
        
        $stmt->bind_param("ss", $username, $password);
        
        $stmt->execute();
        $stmt->bind_result($this->myId);
        $stmt->fetch();
           
        $stmt->close();
        
        if(!isset($this->myId)) {
            $this->myId = 0;   
        }
    }
    
    public function __destruct(){
        $this->myDB->close();
    }
    
    //gets
    public function getid() {
        return $this->myId;
    }
    
    public function getFirstName() {
        $query = "SELECT first_name FROM customers WHERE customer_id = ?";
        
        $stmt = mysqli_prepare($this->myDB, $query);
        
        $stmt->bind_param('i', $this->myId);
        
        $stmt->execute();
        $stmt->bind_result($firstName);
        $stmt->fetch();
           
        $stmt->close();
        
        return $firstName;
    }
    
    public function getLastName() {
        $query = "SELECT last_name FROM customers WHERE customer_id = ?";
        
        $stmt = mysqli_prepare($this->myDB, $query);
        
        $stmt->bind_param('i', $this->myId);
        
        $stmt->execute();
        $stmt->bind_result($lastName);
        $stmt->fetch();
           
        $stmt->close();
        
        return $lastName;
    }
    
    public function getEmail() {
        $query = "SELECT email FROM customers WHERE customer_id = ?";
        
        $stmt = mysqli_prepare($this->myDB, $query);
        
        $stmt->bind_param('i', $this->myId);
        
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->fetch();
           
        $stmt->close();
        
        return $email;
    }
    
    public function getAddress() {
        $query = "SELECT address FROM customers WHERE customer_id = ?";
        
        $stmt = mysqli_prepare($this->myDB, $query);
        
        $stmt->bind_param('i', $this->myId);
        
        $stmt->execute();
        $stmt->bind_result($address);
        $stmt->fetch();
           
        $stmt->close();
        
        return $address;
    }
    
    public function getCity() {
        $query = "SELECT city FROM customers WHERE customer_id = ?";
        
        $stmt = mysqli_prepare($this->myDB, $query);
        
        $stmt->bind_param('i', $this->myId);
        
        $stmt->execute();
        $stmt->bind_result($city);
        $stmt->fetch();
           
        $stmt->close();
        
        return $city;
    }
    
    public function getState() {
        $query = "SELECT State FROM customers WHERE customer_id = ?";
        
        $stmt = mysqli_prepare($this->myDB, $query);
        
        $stmt->bind_param('i', $this->myId);
        
        $stmt->execute();
        $stmt->bind_result($state);
        $stmt->fetch();
           
        $stmt->close();
        
        return $state;
    }
    
    public function getZip() {
        $query = "SELECT zipcode FROM customers WHERE customer_id = ?";
        
        $stmt = mysqli_prepare($this->myDB, $query);
        
        $stmt->bind_param('i', $this->myId);
        
        $stmt->execute();
        $stmt->bind_result($zip);
        $stmt->fetch();
           
        $stmt->close();
        
        return $zip;
    }
    
    public function getCardType() {        
        $query = "SELECT card_type FROM customers WHERE customer_id = ?";
        
        $stmt = mysqli_prepare($this->myDB, $query);
        
        $stmt->bind_param('i', $this->myId);
        
        $stmt->execute();
        $stmt->bind_result($cardType);
        $stmt->fetch();
           
        $stmt->close();
        
        return $cardType;
    }
    
    public function getCardNumber() {
        $query = "SELECT card_number FROM customers WHERE customer_id = ?";
        
        $stmt = mysqli_prepare($this->myDB, $query);
        
        $stmt->bind_param('i', $this->myId);
        
        $stmt->execute();
        $stmt->bind_result($cardNumber);
        $stmt->fetch();
           
        $stmt->close();
        
        return $cardNumber;
    }
    
    //Sets
    public function setFirstName($firstName) {
        
        $query = 'UPDATE customers SET first_name = ? WHERE customer_id = ?';
        
        $stmt = new mysqli_stmt($this->myDB, $query);
        
        $stmt->bind_param("si", $firstName, $this->myId);
        
        $stmt->execute();
        
        $stmt->close();
    }
    
    public function setLastName($lastName) {
        
        $query = 'UPDATE customers SET last_name = ? WHERE customer_id = ?';
        
        $stmt = new mysqli_stmt($this->myDB, $query);
        
        $stmt->bind_param("si", $lastName, $this->myId);
        
        $stmt->execute();
        
        $stmt->close();   
    }
    
    public function setAddress($address) {
        
        $query = 'UPDATE customers SET address = ? WHERE customer_id = ?';
        
        $stmt = new mysqli_stmt($this->myDB, $query);
        
        $stmt->bind_param("si", $address, $this->myId);
        
        $stmt->execute();
        
        $stmt->close();
    }
    
    public function setCity($city) {
        
        $query = 'UPDATE customers SET city = ? WHERE customer_id = ?';
        
        $stmt = new mysqli_stmt($this->myDB, $query);
        
        $stmt->bind_param("si", $city, $this->myId);
        
        $stmt->execute();
        
        $stmt->close();
    }
    
    public function setState($state) {
        
        $query = 'UPDATE customers SET state = ? WHERE customer_id = ?';
        
        $stmt = new mysqli_stmt($this->myDB, $query);
        
        $stmt->bind_param("si", $state, $this->myId);
        
        $stmt->execute();
        
        $stmt->close();
    }
    
    public function setZip($zip) {
        
        $query = 'UPDATE customers SET zipcode = ? WHERE customer_id = ?';
        
        $stmt = new mysqli_stmt($this->myDB, $query);
        
        $stmt->bind_param("si", $zip, $this->myId);
        
        $stmt->execute();
        
        $stmt->close();
    }
    
    public function setEmail($email) {
        
        $query = 'UPDATE customers SET email = ? WHERE customer_id = ?';
        
        $stmt = new mysqli_stmt($this->myDB, $query);
        
        $stmt->bind_param("si", $email, $this->myId);
        
        $stmt->execute();
        
        $stmt->close();
    }
    
    public function setCardType($cardType) {
        
        $query = 'UPDATE customers SET card_type = ? WHERE customer_id = ?';
        
        $stmt = new mysqli_stmt($this->myDB, $query);
        
        $stmt->bind_param("si", $cardType, $this->myId);
        
        $stmt->execute();
        
        $stmt->close();
    }
    
    public function setCardNumber($cardNumber) {
        
        $query = 'UPDATE customers SET card_number = ? WHERE customer_id = ?';
        
        $stmt = new mysqli_stmt($this->myDB, $query);
        
        $stmt->bind_param("si", $cardNumber, $this->myId);
        
        $stmt->execute();
        
        $stmt->close();
    }
    
    public function __toString() {
        
        $cardType = $this->getCardType();
        if ($cardType == 'V') {
            $cardType = 'Visa';
        } elseif ($cardType == 'A') {
            $cardType = 'American Express';
        } elseif ($cardType == 'M') {
            $cardType = 'MasterCard';
        } elseif ($cardType == 'D') {
            $cardType = 'Discover';
        }
        
        $output  = $this->getFirstName() . " " . $this->getLastName() . "<br>";
        $output .= $this->getAddress() . "<br>";
        $output .= $this->getCity() . ", " . $this->getState() . " " . $this->getZip() . "<br>";
        $output .= "Email Address: " . $this->getEmail() . "<br>";
        $output .= $cardType . " Card Number: " . $this->getCardNumber();
        
        return "$output";
    }
    
}

?>
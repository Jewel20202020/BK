<?php
// connnect to database fron php
$host="localhost";
$username="Bukunmi";
$password="beekay2020";
$db_name = "contact_form";

$conn= new mysqli($host, $username, $password, $db_name);

if($conn->connect_error){
    die("connection to database failed:" . $conn->connect_error);
}else {
    if (isset($_POST ['name'])) {
        $name = $_POST['name'];
        // check if name char length is <5
        if (strlen($name) < 5){
            echo "Name too short, please enter yourreal name";
            die();
        }
        $email=$_POST['email'];
        // validate email address
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo"You submitted an invalid email address!";
            die();
        }
        $phone =$_POST['phone'];
        if (strlen($phone) <11){
            echo"You submitted an invalid phone number!";
            die();
        }
    
    
        $message = $_POST ['message'];
        // validate message
        if (strlen($message) < 20){
            echo "Your message is too short";
            die();
        }
        // add message to the database
        $query = "INSERT INTO contact_message (name, email, message, phone) VALUES ('$name', '$email', '$message', '$phone')";
        if ($conn->query($query) === TRUE) {
         $msg_id = $conn-> insert_id;
        }
        // if
        echo"<p> Message received: $message </p>";
        echo "<h4>We will get back to you asap<h4>";
    
    } else{
        // redirect to the form
        header('location: index.php');
    }
}

 
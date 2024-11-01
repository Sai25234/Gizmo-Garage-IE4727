<?php

include 'dbconnect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password']; 
    $password_2 = $_POST['confirmpassword']; 



    if ($password != $password_2){
        echo 'Sorry Passwords do not match';
        exit;
    }
    $password = md5($password);
    $sql = "INSERT INTO Customers (Email, Password) VALUES ('$email', '$password')";
    
    if ($conn->query($sql) === TRUE) {

        echo "Registration successful. <a href='login.html'>Login here</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    $conn->close();

?>

<?php

include 'dbconnect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password']; 
    $password_2 = $_POST['confirmpassword']; 



    $password = md5($password);
    $sql = "INSERT INTO Customers (Email, Password) VALUES ('$email', '$password')";
    
    if ($conn->query($sql) === TRUE) {

        echo "<script>
        alert('Registration Successful');
        window.location.href='login.html';
      </script>";
    }
    
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    $conn->close();
}
?>

<?php
session_start();
include 'dbconnect.php'; 

if (isset($_POST['email']) && isset($_POST['password']))
{
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    
    $sql = "SELECT * FROM Customers WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        $_SESSION['valid_user'] = $email;
        
    } else {
        echo "Invalid email or password.";
    }
}
$conn->close();
if(isset($_SESSION['valid_user'])){
    echo '<p>You are Logged In as '.$_SESSION['valid_user'].'</p>';
    echo '<a href="logout.php">Log Out</a><br>';
    echo '<a href="index.html">Return to Homepage</a>';
}
else 
{
    if (isset($email))
    {
        echo 'Could not Log you In';
    }
    else {
        echo 'You are not logged In'  ;         
    }
    
        echo '<p>Retry</p><br>';
        echo '<a href="login.html">Retry</a>';
        echo '<a href="index.html">Return to Homepage</a>';
    
}
    ?>



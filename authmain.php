<?php
session_start();
include 'dbconnect.php'; 

if (isset($_POST['email']) && isset($_POST['password']))
{
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    
    $sql = "SELECT * FROM Customers WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
       
        if (password_verify($password, $row['password'])) {
            $_SESSION['valid_user'] = $email;
            header("Location: members_only.php");
            exit;
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Invalid email or password.";
    }
}
$conn->close();
?>

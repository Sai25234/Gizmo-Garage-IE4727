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
        $admin = "SELECT * FROM Admins WHERE email = '$email' AND password = '$password'";
        $result = $conn->query($admin);

        if ($result->num_rows > 0) {
        
            $_SESSION['valid_user'] = $email;
            $_SESSION['admin'] = true;
            
        } else {
            echo "<script>
                    alert('Invalid username or password.');
                    window.location.href='login.html';
                </script>";
            }
    }
}
$conn->close();

if(isset($_SESSION['valid_user'])){
    echo "<script>
                alert('Login Successful');
                window.location.href='index.php';
              </script>";
}
    ?>



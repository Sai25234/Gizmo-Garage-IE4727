<?php
session_start();
include 'dbconnect.php';

if (isset($_GET['delete'])) {
    $promotion = $_GET['delete'];
    $delete = "DELETE FROM Promotions WHERE Category = '$promotion'";
    $result = $conn->query($delete);

    $removesales = "UPDATE Products SET SalePrice = NULL WHERE Category = '$promotion'";
    $salesresult = $conn->query($removesales);
    
    if ($result){
        echo "<script>
                alert('Promotion deleted...');
                window.location.href='profile.php';
              </script>";
    } else {
        echo "<script>
                alert('We're losing money!! Delete failed...');
                window.location.href='profile.php';
              </script>";
    }
}
$conn->close();
?>
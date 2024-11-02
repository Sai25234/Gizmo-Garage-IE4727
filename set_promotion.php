<?php 
session_start();
include 'dbconnect.php';
$category = $_POST['category'];
$discount = $_POST['discount']; //between 1 to 100

$add = "INSERT INTO Promotions (category, discount) VALUES ('$category', '$discount')";
$result = $conn->query($add);

if ($result){
    echo "<script>
            alert('Promotion set successfully!');
          </script>";
} else {
    echo "<script>
            alert('Error setting promotion...');
          </script>";
}

$saleprice = "UPDATE Products SET SalePrice = (Price - (Price * $discount / 100)) WHERE Category = '$category'";
$saleresult = $conn->query($saleprice);

if ($result){
    echo "<script>
            alert('Sale prices set successfully!');
            window.location.href='profile.php';
          </script>";
} else {
    echo "<script>
            alert('Error setting sale price...');
            window.location.href='profile.php';
          </script>";
}
$conn->close();
?>
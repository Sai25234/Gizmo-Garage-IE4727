<?php
include 'session.php';

//Uses productID!!!!
if (isset($_GET['item'])) {
    $item = $_GET['item'];
    $index = array_search($item, $_SESSION['cart']['items']);

    if ($index !== false) {
        //remove item and qty from cart
        unset($_SESSION['cart']['items'][$index]);
        unset($_SESSION['cart']['qty'][$item]);
        //refresh array's indexes
        $_SESSION['cart']['items'] = array_values($_SESSION['cart']['items']);
    }
}
//go back to cart.php once done
header('location: cart.php');
exit();
?>
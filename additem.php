<?php
include 'session.php';
//adding item to cart will use buy=product_id
if (isset($_GET['buy'])){
    $item = $_GET['buy'];
    if (in_array($item, $_SESSION['cart']['items'])){
        $_SESSION['cart']['qty'][$item]++;
    } else {
        $_SESSION['cart']['items'][] = $item;
        $_SESSION['cart']['qty'][] = 1;
    }

    //go back to previous page once done
    header('location: '.$_SERVER['HTTP_REFERER']);
    exit();
}
?>
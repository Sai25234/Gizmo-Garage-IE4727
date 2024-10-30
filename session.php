<?php
session_start();
$_SESSION['cart'] = $_SESSION['cart'] ?? array('items' => array(), 'qty' => array());

if (isset($_GET['buy'])){
    $item = $_GET['buy'];
    if (in_array($item, $_SESSION['cart']['items'])){
        $_SESSION['cart']['qty'][$item]++;
    } else {
        $_SESSION['cart']['items'][] = $item;
        $_SESSION['cart']['qty'][] = 1;
    }
    header('location: '.$_SERVER['PHP_SELF'].'?'.SID);
    exit();
}
?>
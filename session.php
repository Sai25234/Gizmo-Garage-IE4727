<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['cart'] = $_SESSION['cart'] ?? array('items' => array(), 'qty' => array());
?>
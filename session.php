<?php
session_start();
$_SESSION['cart'] = $_SESSION['cart'] ?? array('items' => array(), 'qty' => array());
?>
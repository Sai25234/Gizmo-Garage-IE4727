<?php
session_start();
if (!isset($_SESSION['valid_user'])) {
    echo 'Logged In'
    exit;
}
?>


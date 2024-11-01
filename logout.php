<?php
session_start();
$old_user = $_SESSION['valid_user'];
unset($_SESSION['valid_user']);
session_destroy();
echo '<h1>Logged Out</h1>'
echo '<a href="index.html">Return to Homepage</a>'

exit;
?>
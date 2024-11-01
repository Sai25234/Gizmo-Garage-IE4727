<?php
session_start();
$old_user = $_SESSION['valid_user'];
unset($_SESSION['valid_user']);
session_destroy();
echo "<script>
                alert('You are Logged out');
                window.location.href='index.php';
              </script>";

exit;
?>
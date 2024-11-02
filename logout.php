<?php
session_start();
$old_user = $_SESSION['valid_user'];
unset($_SESSION['valid_user']);
unset($_SESSION['admin']);
session_destroy();
echo "<script>
                alert('You have logged out');
                window.location.href='index.php';
              </script>";

exit;
?>
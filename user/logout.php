<?php
session_start();
unset($_SESSION['username']);
if (!isset($_SESSION['username'])) {
    echo 'The username session variable has been removed';
}
$_SESSION = array();
session_destroy();
setcookie(session_name(), '', time()-3600,'/');
header("Location: ../login.php");
exit();
?>
<?php
session_start();
unset($_SESSION['type']);
unset($_SESSION['error']);
header("location: ../login.php");
exit();
?>  
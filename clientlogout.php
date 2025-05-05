<?php
session_start();
session_destroy();
header("Location: clientlogin.php");
exit();
?>

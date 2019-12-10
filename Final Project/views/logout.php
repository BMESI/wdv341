<?php 
session_start();
$_SESSION['validuser'] = 'no';
session_unset();
session_destroy();
header("Location: main.php");

?>

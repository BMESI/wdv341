<?php
session_start();
$_SESSION['validuser'] = 'no';
session_unset();
session_destroy();	
header('Location: ../../UNIT 11 - PHP-SQL Login and Protected Pages/views/login.php'); 


?>
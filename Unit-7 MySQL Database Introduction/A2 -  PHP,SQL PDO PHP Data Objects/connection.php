<?php 
$ServerName = "servername";
$DatabaseName = "database";
$DB_Username = "username";
$DB_Password = "password";

try {
	$Connection = new PDO("mysql:host=$ServerName;dbname=$DatabaseName",$DB_Username,$DB_Password);
	$Connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	echo "Connected...";
}
catch(PDOException $E){
	echo "Connection failed..." .$E->getMessages();
}


?>
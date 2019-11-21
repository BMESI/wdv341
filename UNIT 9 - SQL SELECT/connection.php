<?php 
$ServerName = "localhost";
$DatabaseName = "wdv341";
$DB_Username = "root";
$DB_Password = "";

try {
	$Connection = new PDO("mysql:host=$ServerName;dbname=$DatabaseName",$DB_Username,$DB_Password);
	$Connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	//echo "Connected...";
}
catch(PDOException $E){
	//echo "Connection failed..." .
	$E->getMessage();
}


?>
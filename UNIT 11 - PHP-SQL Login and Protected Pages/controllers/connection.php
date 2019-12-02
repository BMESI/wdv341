<?php 
//ini_set('display_errors', 'true');
$ServerName = "localhost";
$DatabaseName = "benmesinovic_";
$DB_Username = "341";
$DB_Password = "wdv341class";
// benmesinovic_341 

try {
	$Connection = new PDO("mysql:host=$ServerName;dbname=$DatabaseName".$DB_Username,$DatabaseName.$DB_Username,$DB_Password);
	$Connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	//echo "Connected...";
	//$Connection = null;
}
catch(PDOException $E){
	echo "DB Connection failed..." ;//.$E->getMessage();
}

?>
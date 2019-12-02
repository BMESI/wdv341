<?php
if(!isset($_SESSION)){
	session_start();
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

} // end if session set
if ($_SESSION['validuser'] == "yes") {
/*


--Create a PHP page called deleteEvent.php.  
This page is called from the selectEvents.php page.  
It will accept one parameter from $_GET.  
	That should be the record id of the record that you wish to delete.  
--This page will create an SQL DELETE command and remove the requested record from your database table. 

The page should do the following: 

    Update your selectEvents.php page so that the Delete link passes the event_id as a GET parameter.
    Connect to your database using the dbConnect.php.
    Retrieve the record id from $_GET into a PHP variable. 
    Create the SQL DELETE query using the record id.
    Process the SQL query.  
    Redirect back to your eventSelect page.
        If the command fails display an error message to the client. 
        If the command is successful display a Confirmation message to your customer




*/
$DeleteFile =  "../../UNIT 11 - PHP-SQL Login and Protected Pages/controllers/Delete.php";
$Login=  "../../UNIT 11 - PHP-SQL Login and Protected Pages/view/login.php";
$Message = "";
//$FormValidation = "../../UNIT 12 - SQL DELETE/FormValidation.php";
			include $DeleteFile; include $Login;// include $FormValidation;

		$DeleteID = "";
		$IDValid = true;
		$Delete = new Delete();
		if(isset($_GET['event_id']) && $_GET['event_id'] !== ''){
			$DeleteID = $_GET['event_id'];
						$Message = "Event  deleted! Press select to reload the event list.";

			}else{				
			$Message = "Event not deleted! Press select to reload the event list.";

				 ?> 

				<h2> Event deletion failed! CLick link to go back: <a href="login.php">back</a></h2>
<?php
			}
			if ( $Delete->DeleteSingleEvent($DeleteID) ) {
						$Message = "Event  deleted! Press select to reload the event list.";
			// move to main page when done , show message to confirm completion...
			header('Location: login.php?Message='.$Message); 
		

?>
<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Event deletion</title>
	<style>

#displayArea	{
	width:600px;
	border:thin solid black;
	margin: auto auto;
	padding-left: 20px;
}

#displayArea h3	{
	text-align:center;	
	background-color:beige;
}
.error	{
	color:red;
	font-style:italic;	
}
.specialStuff {
	display: none;
}
#event_name, #event_description, #event_presenter{
		border-radius:30px; 	width:500px;position: absolute;left:200px;

}
#full_event_year ,#event_month_number, #event_day_number, #event_minute, #event_hour {
				border-radius:30px; 	width:55px;

}
table, th, td {
  border: 1px solid green;
}
label {
 margin: auto;

}
fieldset{
}
#submitbuttonid{
	background-color:green;
	width:200px;
	border-radius:30px;
}
#resetbuttonid{
	background-color:yellow;
	width:200px;
	border-radius:30px;

}
#selectbuttonid{
	background-color:green;
	width:200px;
	border-radius:30px;
}
#deletebuttonid{
	background-color:red;
	width:200px;
	border-radius:30px;
}
#deletemarkerid{
	width:100px;
}
</style>
<div id="orderArea">
<h3> <?php  ?></h3>
<form name="deleteform" method="GET" action="login.php">

</div>

</body>
</html>

<?php }// end if delete 
else{

	}
}
else{
header('Location: login.php'); 
}
?>
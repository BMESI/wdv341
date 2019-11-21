<?php
$SelectFile =  "../../UNIT 9 - SQL SELECT/Select.php";
if ( file_exists($SelectFile) && is_readable($SelectFile) ) {
    	$DatabaseTable = "";
		if (isset($_POST['selectbutton']) ){
			try{
			include $SelectFile;
			$NewSelect = new Select();
					for ($inta = 0; $inta < sizeof($NewSelect->SelectEvents() ) ; $inta++  ){
									$DatabaseTable .= $NewSelect->SelectEvents()[$inta];
					}// end for loop
			}//end try		
			catch(Exception $Error){
				$DatabaseTable = "Error: " . $Error->getMessage();
			}	
		}// end isset select
		if (isset($_POST['resetbutton']) ){
					$DatabaseTable = "";
		}// ned if isset reset
?>
<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View events</title>
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
	background-color:red;
	width:200px;
	border-radius:30px;

}
#selectbuttonid{
	background-color:green;
	width:200px;
	border-radius:30px;
}
</style>
<h1>WDV341 Intro PHP</h1>
<h2>Unit 9 A1 - SQL Selects - multiple items</h2>
<p>&nbsp;</p>
<div id="orderArea">
<form name="form" method="post" action="selectEvents.php">
  <h3>Select events</h3>
    <h4> Select (view) values from wdv341_event table in wdv341 database. </h4>
	<hr>
	<h5 id="successstatement"> </h5>

	  <fieldset> <legend>Results from database</legend>
	  <table><tr><th>Event ID</th><th>Event name</th><th>Event description</th><th>Event presenter</th><th>Event date</th><th>Event time</th>	</tr>
		<?php echo $DatabaseTable; ?>
	</table>
	 </fieldset>

  <p>
    <input type="submit" name="resetbutton" id="resetbuttonid" value="reset">
    <input type="submit" name="selectbutton" id="selectbuttonid" value="select">
  </p>
</form>
</div>

</body>
</html>
<?php
// begin a simple error "catch"...
}// end if select file is present

 else {
?>
<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View a single event</title>
	<style>

.error	{
	color:red;
	font-style:italic;	
}
</style>
<h1>WDV341 Intro PHP</h1>
<h2>Unit 9 A1 - SQL Selects - multiple items</h2>
</body>
</html>

<?php
    echo '<span class="error">Error... Required components are missing...</span>';
}
// end error catch
?>		
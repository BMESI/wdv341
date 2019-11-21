<?php
	//	require_once("../Unit 8 - SQL INSERT/connection.php");
$SelectFile =  "../../UNIT 9 - SQL SELECT/Select.php";
		 
if ( file_exists($SelectFile) && is_readable($SelectFile) ) {

    require_once $SelectFile;

	$NewSelect = new Select();
		$DatabaseTable = "";
		$Selection = "";
		$SearchTerm = "";
		$EM_Selection = "";
		$EM_Term = "";
		$EM_Results = '<span class="error"> ...</span>';
		$ValidForm = true;
		if (isset($_POST['selectbutton']) ){
			$Validate = new FormValidation();
			$Selection = $_POST['event_list'];		$SearchTerm =  trim($_POST['search_term']);
			// vaidate inputs
			if ( $Validate->ValidateRequiredField($Selection) == 'false'){
					$EM_Selection = "A valid selection is required!";
					$ValidForm = false;
			} // end if valid Select
			if ($Validate->ValidateRequiredField($SearchTerm)== 'false'){
					$EM_Term = "A search term is required!";
					$ValidForm = false;
			}// end if valid search
			if ( $Validate->ValidateInputLength($Selection, 17, 10) == 'false'){
					$EM_Selection = "Search term is too  long/short! Allowed 17 t0 10 characters...";
					$ValidForm = false;
			} // end if valid Select
			if ($Validate->ValidateInputLength($SearchTerm,100,2)== 'false'){
					$EM_Term = "Search term is too  long/short! Allowed 100 to 2 characters...";
					$ValidForm = false;
			} // end if valid length search

			if ($Validate->ValidateSpecialComment($SearchTerm)== 'false'){
					$EM_Term = "Not accepted! Acceptable characters: Alphanumeric or '!' , '@' ,'?' ,'.' , '\', ','";
					$ValidForm = false;
			}// end if valid search
		
			if ($Validate->ValidateEventColumnType($Selection) == 'false'){
					$EM_Selection = "Check for valid selection...";
					echo $Selection;
					$ValidForm = false;
			} // end if valid Select
			
			//$ValidForm = true;
			try{
			if ( $ValidForm){
							for ($inta = 0; $inta < sizeof($NewSelect->SelectSingleEvent($Selection,$SearchTerm) ) ; $inta++  ){
								$DatabaseTable .=		 $NewSelect->SelectSingleEvent($Selection,$SearchTerm)[$inta];
							}// end for loop
				} // end if valid

			}//end try
			catch(Exception $Error){
				$DatabaseTable = "Error: " . $Error->getMessage();
			}	// end catcb
		}// end isset select
		if (isset($_POST['resetbutton']) ){
					$DatabaseTable = "";
					$ValidForm = false;
		}// end if isset reset
		// continue w/ form if select file was found
?>
<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View a single event</title>
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
#selectbuttonid{
	background-color:green;
	width:200px;
	border-radius:30px;
}
#resetbuttonid{
	background-color:red;
	width:200px;
	border-radius:30px;
}
</style>
<h1>WDV341 Intro PHP</h1>
<h2>Unit 9 A2 - SQL Selects - single item</h2>
<p>&nbsp;</p>
<div id="orderArea">
<form name="form" method="post" action="selectOneEvent.php">
  <h3>Select events</h3>
    <h4> Select (view) values from wdv341_event table in wdv341 database. </h4>
	<label for="event_list">Field to search:</label>
	<select id="event_list" name="event_list">
	<option value="" <?php // if event_list == 'option' then echo selected ?>></option>
	<option value='event_name' <?php if ($Selection == 'event_name' ) {echo 'selected'; } ?> >Event name</option>
	<option value='event_description'  <?php if ($Selection == 'event_description' ) {echo 'selected'; } ?> >Event description</option>
	<option value='event_presenter'  <?php if ($Selection == 'event_presenter' ) {echo 'selected'; } ?>>Event presenter</option>
	<option value='event_date'  <?php if ($Selection == 'event_date' ) {echo 'selected'; } ?>>Event date (YYYY-M-D)</option>
	<option value='event_time'  <?php if ($Selection == 'event_time' ) {echo 'selected'; } ?>>Event time (H:M:S [24h format])</option>
	</select>
		<span class="error"><?php  echo $EM_Selection; ?></span>
				<br>
		<label for="search_term"> Search term: </label>
	<input type="text" id="search_term" name="search_term" value="<?php echo trim($SearchTerm); ?>">
		<span class="error"><?php  echo $EM_Term; ?></span>
						<br>

	<hr>

	<h5 id="successstatement"> </h5>

	  <fieldset> <legend>Results from database</legend>
	  <table><tr><th>Event ID</th><th>Event name</th><th>Event description</th><th>Event presenter</th><th>Event date</th><th>Event time</th>	</tr>
		<?php  if ( strlen($DatabaseTable) == 0) { echo $EM_Results;}else{ echo $DatabaseTable;} ?>
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
} else {
?>
<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View a single event</title>
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
</style>
<h1>WDV341 Intro PHP</h1>
<h2>Unit 9 A2 - SQL Selects - single item</h2>
</body>
</html>

<?php
    echo '<span class="error">Error... Required components are missing...</span>';
}
// end error catch
?>		

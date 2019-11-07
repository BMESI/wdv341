<?php
require_once("FormValidation.php");
require_once("Insert.php");


/**
--Create a web page called eventsForm.php.

It will do the following:

Gather the information for an event using a form.

    --It will display a form that can be used to input the information for an event.
    --Use your database field names as your name attributes in the HTML of the form. 
    Include at least one form protection technique.
    --This will be a self posting form with validation. 

Use PHP, PDO and SQL to process the form data into your database. 

    It will connect to your wdv341 database using your database connection page.  Include this into your eventsForm.php page.
    It will access the wdv341_students table.  
    Use a PDO Prepared Statement to code and process a SQL INSERT command to insert the form data into your table. 

	**/

// input values
$event_name= "";
$event_description = "";
$event_presenter= "";
$full_event_year = "";
$event_month_number = "";
$event_day_number = "";
$event_date= "";  
$event_hour = "";
$event_minute = "";
$event_time= "";
$SpamHoneyField = "";

// error and other messages 
$EM_event_name= "";
$EM_event_description= "";
$EM_event_presenter= "";
$EM_full_event_year = "";
$EM_event_month_number = "";
$EM_event_day_number = "";
$EM_event_date= "";
$EM_event_time= "";
$SuccessStatement = "Successfull!";
$FailStatement = "Submission failed!";

// bool values
$FormValid = true;
$InsertComplete = false;
// validation class/object
 $Validate = new FormValidation();

if( isset($_POST['submitbutton']) ){
	// prepare insert class for inserting new values to event table
	$Insert = new Insert();

	// assign post values
	$SpamHoneyField = $_POST['first_name'];
	$event_name= $_POST['event_name'];
	$event_description = $_POST['event_description'];
	$event_presenter= $_POST['event_presenter'];
	$full_event_year =  $_POST['full_event_year'];
	$event_month_number =  $_POST['event_month_number'];
	$event_day_number =  $_POST['event_day_number'];
	$event_hour = $_POST['event_hour'];
	$event_minute = $_POST['event_minute'];
	// end post values 

	// begin validation
	if ( $SpamHoneyField !== "" ){
		$FormValid = false;
	} // end if set spam field

	if ($Validate->ValidateSpecialComment($event_name) == 'false'   ||   $Validate->ValidateRequiredField($event_name) == 'false' 
	|| $Validate->ValidateInputLength($event_name,20,4) == 'false'  ) {
		$FormValid = false;
			if ( $Validate->ValidateRequiredField($event_name) == 'false') {
				$EM_event_name= "Event name is required!";
			} // end if ValidateSpecialComment
			if ( $Validate->ValidateSpecialComment($event_name) == 'false') {
				$EM_event_name= "Only legal characters accpeted: Alphanumeric or '!' , '@' ,'?' ,'.' , '\', ',' ";
			} // end if ValidateSpecialComment
			if ( $Validate->ValidateInputLength($event_name,20,4) == 'false' ){
				$EM_event_name= "Event name must be between 20 to 4 characters!";
			}// end if valid length
	} // end if $event_name
	if($Validate->ValidateSpecialComment($event_description) == 'false'    ||   $Validate->ValidateRequiredField($event_description) == 'false'
	|| $Validate->ValidateInputLength($event_description,100,4) == 'false' ){
		$FormValid = false;
			if ( $Validate->ValidateRequiredField($event_description) == 'false') {
				$EM_event_description= "Event description is required!";
			} // end if ValidateSpecialComment
			if ( $Validate->ValidateSpecialComment($event_description) == 'false') {
				$EM_event_description= "Only legal characters accpeted: Alphanumeric or '!' , '@' ,'?' ,'.' , '\', ',' ";
			} // end if ValidateSpecialComment
			if ( $Validate->ValidateInputLength($event_description,100,4) == 'false' ){
				$EM_event_description= "Event description must be between 100 to 4 characters!";
			}// end if valid length
	}// end if $event_description
	if ($Validate->ValidateSpecialComment($event_presenter) == 'false'    ||   $Validate->ValidateRequiredField($event_presenter) == 'false'
	|| $Validate->ValidateInputLength($event_presenter,50,2) == 'false'){
		$FormValid = false;
			if ( $Validate->ValidateRequiredField($event_presenter) == 'false') {
				$EM_event_presenter= "Event presenter is required!";
			} // end if ValidateSpecialComment
			if ( $Validate->ValidateSpecialComment($event_presenter) == 'false') {
				$EM_event_presenter= "Only legal characters accpeted: Alphanumeric or '!' , '@' ,'?' ,'.' , '\', ',' ";
			} // end if ValidateSpecialComment	}
			if ( $Validate->ValidateInputLength($event_presenter,50,2) == 'false' ){
				$EM_event_presenter= "Event presenter must be between 50 to 2 characters!";
			}// end if valid length
	}// end if $event_presenter
	if($Validate->ValidateEventDate($full_event_year,$event_month_number,$event_day_number) == 'false'){
		$FormValid = false;
		$EM_event_date = "Must be a valid date for the given year!";
	}// end if valid date
	if($Validate->ValidateEventTime($event_hour,$event_minute) == 'false'){
		$FormValid = false;
		$EM_event_time = "Must be a valid time!";
	}// end if valid date
	if($Validate->ValidateInputLength($full_event_year,4,4) == 'false' || $Validate->ValidateInputLength($event_month_number,2,1) == 'false'  
	||  $Validate->ValidateInputLength($event_day_number,2,1) == 'false' )  {
		$FormValid = false;
		$EM_event_date= "Date error - check the length of the date inputs!";
		if ( $Validate->ValidateInputLength($full_event_year,4,4) == 'false' ){
			$EM_event_date =  " - Year must be in 4 digit format, without leading zeroes!";
		}
		if ( $Validate->ValidateInputLength($event_month_number,2,1) == 'false'  ){
			$EM_event_date =  " - Month number must be from 1 to 12, without leading zeroes!";
		}
		if ( $Validate->ValidateInputLength($event_day_number,2,1) == 'false'  ){
			$EM_event_date =  " - Day number must be a valid number for the month, without leading zeroes!";
		}
	} // end if ValidateInputLength date
	if($Validate->ValidateInputLength($event_hour,2,1) == 'false' || $Validate->ValidateInputLength($event_minute,2,1) == 'false'   )  {
		$FormValid = false;
		$EM_event_time = "Time input error - check the length of the date inputs and ensure proper format (hours: 0-24 and minutes: 0-60 and no special symbols) !";
		if ( $Validate->ValidateInputLength($event_hour,2,1) == 'false' ){
			$EM_event_time =  " - Hours must be from 0 to 24, without leading zeroes!";
		}
		if ( $Validate->ValidateInputLength($event_minute,2,1) == 'false'  ){
			$EM_event_time =  " - Minutes must be from 0 to 60, without leading zeroes!";
		}
	} // end if ValidateInputLength time


		if( $FormValid == true ){
			$event_date = date('Y-m-d', mktime(0,0,0,$event_month_number, $event_day_number,$full_event_year));
			$event_time = date('H:i:s', mktime($event_hour,$event_minute,0,0,0,0));
			$Insert->InsertEvent($event_name, $event_description, $event_presenter,$event_date,$event_time);
			$InsertComplete = $FormValid;
		
		} // end if $FormErrorFlag

} // end submit if
if ( isset($_POST['resetbutton']) ){
	$event_name= "";
	$event_description = "";
	$event_presenter= "";
	$event_date= "";
	$event_time= "";
// errors 
	$EM_event_name= "";
	$EM_event_description= "";
	$EM_event_presenter= "";
	$EM_event_date= "";
	$EM_event_time= "";
}// end reset if
?>
	
<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Events Form</title>
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
label {
 margin: auto;

}
fieldset{
		width:1020px;
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
</style>
<h1>WDV341 Intro PHP</h1>
<h2>Unit-8 - SQL Inserts</h2>
<p>&nbsp;</p>
<div id="orderArea">
<form name="form" method="post" action="eventsForm.php">
  <h3>Events Form</h3>
    <h4> Inserts values to wdv341_event table in wdv341 database. </h4>
	<hr>
	<h5 id="successstatement"><?php  if($FormValid && $InsertComplete) { echo "<h1>" . $SuccessStatement . "</h1>"; }
	 if( ($FormValid ) == false) { echo "<h1 class='error'>" . $FailStatement . "</h1>";} 
	?> </h5>
		  <fieldset> <legend> Event name, description and presenter info - only use alphanumerics and/or '!' , '@' ,'?' ,'.' , '\', ','</legend>
	 <p>
        <label for="event_name">Event name:</label>
        <input type="text" name="event_name" id="event_name" 
					value="<?php echo $event_name;?>"></br>
		<span class="error">  <?php echo $EM_event_name;  ?> </span>
      </p>
	  <p class="specialStuff">
        <label for="firstnameid"></label>
        <input type="text"  name="first_name" id="firstnameid">
      </p>
      <p>
        <label for="event_description">Event description:</label>
        <input type="text" name="event_description" id="event_description" 
					value="<?php  echo $event_description; ?>"></br>
		<span class="error">  <?php echo $EM_event_description;  ?> </span>
      </p>
      <p>
        <label for="event_presenter">Event presenter:</label>
        <input type="text" name="event_presenter" id="event_presenter" 
					value="<?php  echo $event_presenter; ?>"></br>
		<span class="error">  <?php echo $EM_event_presenter;  ?> </span>
      </p>
	  </fieldset>

	  <fieldset> <legend>Event date - use numeric dates without  leading zeroes or any special characters</legend>
	  <p>    
        <label for="full_event_year">4 Number Year:</label>
        <input type="text" name="full_event_year" id="full_event_year" maxlength="4"  
					value="<?php  echo $full_event_year; ?>">
		<span class="error">  <?php echo $EM_full_event_year;  ?> </span>
        <label for="event_month_number"> Single month number (1-12):</label>
        <input type="text" name="event_month_number" id="event_month_number" maxlength="2"
					value="<?php  echo $event_month_number; ?>">
		<span class="error">  <?php echo $EM_event_month_number;  ?> </span>
        <label for="event_day_number"> Single day number (1-31): </label>
        <input type="text" name="event_day_number" id="event_day_number" maxlength="2"
					value="<?php  echo $event_day_number; ?>"></br>
		<span class="error">  <?php echo $EM_event_day_number;  ?> </span>
      </p>
		  		<span class="error">  <?php echo $EM_event_date;  ?> </span>
	  </fieldset>
	  <fieldset> <legend>Event time - use 24 hour format without leading zeroes or any special characters:</legend>
	   <p>
        <label for="event_hour">Event hour (0-24):</label>
        <input type="text" name="event_hour" id="event_hour" maxlength="2" 
					value="<?php  echo $event_hour; ?>">
        <label for="event_minute">Event minute (0-60):</label>
        <input type="text" name="event_minute" id="event_minute" maxlength="2"
					value="<?php  echo $event_minute; ?>">
      </p>
		<span class="error">  <?php echo $EM_event_time;  ?> </span>
	 </fieldset>

  <p>
     <input type="submit" name="resetbutton" id="resetbuttonid" value="Reset">
    <input type="submit" name="submitbutton" id="submitbuttonid" value="submit">
  </p>
</form>
</div>

</body>
</html>
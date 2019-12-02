<?php

if(!isset($_SESSION)){
	session_start();
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

} // end if session set
if ($_SESSION['validuser'] !== "yes") {
	header('Location: login.php');
}// end if session 
else{
$Login=  "login.php";
require "../../UNIT 11 - PHP-SQL Login and Protected Pages/controllers/FormValidation.php";
require("../../UNIT 11 - PHP-SQL Login and Protected Pages/controllers/Insert.php");
//require $Login;
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
$Message = "";
$IDValid = true;
$Insert = new Insert();


if( isset($_POST['addbutton']) ){
	$validateupdate = new FormValidation();
	// assign post values
	//$event_id = $_GET['event_id'];
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

	if ($validateupdate->ValidateSpecialComment($event_name) == 'false'   ||   $validateupdate->ValidateRequiredField($event_name) == 'false'		
		|| $validateupdate->ValidateInputLength($event_name,40,4) == 'false'  ) {
		$FormValid = false;
			if ( $validateupdate->ValidateRequiredField($event_name) == 'false') {
				$EM_event_name= "Event name is required!";
			} // end if ValidateSpecialComment
			if ( $validateupdate->ValidateSpecialComment($event_name) == 'false') {
				$EM_event_name= "Only legal characters accpeted: Alphanumeric or '!' , '@' ,'?' ,'.' , '\', ',' ";
			} // end if ValidateSpecialComment
			if ( $validateupdate->ValidateInputLength($event_name,40,4) == 'false' ){
				$EM_event_name= "Event name must be between 40 to 4 characters!";
			}// end if valid length
	} // end if $event_name
	if($validateupdate->ValidateSpecialComment($event_description) == 'false'    ||   $validateupdate->ValidateRequiredField($event_description) == 'false'
		|| $validateupdate->ValidateInputLength($event_description,100,4) == 'false' ){
		$FormValid = false;
			if ( $validateupdate->ValidateRequiredField($event_description) == 'false') {
				$EM_event_description= "Event description is required!";
			} // end if ValidateSpecialComment
			if ( $validateupdate->ValidateSpecialComment($event_description) == 'false') {
				$EM_event_description= "Only legal characters accpeted: Alphanumeric or '!' , '@' ,'?' ,'.' , '\', ',' ";
			} // end if ValidateSpecialComment
			if ( $validateupdate->ValidateInputLength($event_description,100,4) == 'false' ){
				$EM_event_description= "Event description must be between 100 to 4 characters!";
			}// end if valid length
	}// end if $event_description
	if ($validateupdate->ValidateSpecialComment($event_presenter) == 'false'    ||   $validateupdate->ValidateRequiredField($event_presenter) == 'false'
		|| $validateupdate->ValidateInputLength($event_presenter,50,2) == 'false'){
		$FormValid = false;
			if ( $validateupdate->ValidateRequiredField($event_presenter) == 'false') {
				$EM_event_presenter= "Event presenter is required!";
			} // end if ValidateSpecialComment
			if ( $validateupdate->ValidateSpecialComment($event_presenter) == 'false') {
				$EM_event_presenter= "Only legal characters accpeted: Alphanumeric or '!' , '@' ,'?' ,'.' , '\', ',' ";
			} // end if ValidateSpecialComment	}
			if ( $validateupdate->ValidateInputLength($event_presenter,50,2) == 'false' ){
				$EM_event_presenter= "Event presenter must be between 50 to 2 characters!";
			}// end if valid length
	}// end if $event_presenter
	if($validateupdate->ValidateEventDate($full_event_year,$event_month_number,$event_day_number) == 'false'){
		$FormValid = false;
		$EM_event_date = "Must be a valid date for the given year!";
	}// end if valid date
	if($validateupdate->ValidateEventTime($event_hour,$event_minute) == 'false'){
		$FormValid = false;
		$EM_event_time = "Must be a valid time!";
	}// end if valid date
	if($validateupdate->ValidateInputLength($full_event_year,4,4) == 'false' || $validateupdate->ValidateInputLength($event_month_number,2,1) == 'false'  
		||  $validateupdate->ValidateInputLength($event_day_number,2,1) == 'false' )  {
		$FormValid = false;
		$EM_event_date= "Date error - check the length of the date inputs!";
		if ( $validateupdate->ValidateInputLength($full_event_year,4,4) == 'false' ){
			$EM_event_date =  " - Year must be in 4 digit format, without leading zeroes!";
		}
		if ( $validateupdate->ValidateInputLength($event_month_number,2,1) == 'false'  ){
			$EM_event_date =  " - Month number must be from 1 to 12, without leading zeroes!";
		}
		if ( $validateupdate->ValidateInputLength($event_day_number,2,1) == 'false'  ){
			$EM_event_date =  " - Day number must be a valid number for the month, without leading zeroes!";
		}
	} // end if ValidateInputLength date
	if($validateupdate->ValidateInputLength($event_hour,2,1) == 'false' || $validateupdate->ValidateInputLength($event_minute,2,1) == 'false'   )  {
		$FormValid = false;
		$EM_event_time = "Time input error - check the length of the date inputs and ensure proper format (hours: 0-24 and minutes: 0-60 and no special symbols) !";
		if ( $validateupdate->ValidateInputLength($event_hour,2,1) == 'false' ){
			$EM_event_time =  " - Hours must be from 0 to 24, without leading zeroes!";
		}
		if ( $validateupdate->ValidateInputLength($event_minute,2,1) == 'false'  ){
			$EM_event_time =  " - Minutes must be from 0 to 60, without leading zeroes!";
		}
	} // end if ValidateInputLength time
		if( $FormValid == true ){
			$event_date = date('Y-m-d', mktime(0,0,0,$event_month_number, $event_day_number,$full_event_year));
			$event_time = date('H:i:s', mktime($event_hour,$event_minute,0,0,0,0));
			$Insert->InsertEvent($event_name,$event_description,$event_presenter,$event_date,$event_time);
			$InsertComplete = $FormValid;
			$Message = "Addition completed!";
			// move to main page when done , show message to confirm completion...
			header('Location: ../../UNIT 11 - PHP-SQL Login and Protected Pages/views/login.php?Message='.$Message); 

		}// end if valid 
		else{
			$FormValid = false;
			$Message = "Addition not completed!";
			//$_GET['Message'] = $Message;
		}// end if valid 
} // end submit if}
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
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Event update</title>
	   <link rel="stylesheet" href="style/style.css">

	<style>

</style>
</head>
<body>

<div class="eventBlock">
	<div class="instructionarea">
  <h3>Events Form - <?php echo $Message; ?></h3>
    <h4> Add values to wdv341_event table in wdv341 database. </h4>
	<hr>
	</div>
<form name="insertform" method="post" action="addnewEvent.php">

		  <fieldset> <legend> Event name, description and presenter info - only use alphanumerics and/or ''!'' , ''@'' ,''?'' ,''.'' , ''-'', '',''</legend>
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
					value="<?php  echo $event_description;?>"></br>
		<span class="error">  <?php echo $EM_event_description;  ?> </span>
      </p>
      <p>
        <label for="event_presenter">Event presenter:</label>
        <input type="text" name="event_presenter" id="event_presenter" 
					value="<?php  echo $event_presenter;?>"></br>
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
					value="<?php   echo $event_month_number; ?>">
		<span class="error">  <?php echo $EM_event_month_number;  ?> </span>
        <label for="event_day_number"> Single day number (1-31): </label>
        <input type="text" name="event_day_number" id="event_day_number" maxlength="2"
					value="<?php  echo  $event_day_number; ?>"></br>
		<span class="error">  <?php echo $EM_event_day_number;  ?> </span>
      </p>
		  		<span class="error">  <?php echo $EM_event_date;  ?> </span>
	  </fieldset>
	  <fieldset> <legend>Event time - use 24 hour format without leading zeroes or any special characters:</legend>
	   <p>
        <label for="event_hour">Event hour (0-24):</label>
        <input type="text" name="event_hour" id="event_hour" maxlength="2" 
					value="<?php   echo $event_hour; ?>">
        <label for="event_minute">Event minute (0-60):</label>
        <input type="text" name="event_minute" id="event_minute" maxlength="2"
					value="<?php  echo $event_minute; ?>">
      </p>
		<span class="error">  <?php echo $EM_event_time;  ?> </span>
	 </fieldset>

  <p>
     <input type="submit" name="resetbutton" id="resetbuttonid" value="Reset">
    <input type="submit" name="addbutton" id="submitbuttonid" value="Add">
  </p>
</form>
</div>

</body>
</html>
<?php 
	//header('Location: login.php');

} // end if active user else


?>
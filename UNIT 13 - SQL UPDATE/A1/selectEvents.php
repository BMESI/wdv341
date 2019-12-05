<?php
	$EventModel = "../../UNIT 13 - SQL UPDATE/Event.php";	$SelectModel = "../../UNIT 13 - SQL UPDATE/Select.php";
	//require $EventModel;
	require $SelectModel;
	$NewEvent = new Event();
	$LoadEvents = new Select();
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
	background-color:yellow;
	width:200px;
	border-radius:30px;

}
#selectbuttonid{
	background-color:green;
	width:200px;
	border-radius:30px;
}
.updateeventoption{
	background-color:red;
	border-radius:25px;
	float:right;
	display:block;
	padding:3px;
}
		.eventBlock{
			width:50%;
			min-width:200px;
			margin-left:auto;
			margin-right:auto;
			background-color:#CCC;	
			display:block;
			padding: 10px;
			border-radius:25px;
		}
		.error{
			color:red;
			font-style: italic;
		}
		.highlight{
			color:green;
			font-style: italic;
		}
		.displayEvent{
			text-align:left;
			display:block;
			border-top:5px solid black;
			border-left: 2px solid black;
		}
		.displayPresenter{
			text_align:left;
			display:block;
		}
		.displayDescription {
			display:block;
		}
		.displayTime{
			text_align:left;
			display:block;
		}
		.displayDate{
			text_align:left;
			display:block;
		}
		.DateCurrent{
			color:red;
			font-style: bold;
		}
		.DateFuture{
			font-style: italic;
		}
		@media only screen and (max-width: 600px) {
					.eventBlock{   font-size: 15px;}
		}
</style>
<h1>WDV341 Intro PHP</h1>
<h2>Unit 12 A1- SQL Delete(s)</h2>
<p>&nbsp;</p>
<div id="orderArea">
<form name="form" method="post" action="selectEvents.php">
 <h3>  <?php  echo  "<span class='highlight'>" . sizeof($LoadEvents->SelectFormatEvents()) . "</span>"; ?> Events are available today. Click "select" button to view.</h3>

	 <div id="orderArea">
	<p>
        <div class="eventBlock">	

				<div>
					<?php 
							if (isset($_POST['selectbutton']) ){
								for ($inta = 0; $inta <  sizeof($LoadEvents->SelectFormatEvents()); $inta++ ){?>
            			<span class="displayEvent">Event: <?php echo $LoadEvents->SelectFormatEvents()[$inta]->getEvent_name(); ?></span>
				</div>
				<div>
						<span  class="updateeventoption"><a href='updateEvent.php?event_id=<?php echo $LoadEvents->SelectFormatEvents()[$inta]->getEvent_ID();?>'>Update</a>
						</span>
				</div>
				<div>
						<span  class="displayPresenter">Presenter: <?php echo $LoadEvents->SelectFormatEvents()[$inta]->getEvent_presenter();?></span>
				</div>
            <div>
            			<span class="displayDescription">Description: <?php echo $LoadEvents->SelectFormatEvents()[$inta]->getEvent_description();?></span>
            </div>
            <div>
            			<span class="displayTime">Time: <?php echo $LoadEvents->SelectFormatEvents()[$inta]->getEvent_time();?></span>
            </div>
            <div>
            			<span class="displayDate">Date: 
					<?php //start php date future/past/current conditions
							if(strtotime($LoadEvents->SelectFormatEvents()[$inta]->getEvent_date()) == strtotime(date('m/d/Y')) ){
								echo "<span class='DateCurrent'> " . $LoadEvents->SelectFormatEvents()[$inta]->getEvent_date(); } // end if Date current
							if(strtotime($LoadEvents->SelectFormatEvents()[$inta]->getEvent_date()) > strtotime(date('m/d/Y')) ){
								echo "<span class='DateFuture'> " . $LoadEvents->SelectFormatEvents()[$inta]->getEvent_date(); } // end if Date future
							if(strtotime($LoadEvents->SelectFormatEvents()[$inta]->getEvent_date()) < strtotime(date('m/d/Y')) ){
								echo $LoadEvents->SelectFormatEvents()[$inta]->getEvent_date(); } // end if Date past
					//end php date future/past/current conditions?>
						</span>
					<?php  }// end getevent loop
						} // end if isset?>

            </div>

			<hr>
        </div>
		<hr>
    </p>
	   <p>
    <input type="submit" name="resetbutton" id="resetbuttonid" value="reset">
    <input type="submit" name="selectbutton" id="selectbuttonid" value="select">
  </p>
</form>

</div>
<h3> <?php echo $Message;?></h3>
</div>	
</body>
</html>
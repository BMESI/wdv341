<?php
	/*
	--For this project you are going to practice using the SELECT command to pull the data from a table in your database.  You will also need to research and use some additional SQL formatting commands such as ORDER BY and Date format to properly prepare the information for formatting.

	--Use the attached .sql file as the basis for your project. Import the table into your wdv341 database. 

	--Use the layout and CSS provided in the formatEvents.php file.

	Do the following:
		--Your program should pull the rows from the table.
		--Sort in Descending order. 
		--Format the date field using SQL.
		--For each row in your table format the content as described in class. 
			--If the event date is in the future highlight the event name in italics.
			--If the event date is the current month highlight the event name in bold red font.

	When finished post your assignment to your domain and update the links in your homework page. 
	Submit your assignment on Blackboard and include a link to your Git repo

	*/
	//Get the Event data from the server.
	$EventModel = "Event.php";	$SelectModel = "Select.php";
	if( file_exists($EventModel) && is_readable($EventModel) && file_exists($SelectModel) && is_readable($SelectModel)){
	require $EventModel;
	require $SelectModel;
	$NewEvent = new Event();
	$LoadEvents = new Select();
				
?>	
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>WDV341 Intro PHP  - Display Events Example</title>
    <style>
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
</head>
<body>
    <h1>WDV341 Intro PHP</h1>
    <h2>Example Code - Display Events as formatted output blocks</h2>   

    <h3>  <?php  echo  "<span class='highlight'>" . sizeof($LoadEvents->SelectFormatEvents()) . "</span>"; ?> Events are available today.</h3>
	<p>
        <div class="eventBlock">	
				<div>
					<?php 	for ($inta = 0; $inta < sizeof($LoadEvents->SelectFormatEvents() ) ; $inta++ ){?>
            			<span class="displayEvent">Event: <?php echo $LoadEvents->SelectFormatEvents()[$inta]->getEvent_name(); ?></span>
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
					<?php  }// end getevent loop?>

            </div>

			<hr>
        </div>
		<hr>
    </p>

<?php

}else{
	echo     
	"
	<h1>WDV341 Intro PHP</h1>
    <h2>Example Code - Display Events as formatted output blocks</h2>   
    <h3>??? Events are available today.</h3>


	<h4>
		Some kind of error occcured... missing components...
    </h4>
	";
}// end else
	//Close the database connection	
?>
</div>	
</body>
</html>
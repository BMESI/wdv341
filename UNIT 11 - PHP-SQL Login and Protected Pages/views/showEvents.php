<?php
if(!isset($_SESSION)){
	session_start();
	 header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

} // end if session set
if ($_SESSION['validuser'] !== "yes") {
	header('Location: login.php');
}// end if session not valid
else{
	$OptionSelected = "Current events in Database";
										 	for ($inta = 0; $inta < sizeof($LoadEvents->SelectFormatEvents() ) ; $inta++ ){  ?>
            	<span class="displayEvent">Event: <?php echo $LoadEvents->SelectFormatEvents()[$inta]->getEvent_name(); ?></span>
				</div>
				<div>
				<span  class="deleteeventoption"><a href='deleteEvent.php?event_id=<?php echo $LoadEvents->SelectFormatEvents()[$inta]->getEvent_ID();?>'>Delete</a>
						</span>
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
            	<span class="displayDate">Date: <?php
				if(strtotime($LoadEvents->SelectFormatEvents()[$inta]->getEvent_date()) == strtotime(date('m/d/Y')) ){
					echo "<span class='DateCurrent'> " . $LoadEvents->SelectFormatEvents()[$inta]->getEvent_date(); } 
				 if(strtotime($LoadEvents->SelectFormatEvents()[$inta]->getEvent_date()) > strtotime(date('m/d/Y')) ){
				echo "<span class='DateFuture'> " . $LoadEvents->SelectFormatEvents()[$inta]->getEvent_date(); }
				 if(strtotime($LoadEvents->SelectFormatEvents()[$inta]->getEvent_date()) < strtotime(date('m/d/Y')) ){
				echo $LoadEvents->SelectFormatEvents()[$inta]->getEvent_date(); } // end loop 
					?></span>
						<?php  }// end getevent loop
						//	} // end if isset show 

}// end else
?>
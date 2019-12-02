<?php 
require_once("connection.php");

class Insert{

// contructor 
 function __construct(){

	} // end constr
function InsertEvent($event_nameARG, $event_descriptionARG, $event_presenterARG,$event_dateARG,$event_timeARG){
	try{
		global $Connection, $FormValid;
		$SQLStatement_Insert = "INSERT INTO wdv341_event (event_name, event_description, event_presenter, event_date, event_time)
			VALUES (:event_name, :event_description, :event_presenter, :event_date, :event_time);";
		$PreparedInsert = $Connection->prepare($SQLStatement_Insert);
		if( $FormValid == true ){
			  $PreparedInsert->bindParam(":event_name", $event_nameARG);  // two types of params : named params and question marks (placeholders )
			  $PreparedInsert->bindParam(":event_description", $event_descriptionARG);
			  $PreparedInsert->bindParam(":event_presenter", $event_presenterARG);
			  $PreparedInsert->bindParam(":event_date", $event_dateARG);
			  $PreparedInsert->bindParam(":event_time", $event_timeARG);
			  $PreparedInsert->execute();
			} // end if valid
			$Connection = null;
		}// end try
		catch(PDOException $Error){
			echo "<br>  Insert failed: " . $Error->getMessage();
	
		} // end caatch		

	}// end function
} // end class


?>
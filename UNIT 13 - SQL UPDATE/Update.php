<?php 

$ConnectionFile = "connection.php";

        require_once($ConnectionFile);
		
  class Update{

	function __construct(){

	}// end constr
	function UpdateSingleEvent($IDARG, $event_nameARG, $event_descriptionARG, $event_presenterARG, $event_dateARG, $event_timeARG){
		try{
			$UpdatePassed = false;
			$inta = 0;
			global $Connection;
			if ($IDARG == ""){
				return $UpdatePassed;
			}
			else{
				if ( $Connection ){
					$SQLUpdateStatement = $Connection->prepare("UPDATE wdv341_event SET event_name = :event_name, event_description = :event_description, event_presenter = :event_presenter, event_date = :event_date, event_time = :event_time WHERE event_id = :event_id");
					$SQLUpdateStatement->bindParam(':event_id', $IDARG);
					$SQLUpdateStatement->bindParam(':event_name', $event_nameARG);
					$SQLUpdateStatement->bindParam(':event_description', $event_descriptionARG);
					$SQLUpdateStatement->bindParam(':event_presenter', $event_presenterARG);
					$SQLUpdateStatement->bindParam(':event_date', $event_dateARG);
					$SQLUpdateStatement->bindParam(':event_time', $event_timeARG);

					$SQLUpdateStatement->execute();	
					$UpdatePassed = true;
				} // end if connection
				else{
					$UpdatePassed = false;
				} // end inner esle
			}// end outer else
			$Connection = null;
			 return (boolval($UpdatePassed) ? 'true' : 'false');
		}// end try
		catch(PDOException $Error){
			$UpdatePassed = false;	
			 return (boolval($UpdatePassed) ? 'true' : 'false');
		}/// end catch
	}// end UpdateSingleEvent
  }// end class

?>
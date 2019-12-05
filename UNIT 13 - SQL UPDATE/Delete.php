<?php 
$ConnectionFile = "../../UNIT 13 - SQL UPDATE/connection.php";

        require_once($ConnectionFile);
		
  class Delete{

	function __construct(){

	}// end constr
	function DeleteSingleEvent($IDARG){
		try{
			$Results =  ['<span class="error">No matching record(s)...</span>'];
			$inta = 0;
			global $Connection;
			if ($IDARG == ""){
				return $Results;
			}else{
			if ( $Connection ){
				$SQLDeleteStatement = $Connection->prepare("DELETE FROM wdv341_event WHERE event_id = :event_id");
					$SQLDeleteStatement->bindParam(':event_id', $IDARG);
					$SQLDeleteStatement->execute();	
					$Results = ["Delete successfull...hope you picked the right record!"];
			} // end if connection
				else{
					$Results =  ['<span class="error">No database connection made...</span>'];
				} // end inner esle
			}// end outer else
			$Connection = null;
			 return $Results;
		}// end try
		catch(PDOException $Error){
			$Results = ["<td>Nothing to view...Try some other time...</td>"];		
			return $Results;
		}/// end catch
	}// end DeleteSingleEvent
  }// end class


?>
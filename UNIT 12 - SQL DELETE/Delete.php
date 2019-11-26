<?php 
$ConnectionFile = "../../UNIT 12 - SQL DELETE/connection.php";
 $ValidationFie = "../../UNIT 12 - SQL DELETE/FormValidation.php";
if (!file_exists($ConnectionFile) || !is_readable($ConnectionFile) ||  !file_exists($ValidationFie) || !is_readable($ValidationFie) ){
        throw new Exception ('<span class="error">Missing website components...</span>');
		} // end if exception
else{
        require_once($ConnectionFile);
	//	require $ValidationFie;
		
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
} // end else 


?>
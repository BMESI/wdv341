<?php 
$ConnectionFile = "../../UNIT 9 - SQL SELECT/connection.php";
 $ValidationFie = "../../UNIT 9 - SQL SELECT/FormValidation.php";
if (!file_exists($ConnectionFile) || !is_readable($ConnectionFile) ||  !file_exists($ValidationFie) || !is_readable($ValidationFie) ){
        throw new Exception ('<span class="error">Missing website components...</span>');
		} // end if exception
else{
        require_once($ConnectionFile);
		require $ValidationFie;
		
  class Select{

	function __construct(){

	}// end constr
	function SelectEvents(){
		try{
			$Results =  ['<span class="error">No matching record(s)...</span>'];
			$inta = 0;
			global $Connection;
			if ($Connection ){
				$SQLSelectStatement = $Connection->prepare("SELECT event_id, event_name, event_description, event_presenter, event_date, event_time FROM wdv341_event");
				$SQLSelectStatement->execute();
					foreach($SQLSelectStatement->fetchAll(PDO::FETCH_ASSOC) as $row) {
						$Results[$inta] =	"<tr><td>" . $row['event_id'] ."</td><td>". $row['event_name'] ."</td><td> ". $row['event_description'] ." </td><td> ". $row['event_presenter'] ."</td><td>  ". $row['event_date'] ." </td> <td>  ". $row['event_time'] . " </td></tr>";
						$inta++;
					} // end for loop
				 return $Results;
			}// end if connectio
			else{
					$Results =  ['<span class="error">No database connection made...</span>'];
			} // end inner esle
		$Connection = null;
		}// end try
		catch(PDOException $Error){
			//echo "<br>  <h1>Select failed: " .$Error->getMessage()."</h1>";
					$Results = ["<p>Some general error message...</p>"];
			return $Results;
		}/// end catch
	}// end SelectEvents
	function SelectSingleEvent($ColumnArg, $SearchArg){
		try{
			$Results =  ['<span class="error">No matching record(s)...</span>'];
			$inta = 0;
			global $Connection;
			if ($ColumnArg == "" ||  $SearchArg == ""){
				return $Results;
			}else{
			if ( $Connection ){
				$SQLSelectStatement = $Connection->prepare("SELECT event_id, event_name, event_description, event_presenter, event_date, event_time FROM wdv341_event WHERE $ColumnArg = "."'".$SearchArg."'");
					$SQLSelectStatement->bindColumn('where $ColumnArg', $ColumnArg);
					$SQLSelectStatement->execute();
					foreach($SQLSelectStatement->fetchAll(PDO::FETCH_ASSOC) as $row) {
						$Results[$inta] =	"<tr><td>" . $row['event_id'] ."</td><td>". $row['event_name'] ."</td><td> ". $row['event_description'] ." </td><td> ". $row['event_presenter'] ."</td><td>  ". $row['event_date'] ." </td> <td>  ". $row['event_time'] . " </td></tr>";
						$inta++;
					}// end loop	
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
	}// end SelectSingleEvent
  }// end class
} // end else 


?>
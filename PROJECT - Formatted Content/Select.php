<?php 
require "connection.php";
require "FormValidation.php";

class Select   {
 public $Count = 0;
function __construct(){

	}// end constr


function SelectFormatEvents(){
	try{
		$Results =  ['<span class="error">No matching record(s)...</span>'];
		$inta = 0;
		global $Connection;
			if ($Connection ){
				//   ORDER BY key_part1 DESC; DATE_FORMAT(event_date, '%m/%e/%Y') AS
				$Count = $inta;
									//		date format:	month/  day/ year
							//		order desc by date   DATE_FORMAT(date, format)
				$SQLSelectStatement = $Connection->prepare("SELECT event_id, event_name, event_description, event_presenter, DATE_FORMAT(event_date, '%m/%e/%Y') AS f_e_date, event_time FROM wdv341_event ORDER BY event_date DESC");
				$SQLSelectStatement->execute();
					foreach($SQLSelectStatement->fetchall(PDO::FETCH_ASSOC) as $row) {
						$NewEvent = new Event();
						$NewEvent->setEvent_ID($row['event_id']);
						$NewEvent->setEvent_name($row['event_name']);
						$NewEvent->setEvent_description($row['event_description']);
						$NewEvent->setEvent_presenter($row['event_presenter']);
						$NewEvent->setEvent_date($row['f_e_date']);
						$NewEvent->setEvent_time($row['event_time']);
						$Results[$inta] = $NewEvent;
						$inta++;
					} // end for loop
				 return $Results;
			}// end if connectio
			else{
				$Results =  ['<span class="error">No database connection made...</span>'];
			} // end inner esle
	}// end try
	catch(PDOException $Error){
		$Results = ["<p>Nothing to view...Try some other time...</p>"];
		return $Results;
	}/// end catch
}// end SelectEvents
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
	}// end try
	catch(PDOException $Error){
			//echo "<br>  <h1>Select failed: " .$Error->getMessage()."</h1>";
					$Results = ["<p>Nothing to view...Try some other time...</p>"];
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
				$SQLSelectStatement = $Connection->prepare("SELECT event_id, event_name, event_description, event_presenter, event_date, event_time FROM wdv341_event WHERE " . $ColumnArg." = "."'".$SearchArg."'");
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

			 return $Results;
		}// end try
	catch(PDOException $Error){
			//echo "<br>  <h1>Select failed: " .$Error->getMessage()."</h1>";
			
				
		$Results = ["<td>Nothing to view...Try some other time...</td>"];
					
			return $Results;
		}/// end catch
	}// end SelectSingleEvent
}// end class


?>
<?php  

class EmailerModel {
 public $From; // "sendersaddress"
 public $To; // change var name to "recipient address"
 public $Subject;// change to "email "??
 public $Message; // "emailmessage"
 public $AddedHeaders = [];

function __construct(){

	}

 function SetSenderAddr($FromArg){ //  
	  $this->From = $FromArg;

	}
 function GetSenderAddr(){
		return  $this->From;
	}

function SetSendToAddr($ToArg){
		$this->To = $ToArg;
	}
function GetSendToAddr(){
		return $this->To;
	}

function SetSubjectLine($SubjectArg){
		$this->Subject = $SubjectArg;
	}
function GetSubjectLine(){
		return $this->Subject;
	}
function SetMessage($MessageArg){
		$this->Message = $MessageArg;
	}	
function GetMessage(){
		return  $this->Message;
	}

function SetAddedHeaders(){ 
		array_push($this->AddedHeaders,$this->GetSenderAddr());
		array_push($this->AddedHeaders, $this->GetSendToAddr());
	}
function GetAddedHeaders(){
	$ReturnHeaders = "";
		for ($x = 0; $x < count($this->AddedHeaders) ; $x++) {
			$ReturnHeaders .= "\r\n";
			$ReturnHeaders .= $this->AddedHeaders[$x];
			$ReturnHeaders .= "\r\n";
		}
	return $ReturnHeaders;
	}

function SendEmail(){
		$FromAddress = "From: ". $this->GetSenderAddr();
 		if ( mail($this->GetSendToAddr(),$this->GetSubjectLine(), $this->GetMessage(),$FromAddress) )
		{
   			return 1;
  		} 
		else 
		{
   			return 0;
  		}
	}// end send method
}
// end mailer class
?>
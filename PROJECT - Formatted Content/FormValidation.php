<?php 
// class for validating data -- made as a example in class session
class FormValidation{
// properties 
//

//general error messages
protected $FVEM_FieldRequired = "This field cannot be left empty. ";
protected $FVEM_ValidFormatRequired = "Input contains unaccepted characters: ";
protected $FVEM_ValidLengthRequired = "Input exceeds the max length: ";
protected $FVEM_ValidNumeric = "Input must be a numeric. ";

protected $FV_ErrorType = [0,1,2,3];

// general error flag  for return
public $ClassErrorIndicator = false;

// some illegal strings for general inut
protected $InvalidNullString = "";
protected $InvalidBlankSpace = " ";
protected $InvalidKeywordUndefined = "undefined";
protected $InvalidKeywordNull = "null";

// regex for name field
protected $NameRegex= "/[^A-Za-z0-9 ]/";

// phone number acceptable range of chars (0 to 9)
protected $PhoneNumberRegEx = '/[^0-9]/';

// special comments limitations  - only allow special characters required for grammar. 
protected $AcceptableCommentsMaxLength = 200;
protected $CommentsRegex= '/[^A-Za-z0-9!@?:\-.,\' ]/';
protected $AcceptableEventTypeName = "event_name";
protected $AcceptableEventTypeDescription = "event_description";
protected $AcceptableEventTypePresenter = "event_presenter";
protected $AcceptableEventTypeDate = "event_date";
protected $AcceptableEventTypeTime = "event_time";

//time and date related properties
protected $MaxHours = 24;
protected $MaxMinutes = 60;

// contructor 
 function __construct(){

	}

// methods 

//
// makes sure there is a value in the field
function ValidateRequiredField($InputArg){
		$ReturnBool = true;
		$InputArgReformed = str_replace( ' ', '', $InputArg);
		// check for blank space or nulls 
		// strcasecmp = 0 - if the two strings are equal
		// stristr = If  not found, returns FALSE. 
		if(  (strcasecmp($InputArgReformed, $this->InvalidNullString) == 0)  || (stristr($InputArgReformed,$this->InvalidBlankSpace) !== false) 
			|| (stristr($InputArgReformed,$this->InvalidKeywordUndefined) !== false) || (stristr($InputArgReformed,$this->InvalidKeywordNull) !== false) ){
			$ReturnBool = false; 

			//$this->ChangeFormErrorIndicator(true);
		}		// end if 	
		return (boolval($ReturnBool) ? 'true' : 'false');
	} // end Required Field check
function ValidateInputLength($InputArg, $InputMaxLengthArg, $InputMinLengthArg){
	$ReturnBool = true;
      if ( (strlen($InputArg) > $InputMaxLengthArg) 	||  (strlen($InputArg) < $InputMinLengthArg)  ) {
			$ReturnBool = false;
		 } // end iff
	return (boolval($ReturnBool) ? 'true' : 'false');
} // end val input length
function RequireNumberInput($NumericInputArg){
		$ReturnBool = true;
		// reforming numerics by replacing out commas w/ blank spaces
		$NumericInputArgReformed = str_replace( ',', '', $NumericInputArg );
		echo "Arg reformed:  $NumericInputArgReformed  -- Arg Pre-reform: ";
				if (  !is_numeric($NumericInputArgReformed) ){
					$ReturnBool = false;
					//$this->ChangeFormErrorIndicator(true);
				} // end number check
		return (boolval($ReturnBool) ? 'true' : 'false');
	} // end require number
function ValidateName($InputArg){
		$ReturnBool = true;
		$ReformedInputArg = filter_var($InputArg, FILTER_SANITIZE_STRING);
		if  ( preg_match_all($this->NameRegex, $ReformedInputArg)   ||  $this->ValidateRequiredField($ReformedInputArg)  == "false") {
			$ReturnBool = false;
		}
		return (boolval($ReturnBool) ? 'true' : 'false');
	} // end name check
// phone number check 
function ValidatePhoneNumber($PhoneNumberArg){
		global 	$FormErrorIndicator;

		global $PhoneNumberRegEx;
		$ReturnBool = true;
		if ( preg_match($this->PhoneNumberRegEx, $PhoneNumberArg)  || strlen($PhoneNumberArg) !== 10 ){
			$ReturnBool = false;
			//$this->ChangeFormErrorIndicator(true);
		}// end regex check
		return (boolval($ReturnBool) ? 'true' : 'false');
	} // end phone number check
// check email
function ValidateEmail($EmailArg){
		global 	$FormErrorIndicator;

		$EmailArgReformatted = strtolower($EmailArg);
		$ReturnBool = true;
		// Remove all illegal characters from email
		$EmailArgSanitized = filter_var($EmailArgReformatted, FILTER_SANITIZE_EMAIL);
		if ( filter_var($EmailArgSanitized, FILTER_VALIDATE_EMAIL) ===  FALSE) {
			$ReturnBool = false;
			//$this->ChangeFormErrorIndicator(true);
		}  // end if filtar var Validate
		return (boolval($ReturnBool) ? 'true' : 'false');
	}// end email check
function ValidateSpecialComment($InputArg){
		$ReturnBool = true;
		//$ReformedInputArg = filter_var($InputArg, FILTER_SANITIZE_STRING);
		// strlen($ReformedInputArg) >= $this->AcceptableCommentsMaxLength && 
		if  ( preg_match($this->CommentsRegex, $InputArg)    ){
			$ReturnBool = false;
		}
		return (boolval($ReturnBool) ? 'true' : 'false');
	} // end special comment check
function ValidateEventColumnType($ListArg){
		$ReturnBool = true;
		$ListArgReformatted = trim(strtolower($ListArg));
		// if none of these are true...
		if (  ($ListArgReformatted !== $this->AcceptableEventTypeName)  &&  ($ListArgReformatted !== $this->AcceptableEventTypeDescription)  
		&&  ($ListArgReformatted !== $this->AcceptableEventTypePresenter) &&  ($ListArgReformatted !== $this->AcceptableEventTypeDate)
		&&  ($ListArgReformatted !== $this->AcceptableEventTypeTime) ) {
			$ReturnBool = false;
		}// end if Acceptable types
		return (boolval($ReturnBool) ? 'true' : 'false');
	}// end column check
function ValidateEventDate($YearArg, $MonthArg, $DayArg){
		$ReturnBool = true;
		if ( filter_var($YearArg, FILTER_VALIDATE_INT) == false ||  filter_var($YearArg, FILTER_VALIDATE_INT) == false 
		||  filter_var($YearArg, FILTER_VALIDATE_INT) == false  || checkdate($MonthArg, $DayArg, $YearArg) != 1 )  {
			$ReturnBool = false;
		} // end if filter
		return (boolval($ReturnBool) ? 'true' : 'false');
} // end ValidateEventDate
function ValidateEventTime($HourArg, $MinuteArg){
		$ReturnBool = true;
		if ( filter_var($HourArg, FILTER_VALIDATE_INT) == false ||  filter_var($MinuteArg, FILTER_VALIDATE_INT) == false 
		||   $HourArg > $this->MaxHours ||   $MinuteArg > $this->MaxMinutes ) {
			$ReturnBool = false;
		} // end if filter
		return (boolval($ReturnBool) ? 'true' : 'false');
} // end ValidateEventDate
function SetErrorType(){

} // end SetErrorType
function ChangeFormErrorIndicator($BoolArg){
		global 	$FormValid;
		$FormValid = $BoolArg;
 
	}
function GetFormErrorIndicator(){
		global 	$FormErrorIndicator;
		$ClassErrorIndicator = $FormErrorIndicator;
		return $ClassErrorIndicator;
	}
}// end class
?>
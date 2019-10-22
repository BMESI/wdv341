<?php 

// class for validating data -- made as a example in class session
class CE_FormValidation{
// properties 
//
// some illegal strings for general inut
protected $InvalidNullString = "";
protected $InvalidBlankSpace = " ";
protected $InvalidKeywordUndefined = "undefined";
protected $InvalidKeywordNull = "null";
// regex for name field
protected $NameRegex= "/[^A-Za-z0-9 ]/";

// phone number acceptable range of chars (0 to 9)
protected $PhoneNumberRegEx = '/[^0-9]/';
// list values - mandatory
protected $AcceptableRegistrantTypeAttendee = "attendee";
protected $AcceptableRegistrantTypePresenter = "presenter";
protected $AcceptableRegistrantTypeVolunteer = "volunteer";
// radio values - mandatory
protected $AcceptableBadgeTypeClip = "clip";
protected $AcceptableBadgeTypeLanyard = "lanyard";
protected $AcceptableBadgeTypeMagnet = "magnet";
// checkbox values - optional ?? 
protected $AcceptableMealDayFriday = "friday";
protected $AcceptableMealDaySaturday = "saturday";
protected $AcceptableMealDaySunday = "sunday";
// special comments limitations  - only allow special characters required for grammar. 
protected $AcceptableCommentsMaxLength = 200;
protected $CommentsRegex= "/[^A-Za-z0-9?.',!@\- ]/";

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
		}		// end if 	
		return (boolval($ReturnBool) ? 'true' : 'false');
	} // end Required Field check

function RequireNumberInput($NumericInputArg){
		$ReturnBool = true;
		// reforming numerics by replacing out commas w/ blank spaces
		$NumericInputArgReformed = str_replace( ',', '', $NumericInputArg );
		echo "Arg reformed:  $NumericInputArgReformed  -- Arg Pre-reform: " . $NumericInputArg . " -- ";
				if (  !is_numeric($NumericInputArgReformed) ){
							$ReturnBool = false;
				} // end number check
		return (boolval($ReturnBool) ? 'true' : 'false');
	} // end require number
//
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
		global $PhoneNumberRegEx;
		$ReturnBool = true;
		if ( preg_match($this->PhoneNumberRegEx, $PhoneNumberArg)  || strlen($PhoneNumberArg) <> 10 ){
			$ReturnBool = false;
		}// end regex check
		return (boolval($ReturnBool) ? 'true' : 'false');
	} // end phone number check
// check email
function ValidateEmail($EmailArg){
		$EmailArgReformatted = strtolower($EmailArg);
		$ReturnBool = true;
		// Remove all illegal characters from email
		//$EmailArgSanitized = filter_var($EmailArgReformatted, FILTER_SANITIZE_EMAIL);
		if ( filter_var($EmailArgReformatted, FILTER_VALIDATE_EMAIL) ===  FALSE) {
			 		$ReturnBool = false;
		}  // end if filtar var Validate
		return (boolval($ReturnBool) ? 'true' : 'false');
	}// end email check
public function ValidateRegistrationList($ListArg){
		global $InvalidNullString, $AcceptableRegistrantTypeAttendee;
		$ReturnBool = true;
		$ListArgReformatted = trim(strtolower($ListArg));
		// if none of these are true...
		if (  ($ListArg !== $this->AcceptableRegistrantTypeAttendee)  
		&&  ($ListArg !== $this->AcceptableRegistrantTypePresenter)  &&  ($ListArg !== $this->AcceptableRegistrantTypeVolunteer) ){
					$ReturnBool = false;
		}// end if Acceptable types 
		return (boolval($ReturnBool) ? 'true' : 'false');
	}// end registration check
function ValidateBadgeTypeRadio($RadioArg){
		$RadioArgReformed = strtolower($RadioArg);
		$ReturnBool = true;
		if ( ($this->ValidateRequiredField($RadioArgReformed) !== true) && ($RadioArgReformed !== $this->AcceptableBadgeTypeClip)
	    && ($RadioArgReformed !== $this->AcceptableBadgeTypeLanyard) && ($RadioArgReformed !== $this->AcceptableBadgeTypeMagnet)  ){
			$ReturnBool = false;
		}
		return (boolval($ReturnBool) ? 'true' : 'false');
	}// end badge check
function ValidateMealDayCheckbox($CheckboxArg){
		$ReturnBool = true;
		// if type is an array, move to inner branch
		if (  is_array($CheckboxArg)  ){
			// if no acceptable value is not in this array , reject it .
			if (  (in_array($this->AcceptableMealDayFriday, $CheckboxArg)  == false ) 
			&& (in_array($this->AcceptableMealDaySaturday, $CheckboxArg)  == false)  
			&& (in_array($this->AcceptableMealDaySunday, $CheckboxArg)   == false) ){
			$ReturnBool = false;
			} // end if value not found in array
		}// end if is array 
		else{
			$ReturnBool = false;
		}
		return (boolval($ReturnBool) ? 'true' : 'false');
	}// end meal check
function ValidateSpecialComment($InputArg){
		$ReturnBool = true;
		$ReformedInputArg = filter_var($InputArg, FILTER_SANITIZE_STRING);
		if  ( !  strlen($ReformedInputArg) >= $this->AcceptableCommentsMaxLength || preg_match_all($this->CommentsRegex, $ReformedInputArg)   ){
			$ReturnBool = false;
		}

		return (boolval($ReturnBool) ? 'true' : 'false');
	} // end special comment check
}// end class
?>
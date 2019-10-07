<?php 

	// do not need "require" statement here ...just copy-in variables and good to go
	// validation functions
	function CheckForSpecialStuff($StuffArg){
		global $SpecialIndicatorForSpecialStuff;
		if ( strlen($StuffArg) < 0 ){
			$SpecialIndicatorForSpecialStuff = true;
			$FormErrorIndicator = true;
		}
	}
	function ValidateName($NameArg){
		global 	$FormErrorIndicator, $EM_Name;
			if($NameArg == ""){
				$FormErrorIndicator = true;
				$EM_Name = "Name cannot be empty.";
			}
	}
	function ValidatePhoneNumber($PhoneNumberArg){
			global 	$FormErrorIndicator, $EM_PhoneNumber;
			$SizeLimiter = 10;
				if (  (strlen($PhoneNumberArg) <> $SizeLimiter) || ( $PhoneNumberArg == "")  || ( ! is_numeric($PhoneNumberArg) ) ){
					$FormErrorIndicator = true;
					$EM_PhoneNumber = "Valid Phone number is required, format: 1234567890.";
				}
	}
	function ValidateEmail($EmailArg){
		global 	$FormErrorIndicator, $EM_EmailAddress;
		$EmailArg = filter_var($EmailArg, FILTER_SANITIZE_EMAIL);
		$EmailArg = filter_var($EmailArg, FILTER_VALIDATE_EMAIL);

			if( ($EmailArg == "") || ($EmailArg === false) ){
				$FormErrorIndicator = true;
				$EM_EmailAddress = "E-mail is empty or invalid.";
			}
	}
	function RequireGuestTypeList($RegistrantTypeListArg){
		global $FormErrorIndicator, $EM_RegistrantTypeList;
			if( $RegistrantTypeListArg == ""){
				$FormErrorIndicator = true;
				$EM_RegistrantTypeList = "Must select a registrant type from the dropdown list.";
			}
	
	}
	function RequireCheckboxes($CheckboxArg){
	//
	// function param isn ot being used , will fix at later time
		global 	$FormErrorIndicator, $EM_MealCheckbox;
			if( $CheckboxArg == 0 ) {
					$FormErrorIndicator = true;
					$EM_MealCheckbox = "At least one checkbox must be checked.";
			}	
	}
	function RequireRadios($RadioArg){
		global 	$FormErrorIndicator, $EM_BadgeHolder;

			if(  ($RadioArg == "off") ||  ($RadioArg == "")  ) {
				$FormErrorIndicator = true;
				$EM_BadgeHolder = "Must select a badge type.";
			}
	}
	function ValidateSpecialRequests($SpecialRequestsArg){
		global 	$FormErrorIndicator, $EM_SpecialRequests;
		$SizeLimiter = 200;
			if ( strlen($SpecialRequestsArg) > $SizeLimiter){
				$FormErrorIndicator = true;
				$EM_SpecialRequests = "Comment too big. Please shorten it.";
			}
	}
	//
	//end validation functions

?>
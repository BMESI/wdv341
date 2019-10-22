<?php
	require "FormValidation.php";
$FormErrorIndicator = false;
$SubmissionCompleted = false;
$SpecialIndicatorForSpecialStuff = false;
$ApprovalMessage = "empty message so far...";
//
// vars to be filled by data input from user
//
$SpecialStuff = "";
$Name = "";
$PhoneNumber = "";
$EmailAddress = "";
$RegistrantTypeList = "";
$BadgeHolder = "";
$FridayDinnerCheck = "";
$SaturdayLunchCheck = "";
$SundayBrunchCheck = "";
$SpecialRequests = "";
$MealDay =  [""];
$CheckboxCount = 0;
//
// error messages
//
$EM_Name = "";
$EM_PhoneNumber = "";
$EM_EmailAddress = "";
$EM_RegistrantTypeList = "";
$EM_BadgeHolder = "";
$EM_MealCheckbox = "";
$EM_SpecialRequests = "";
$EM_FieldRequired = "";
$EM_NumericRequired = "This field must be numbers only.";
// end vars

// if the "reset" button is clicked , reset values
if ( isset($_POST['resetbutton']) ){
$Name = "";
$PhoneNumber = "";
$EmailAddress = "";
$RegistrantTypeList = "";
$BadgeHolder = "";
$FridayDinnerCheck = "";
$SaturdayLunchCheck = "";
$SundayBrunchCheck = "";
$SpecialRequests = "";
$MealDay =  [""];
$CheckboxCount = 0;
//
// error messages
//
$EM_Name = "";
$EM_PhoneNumber = "";
$EM_EmailAddress = "";
$EM_RegistrantTypeList = "";
$EM_BadgeHolder = "";
$EM_MealCheckbox = "";
$EM_SpecialRequests = "";
// end vars

}
if ( isset($_POST["submitbutton"])  )
{ 

	$SpecialStuff = $_POST['first_name'];
	// assign honey pot field to special stuff var and if it exceeds 0 characters, re-direct to the the form and reject all inputs
	if( strlen($SpecialStuff) == 0){
	// assign vars from post
	$ValidateForm = new FormValidation();
	$Name =  $_POST['name'];
	$PhoneNumber = $_POST['phonenumber'];
	$EmailAddress = $_POST['emailaddress'];
	$RegistrantTypeList = $_POST['registrationlist'];
	// extra branch of "ifs" for radios and checkboxes
		if ( isset ($_POST["badgeradio"]) ) {
			$BadgeHolder = $_POST['badgeradio'];
		}
		if ( isset($_POST['mealbox'])  ) {
		// assign values of mealbox checkbox array to mealday array - then update counter
             $MealDay =  $_POST['mealbox'];
			
		}// end checkbox if branch
	$SpecialRequests = $_POST['specialrequests'];
	//
	// start validating
	//
		if ( $ValidateForm->ValidateName($Name) == 'false') {
				$EM_Name = "Field cannot be empty and cannot contain special characters.";
				$FormErrorIndicator  = true;
		}
		if ( $ValidateForm->ValidatePhoneNumber($PhoneNumber)  == 'false'){
				$EM_PhoneNumber = "Valid Phone number is required, format: 1234567890.";	
				$FormErrorIndicator  = true;

		}
		if ( $ValidateForm->ValidateEmail($EmailAddress)  == 'false' ){
				$EM_EmailAddress = "E-mail is empty or invalid.";
				$FormErrorIndicator = true;

		}
		if ( $ValidateForm->ValidateRegistrationList($RegistrantTypeList) == 'false' ){
				$EM_RegistrantTypeList = "Must select a registrant type from the dropdown list.";
				$FormErrorIndicator  = true;

		}
		if ( $ValidateForm->ValidateBadgeTypeRadio($BadgeHolder)  == 'false'   ){
				$EM_BadgeHolder = "Must select a badge type.";
				$FormErrorIndicator  = true;

		}
		if ( $ValidateForm->ValidateSpecialComment($SpecialRequests)  == 'false' ) {
			$EM_SpecialRequests = "Input required: up to 200 characters allowed.";
				$FormErrorIndicator  = true;

		}
	// end validating
	// if error Indicator is not "true" (not turned on), then proceed to database
	if ( ($FormErrorIndicator  == false) ){
				$ApprovalMessage = "Your form has been submitted.";
				// db code goes here
				// Output inputs into HTML here -- it wil show above the form 
				?>
				<h1> Info you entered:</h1>
				<p> Approval Message: <?php echo $ApprovalMessage;?></p>
				<p> Name: <?php echo $Name;?></p>
				<p> Guest Type: <?php echo $RegistrantTypeList;?></p>
				<p> Phone Number: <?php echo $PhoneNumber;?></p>
				<p> Email Address: <?php echo $EmailAddress;?></p>
				<p> Badge Type: <?php echo $BadgeHolder;?></p>
				<p> Requests: <?php echo $SpecialRequests;?></p>
				<p> Meal Day(s): <?php  // 
				// for loop is used for appending either commas or period for mealbox-days' array
				for($inti = 0; $inti < sizeof($MealDay); $inti ++){
							echo $MealDay[$inti];
							if ($inti  == sizeof($MealDay) - 1 ) {
								echo  ". ";
							}else{
								echo  ", ";
							}
				} /// end mealday-output loop
				// output for approval message?></p>
				<p> <?php echo $ApprovalMessage;?></p>
				<?php $SubmissionCompleted = true;
	} // end approval 
	else
	{	
		$ApprovalMessage = "Your form has an error. Not submitted.";

		?>
			<p> <?php echo $ApprovalMessage;?></p>
		<?php  
		$SubmissionCompleted = false;
	}// end rejection notice

	}else{
				$ApprovalMessage = "Your form has an error. Not submitted. Spam detected....";
						$SubmissionCompleted = false;
						?>			<p> <?php echo $ApprovalMessage . $SpecialStuff . " --";?></p>
								<?php  
	} // end honey pot / rejection notice

} // end if post submit

?>
	
<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV341 Intro PHP - Self Posting Form</title>
	<style>

#orderArea	{
	width:600px;
	border:thin solid black;
	margin: auto auto;
	padding-left: 20px;
}

#orderArea h3	{
	text-align:center;	
}
.error	{
	color:red;
	font-style:italic;	
}
.specialStuff {
	display: none;
}
</style>
<h1>WDV341 Intro PHP</h1>
<h2>Unit-5 and Unit-6 Self Posting - Form Validation Assignment</h2>
<p>&nbsp;</p>
<div id="orderArea">
<form name="form3" method="post" action="customerRegistrationForm.php">
  <h3>Customer Registration Form</h3>
      <p>
        <label for="nameid">Name:</label>
        <input type="text" name="name" id="nameid" 
					value="<?php  echo $Name ?>"></br>
		<span class="error">  <?php echo $EM_Name;  ?> </span>
      </p>
	  <p class="specialStuff">
        <label for="firstnameid"></label>
        <input type="text"  name="first_name" id="firstnameid">
      </p>
      <p>
        <label for="textfield2">Phone Number:</label>
        <input type="text" name="phonenumber" id="phonenumberid" 
					value="<?php echo $PhoneNumber ?>"></br>
		<span class="error"> <?php   echo $EM_PhoneNumber; ?> </span>
      </p>
      <p>
        <label for="textfield3">Email Address: </label>
        <input type="text" name="emailaddress" id="emailaddressid"  
					value="<?php echo $EmailAddress ?>"></br>
		<span class="error"> <?php  echo $EM_EmailAddress; ?> </span>
      </p>
      <p>
        <label for="select">Registration: </label>
        <select name="registrationlist" id="registrationlistid" >
          <option value=""
						<?php if ($RegistrantTypeList =='')  echo 'selected'; ?>	>Choose Type</option>
          <option value="Attendee"  
						<?php if ($RegistrantTypeList =='Attendee')  echo 'selected'; ?> > Attendee</option>
          <option value="Presenter" 
						<?php if ($RegistrantTypeList =='Presenter')  echo 'selected'; ?> > Presenter</option>
          <option value="Volunteer"
						<?php if ($RegistrantTypeList =='Volunteer')  echo 'selected'; ?> > Volunteer</option>
          <option value="Guest" 
						<?php if ($RegistrantTypeList =='Guest')  echo 'selected'; ?> >Guest</option>
        </select>
		</br>
		<span class="error"> <?php echo $EM_RegistrantTypeList; ?> </span>
      </p>
      <p>Badge Holder:</p>
      <p>
        <input type="radio" name="badgeradio" id="radioid1" value="Clip"
					<?php if ($BadgeHolder=='Clip') echo 'checked'; ?>>
        <label for="radio">Clip</label> </br>
        <input type="radio" name="badgeradio" id="radioid2" value="Lanyard" 
					<?php if ($BadgeHolder=='Lanyard') echo 'checked'; ?>>
        <label for="radio2">Lanyard</label> </br>
        <input type="radio" name="badgeradio" id="radioid3" value="Magnet" 
					<?php if ($BadgeHolder=='Magnet') echo 'checked'; ?>>
        <label for="radio3">Magnet</label>
			</br>	
	    <span class="error"> <?php echo $EM_BadgeHolder;?> </span>
      </p>
      <p>Provided Meals (Select all that apply):</p>
      <p>
        <input type="checkbox" name="mealbox[]" value="friday" id="fridaydinnercheckboxid" 
			<?php if ( in_array("friday", $MealDay) ) echo "checked='checked'" ; ?>>
        <label for="fridaydinnercheckboxid">Friday Dinner</label><br>
        <input type="checkbox" name="mealbox[]" value="saturday" id="saturdaylunchcheckboxid" 
			<?php if ( in_array("saturday", $MealDay) ) echo "checked='checked'" ; ?>>
        <label for="saturdaylunchcheckboxid">Saturday Lunch</label><br>
        <input type="checkbox" name="mealbox[]" value="sunday" id="sundayawardbrunchcheckboxid" 
			<?php if ( in_array("sunday", $MealDay) ) echo "checked='checked'" ; ?>>
        <label for="sundayawardbrunchcheckboxid">Sunday Award Brunch</label>
		</br>
		<span class="error"> <?php echo $EM_MealCheckbox; ?> </span>
      </p>
      <p>
        <label for="specialrequestsid">Special Requests/Requirements: (Limit 200 characters)<br>
        </label>
        <textarea name="specialrequests" cols="40" rows="5" id="specialrequestsid"><?php  echo $SpecialRequests; ?></textarea>
			</br>	<span class="error"> <?php echo $EM_SpecialRequests;?> </span>
      </p>
   
  <p>
     <input type="submit" name="resetbutton" id="resetbuttonid" value="Reset">
    <input type="submit" name="submitbutton" id="submitbuttonid" value="submit">
  </p>
</form>
</div>

</body>
</html>
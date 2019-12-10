<?php 
	require "../controllers/Insert.php";
	require "../controllers/FormValidation.php";
	require "../models/EmailerModel.php";

$From = "contact@benmesinovic.com";
$To = "";
$Subject = "Hello from my blog site!";
$ActualMessage = "";
$Message = wordwrap($ActualMessage, 70, "\r\n");
$EmailFormValid = true;
$ConfirmationSent = "";
$Message_EM = "";
$To_EM = "";
if (isset($_POST['submitbutton']) ){
	$NewUser = new Insert();
	$ValidateInputs = new FormValidation();
	
	if($_POST['emailverify'] !== ""){
	$EMailFormValid = false;
	}

		$To =  $_POST['email'];
		$ActualMessage = $_POST['message'];
		if ( $ValidateInputs->ValidateEmail($To) == 'false' ){
			$EmailFormValid = false;	$To_EM = "Please provide a valid email.";

		}
	
		if ( $ValidateInputs->ValidateSpecialComment($ActualMessage) == 'false'  
			|| $ValidateInputs->ValidateRequiredField($ActualMessage) == 'false' 
			|| $ValidateInputs->ValidateInputLength($ActualMessage,300,3) == 'false'){
		$EmailFormValid = false;	$Message_EM = "Please provide a comment with  200 to 3 characters, including alphanumerics and/or !, @, ?, :,-";

		}
		$To =  $_POST['email'] . ", $From";
		$From .= ", $To";
	if ( $EmailFormValid == true)	{  
		$ContactFormMailService = new EmailerModel();
		$ContactFormMailService->SetSendToAddr($To);
		$ContactFormMailService->SetSubjectLine($Subject);
		$ContactFormMailService->SetMessage($ActualMessage);
		$ContactFormMailService->SetSenderAddr($From);
		if ( $ContactFormMailService->SendEmail()  == 1) {
			$ConfirmationSent = "Email has been sent";
		}else{
			$ConfirmationSent = "Email has not been sent";		
		}
		$ContactFormMailService->SetAddedHeaders();
	} // end if form valid
} // end if submit

?>
<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8" />
    <title>Blog site - Contact</title>
		<link rel="stylesheet" href="styles/mainstyle.css">

</head>
<body>
<ul class="bar">
			<li><a href="main.php">Home</a></li>
			<li><a href="contact.php">Contact</a></li>
			<li><a href="blogs.php">Blogs</a></li>
			<li><a href="register.php">Register</a></li>
			<li><a  class="lastitem" href="login.php">Login</a></li>
	</ul>
		  <div class="contacttop">
	<h1>Blog contact </h1>
	</div>
	<div class="transbox">
		<form name="contactform" id="contactform" method="post" action="contact.php">
			<label for="email" id="emaillabel">Your E-mail:</label>
			<input type="text"  style="display:none;" id="emailverify" name="emailverify" value="<?php $To?>" />
			<input type="text"  id="emailcontact" name="email" value="<?php $To?>" />
			<span class="error">  <?php echo $To_EM;  ?> </span>
		<p class="contactmessage">
			<label for="message">Message entry (200 character limit):</label>
			<textarea name="message" id="message" ><?php  echo $Message;?></textarea> </br>
			<span class="error">  <?php echo $Message_EM;  ?> </span>
		</p>
		<div class="contactmessage">
          <input type="submit"  id="submitbutton" name="submitbutton" value="Submit" />
		  <input type="reset"  id="resetbutton" name="resetbutton" value="Reset" />
		
      </form>
	  </div>
	  <div class="contactbottom">
			<h3> <?php echo $ConfirmationSent; ?> </h3>
		    <p>Welcome to the contact page </p>
			<p> Enter a valid email and a message.</p>
		</div>
</body>
</html>
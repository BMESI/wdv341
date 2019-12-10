<?php 
	require "../controllers/Insert.php";
	require "../controllers/FormValidation.php";
	require "../controllers/Authenticate.php";
	if(!isset($_SESSION)){
	session_start();
	 header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

} // end if session set  IsUsernameDouble
	if ( isset( $_SESSION['validuser']) && $_SESSION['validuser'] == "yes") {
	header('Location: login.php');
}// end if session 
	$FirstName = "";
	$Email = "";
	$Username = "";
	$Password = "";
	$GeneralPageMessage = "Enter the appropriate values and click submit to register.";
	$FirstName_EM = "";
	$Email_EM = "";
	$Username_EM = "";
	$Password_EM = "";
	$RegFormValid = true;
if (isset($_POST['submitbutton']) ){
	$NewUser = new Insert();
	$ValidateInputs = new FormValidation();
	$VerifyUsername = new Authenticate();
	if ( isset($_POST) ){
		$FirstName = $_POST['firstname'];
		$Email = $_POST['email'];
		$Username = $_POST['username'];
		$Password = $_POST['password'];
	}
	// Require all fields
	if ( $ValidateInputs->ValidateRequiredField($FirstName) == 'false' 
		|| $ValidateInputs->ValidateInputLength($FirstName, 20, 2) == 'false' || $ValidateInputs->ValidateName($FirstName) == 'false')		{
		$RegFormValid = false; 	$FirstName_EM = "First name is required! Allowed 2 to 20 alphanumeric characters.";
	} // end name validation
	if ( $ValidateInputs->ValidateRequiredField($Email) == 'false' 
		|| $ValidateInputs->ValidateInputLength($Email, 300, 5) == 'false' || $ValidateInputs->ValidateEmail($Email) == 'false')	{
		$RegFormValid = false; 	$Email_EM = "E-mail is required! Enter a valid e-mail between 300 to 5 characters.";
	}
	if ($ValidateInputs->ValidateRequiredField($Username) == 'false' 
		|| $ValidateInputs->ValidateInputLength($Username, 20, 4) == 'false' || $ValidateInputs->ValidateSpecialComment($Username) == 'false')		{
		$RegFormValid = false; $Username_EM = "User name is required!  Allowed 4 to 20 alphanumeric characters.";
	}
	if ($ValidateInputs->ValidateRequiredField($Password) == 'false' 
		|| $ValidateInputs->ValidateInputLength($Password, 20, 4) == 'false' || $ValidateInputs->ValidateSpecialComment($Password) == 'false')	{
		$RegFormValid = false; $Password_EM = "Password is required and must be between 20 to 4 characters long with  alphanumerics and/or !, @, ?, :,-";
	}
	if($VerifyUsername->IsUsernameDouble($Username) == 'true'){
			$RegFormValid = false; $Username_EM = "Please try another username!";
	} // end verify username
	if ( $RegFormValid == false){
		$GeneralPageMessage = "There was an error in your submission. Try again.";
	}
	if ( $RegFormValid == true)	{   // 	function RegisterNewUser($firstnameARG, $emailARG, $passwordARG, $usernameARG){

		$NewUser->RegisterNewUser($FirstName,$Email,$Password, $Username);
		/*
		$FirstName = "";
		$Email = "";
		$Username = "";
		$Password = "";
		$FirstName_EM = "";
		$Email_EM = "";
		$Username_EM = "";
		$Password_EM = ""; **/
		$GeneralPageMessage = 'Submission successfull. Try to <a href="login.php">login</a>.';
	}
}

?>
<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8" />
    <title>Blog site - Registration</title>
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
	<h1>Blog registration </h1>
    <p>Welcome to the registration page </p>
	      <form id="registerform" name="registerform" method="post" action="register.php">
          <label class="regformlabel" for="firstname">First name (Alphabetic characters only between 2 to 20 characters ): </label>
          <input class="regformtextbox" type="text" id="firstname" name="firstname" value="<?php echo $FirstName;?>" />
		  <span class="errorfield"><?php echo $FirstName_EM;?></span>

		  <label class="regformlabel" for="email">Email (Alphabetic characters only between 2 to 20 characters ): </label>
          <input class="regformtextbox" type="text" id="email" name="email" value="<?php echo $Email;?>" />
		  <span class="errorfield"><?php echo $Email_EM;?></span>

          <label class="regformlabel" for="username">Username (Alphanumeric characters, between 5 to 20 characters ):</label>
          <input class="regformtextbox" type="text" id="username" name="username"  value="<?php echo $Username;?>"/>
		  <span class="errorfield"><?php echo $Username_EM;?></span>

          <label class="regformlabel" for="password">Password (Alphanumeric characters only between 5 to 20 characters ): </label>
          <input class="regformtextbox" type="text" id="password" name="password"  value="<?php echo $Password;?>"/>
		  <span class="errorfield"><?php echo $Password_EM;?></span>


          <input type="submit"  id="submitbutton" name="submitbutton" value="Submit" />
		  <input type="reset"  id="resetbutton" name="resetbutton" value="Reset" />

      </form>

	  <h2> <?php echo $GeneralPageMessage; ?></h2>
</body>
</html>
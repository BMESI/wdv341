<?php 
if(!isset($_SESSION)){
 session_start();
 header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		//$message = "Update your info.";
}// end isset session and header control
if ($_SESSION['validuser'] !== "yes") {
	header('Location: logout.php'); 
}// end if session not valid
else{
require "../../Final Project/controllers/Authenticate.php";
require "../../Final Project/controllers/Select.php";
require "../../Final Project/controllers/Update.php";
require "../controllers/FormValidation.php";

	$FirstName = "";
	$Email = "";
	$Password = "";
	$FirstName_EM = "";
	$Email_EM = "";
	$Username_EM = "";
	$Password_EM = "";
	$RegFormValid = true;
	$Login = new Authenticate();
	$UpdateInfo = new Update();
	$ValidateInputs = new FormValidation();
	$VerifyUsername = new Authenticate();

//require "../../Final Project/models/Event.php";

if( isset($_SESSION['validuser'] ) ){
	$GeneralPageMessage = "Account update";
	if( $_SESSION['validuser'] == 'yes'){
		// set welcome msg and control panel options
		$message = "Update your info.";
	}// end check for validate user
 }// end check for session instantiation

	if( $_SESSION['validuser'] == 'yes'){
		$FirstName = $Login->SelectForUserUpdate($_SESSION['username'],$_SESSION['userpassword'])[0];
		$Email = $Login->SelectForUserUpdate($_SESSION['username'],$_SESSION['userpassword'])[1];
		$Password = $Login->SelectForUserUpdate($_SESSION['username'],$_SESSION['userpassword'])[2];
		$Username = $Login->SelectForUserUpdate($_SESSION['username'],$_SESSION['userpassword'])[3];
		$UserID = $Login->SelectForUserUpdate($_SESSION['username'],$_SESSION['userpassword'])[4];
		if (isset($_POST['updatebutton']) ){
				$FirstName = $_POST['firstname'];
				$Email = $_POST['email'];
				$Username = $_POST['username'];
				$Password = $_POST['password'];
							
				/*
				if($VerifyUsername->IsUsernameDouble($Username) == 'true'){
					$RegFormValid = false; $Username_EM = "Please try another username!";
				} // end verify username
				*/
				if ( $RegFormValid == false){
					$GeneralPageMessage = "There was an error in your submission. Try again.";
				}
				if ( $RegFormValid == true)	{   // 	function RegisterNewUser($firstnameARG, $emailARG, $passwordARG, $usernameARG){

					if ( $UpdateInfo->UpdateUserInfo($UserID, $Username,$Password, $FirstName, $Email) == true ) {
											$GeneralPageMessage = 'Update successfull. Try to <a href="login.php">login</a>.';
											$_SESSION['username']  = $Username;
											$_SESSION['userpassword'] = $Password;
					}else{
											$GeneralPageMessage = 'Submission failed. Try to again.';
					}

				}

		} // end update button
		}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Blog - Update Account page</title>
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
	<h1>Blog - <?php echo $GeneralPageMessage; ?></h1>
    <p>Welcome to the update page </p>
	      <form name="updateinfoform" method="post" action="updateInfo.php">
          <label for="firstname">First name (Alphabetic characters only between 2 to 20 characters ): </label>
          <input type="text" id="firstname" name="firstname" value="<?php echo $FirstName;?>" />
		  <span class="errorfield"><?php echo $FirstName_EM;?></span>

		            <label for="email">Email (Alphabetic characters only between 2 to 20 characters ): </label>
          <input type="text" id="email" name="email" value="<?php echo $Email;?>" />
		  <span class="errorfield"><?php echo $Email_EM;?></span>

          <label for="username">Username (Alphanumeric characters, between 5 to 20 characters ):</label>
          <input type="text" id="username" name="username"  value="<?php echo $Username;?>"/>
		  <span class="errorfield"><?php echo $Username_EM;?></span>

          <label for="password">Password (Alphanumeric characters only between 5 to 20 characters ): </label>
          <input type="text" id="password" name="password"  value="<?php echo $Password;?>"/>
		  <span class="errorfield"><?php echo $Password_EM;?></span>


          <input type="submit"  id="updatebutton" name="updatebutton" value="Update" />
		  <input type="reset"  id="resetbutton" name="resetbutton" value="Reset" />

      </form>


</body>
</html>

<?php  }
?>
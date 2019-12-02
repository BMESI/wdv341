<?php 
/*
	if user is valid (Session variable - already logged on)
	display admin options
else
    if form has been submitted
        Get input from $_POST
        Create SELECT QUERY
        Run SELECT to determine if they are valid username/password
        if user if valid
            set Session variable to true
            display admin options
        else
            display error message
            display login form
    else
    display login form

	*/
//header('Cache-Control: no-cache, must-revalidate');
require "../../UNIT 11 - PHP-SQL Login and Protected Pages/controllers/Authenticate.php";
require "../../UNIT 11 - PHP-SQL Login and Protected Pages/controllers/Select.php";
require "../../UNIT 11 - PHP-SQL Login and Protected Pages/models/Event.php";

if(!isset($_SESSION)){
session_cache_limiter('none');
	session_start();
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

} // end if session set
$OptionSelected = "";
$message = "";
	if( isset($_SESSION['validuser']) ){
		if ($_SESSION['validuser'] == "yes"){
			$message = "Welcome Back " . $_SESSION['username'] ."! ";	
			$NewEvent = new Event();
			$LoadEvents = new Select();
				if (isset($_POST['show']) ){
				$OptionSelected = "Current events in Database";


				}// end if post show
				if (isset($_POST['new']) ){
				$OptionSelected = "Add events to Database";


				}// end if post show
		}// end if session valid yes
	}// end if session valid yes

				if( isset($_POST['login']) ){
					$username = $_POST['username'];
					$password = $_POST['userpassword'];
					$Login = new Authenticate();
					/*
					start query 
					*/
					if ($Login->EventUserLogOn($username,$password) == 'true'){
						$_SESSION['validuser'] = "yes";			
						$_SESSION['username'] = $username;
						$message = "Welcome Back $username!";
					} // end log on function
					else{
						$_SESSION['validuser'] = "no";					
						$message = "Log-in failed... creds are false"; //. $Login->EventUserLogOn($username,$password);
						//header('Location: ../../UNIT 11 - PHP-SQL Login and Protected Pages/views/login.php'); 
					} // end else err mesg
				} // end if set post login
	if( isset($_POST['reset']) ){
		$username = "";
		$password = "";
	}// end if reset
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Main page</title>
	   <link rel="stylesheet" href="../style/style.css">

   </head>
<body>
	<div class="instructionarea">
	<h3>
	 UNIT-11 PHP-SQL Login and Protected Pages: Assignment one
	</h3>
	<h3>
	This assignment will create a login page.  This page will control access to all of the other pages in your application.  The page performs a variety of functions all within the one page.
	</h3>
	<h4> <?php echo $message ?></h4>
	</div>
<?php 
	if (  isset($_SESSION['validuser']) && $_SESSION['validuser'] == 'yes'){

		?>
        <div class="optionsContainer">
			<h4> <?php echo $message ?></h4>
				<h3> User option(s)</h3>
				<hr>
		<form method="post" name="paneldbfuncs"action="login.php">
				<span class="error"></span>
			<input type="submit" name="home" id="home" value="Home"class="options"/>
		    <input type="submit" name="new" id="new" value="Add new presenter(s)"class="options"/>
			<input type="submit" name="show" id="show" value="Show presenter(s)"class="options"/>
			     <br> <br> <hr>
			<p><a href="logout.php">Logout of Presenters Admin System</a></p>	

		</form>
		</div>

        <div class="eventBlock">	
		<h3> <?php echo $OptionSelected;?></h3>
		<div>
		<?php 				
		if (isset($_POST['home']) ){ 
			header('Location: login.php'); 
		} // end if isset show
		if (isset($_POST['show']) ){ 
			include "showEvents.php";
		} // end if isset show
		if (isset($_POST['new']) ){ 

			include "addnewEvent.php";

		} // end if isset show
		if(isset($_GET['Message'])){
			echo "<h1>" . $_GET['Message'] . "</h1>";
		}
			if(isset($_GET['event_id'])){
				$_SESSION['event_id'] = $_GET['event_id'];
			}// end session 			
			?>
            </div>
        </div>

	<?php 
		}// end if valid user sess
		else{    
?>
    <form method="post" name="loginform" action="login.php">
        <div class="fieldsContainer">
				<span class="error"><?php 	echo $message;?></span>
            <label for="username>">Username:</label>
            <input type="text" name="username" id="username" />
            <label for="userpassword>">Password:</label>
            <input type="password" name="userpassword" id="userpassword" />
		    <input type="submit" name="reset" id="reset" value="Reset"/>
			<input type="submit" name="login" id="login" value="Login"/>
		</div>
    </form>
	<?php 
	}// end else for if not valid session
	?>
</body>
</html>
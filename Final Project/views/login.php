<?php 
require "../../Final Project/controllers/Authenticate.php";
require "../../Final Project/controllers/Select.php";
	$Login = new Authenticate();

//require "../../Final Project/models/Event.php";
if(!isset($_SESSION)){
session_cache_limiter('none');
 session_start();
 //header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		$Message = "Welcome. Please log in.";
}// end isset session and header control
if( isset($_SESSION['validuser'] ) ){

	if( $_SESSION['validuser'] == 'yes'){
		// set welcome msg and control panel options
		$Message = "Welcome to your control panel.";
	}// end check for validate user
}// end check for session instantiation
if (isset($_POST['username']) ){
	$Username = $_POST['username'];
	$Password = $_POST['userpassword'];
	if( $Login->UserLogOn($Username,$Password) == 'true'){

		$_SESSION['validuser']  = 'yes';
		$_SESSION['username']  = $Username;
		$_SESSION['userpassword'] = $Password;
		$Message = "Welcome to your control panel " . $Login->RetrieveUserStuff($Username,$Password)[0];
	}else{
		$_SESSION['validuser']  = 'no';
		$Message = "Welcome. Please log in.";
	}// end if logon good/bad
}// end check login submission
	if( isset($_POST['reset']) ){
		$Username = "";
		$Password = "";
	}// end if reset
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Blog - login page</title>
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
	<h3>
	</h3>
<?php 
	if (  isset($_SESSION['validuser']) && $_SESSION['validuser'] == 'yes'){
		?>
        <div class="">
			<h4> <?php echo $Message  .' '. $Login->RetrieveUserStuff($_SESSION['username'], $_SESSION['userpassword'])[0] . " " .  $Login->RetrieveUserStuff($_SESSION['username'], $_SESSION['userpassword'])[1];?></h4>
				<h3></h3>
				<hr>
		<form method="post" name="loginform" action="login.php">
				<span class="error"></span>
			<input type="submit" name="home" id="home" value="Home"class="options"/>
		    <input type="submit" name="new" id="new" value="Add new blog"class="options"/>
			<input type="submit" name="show" id="show" value="Show your blog(s)"class="options"/>
			<input type="submit" name="update" id="update" value="Update your info"class="options"/>
			     <br> <br> <hr>
			<p><a href="logout.php">Logout of blog site</a></p>	

		</form>
		</div>

        <div class="">	
		<h3> <?php ?></h3>
		<div>
		<?php 				
		if (isset($_POST['home']) ){ 
			header('Location: login.php'); 
		} // end if isset show
		if (isset($_POST['show']) ){ 
			header("Location: blogsValidUser.php");

		} // end if isset show
		if (isset($_POST['new']) ){ 
			header("Location: addnewBlog.php");

		} // end if isset show
				if (isset($_POST['update']) ){ 
			header("Location: updateInfo.php");

		} // end if isset show
		if(isset($_GET['Message'])){
			echo "<h1>" . $_GET['Message'] . "</h1>";
		}
		if(isset($_GET['post_ID'])){
			$_SESSION['UpdateID'] = $_GET['post_ID'];
		}// end session 			
			?>
            </div>
        </div>

	<?php 
		}// end if valid user sess
		else{
?>
    <form method="post" name="loginform" action="login.php">
        <div class="loginpane">
				<span class="error"><?php 	echo $Message;?></span>
            <label id="usernamelabel" for="username>">Username:</label>
            <input type="text" name="username" id="username" />
            <label id="userpasswordlabel" for="userpassword>">Password:</label>
            <input type="text" name="userpassword" id="userpassword" />
		    <input type="submit" name="reset" id="resetlogin" value="Reset"/>
			<input type="submit" name="login" id="login" value="Login"/>
		</div>
    </form>
	<?php 
	}// end else for if not valid session
	?>
</body>
</html>
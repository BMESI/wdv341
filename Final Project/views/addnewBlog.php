<?php
if(!isset($_SESSION)){
	session_start();
	 header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

} // end if session set
if ($_SESSION['validuser'] !== "yes") {
	header('Location: login.php');
}// end if session 
else{
$Login=  "login.php";
require "../../Final Project/controllers/FormValidation.php";
require("../../Final Project/controllers/Insert.php");
//require $Login;
// input values
$title= "";
$post = "";
	$author= $_SESSION['username']; //$_POST['author'];
$tags = "";
$time = "";
$date_created ="";
// error and other messages 
$title_EM= "";
$post_EM= "";
$author_EM= "";
$tags_EM = "";
$SuccessStatement = "Successfull!";
$FailStatement = "Submission failed!";

// bool values
$FormValid = true;
$InsertComplete = false;
$Message = "";
$IDValid = true;
$Insert = new Insert();


if( isset($_POST['addbutton']) ){
	$validateupdate = new FormValidation();
	// assign post values
	//$event_id = $_GET['event_id'];
	$title= $_POST['title'];
	$post = $_POST['post'];
	$tags = $_POST['tags'];
	// end post values 
	// begin validation

	if ($validateupdate->ValidateSpecialComment($title) == 'false'   ||   $validateupdate->ValidateRequiredField($title) == 'false'		
		|| $validateupdate->ValidateInputLength($title,100,4) == 'false'  ) {
		$FormValid = false;
			if ( $validateupdate->ValidateRequiredField($title) == 'false') {
				$title_EM= "Title is required!";
			} // end if ValidateSpecialComment
			if ( $validateupdate->ValidateSpecialComment($title) == 'false') {
				$title_EM= "Only legal characters accpeted: Alphanumeric or '!' , '@' ,'?' ,'.' , '-', ',' ";
			} // end if ValidateSpecialComment
			if ( $validateupdate->ValidateInputLength($title,40,4) == 'false' ){
				$title_EM= "Title must be between 100 to 4 characters!";
			}// end if valid length
	} // end if $title
	if($validateupdate->ValidateSpecialComment($post) == 'false'    ||   $validateupdate->ValidateRequiredField($post) == 'false'
		|| $validateupdate->ValidateInputLength($post,5000,4) == 'false' ){
		$FormValid = false;
			if ( $validateupdate->ValidateRequiredField($post) == 'false') {
				$post_EM= "A main post entry is required!";
			} // end if ValidateSpecialComment
			if ( $validateupdate->ValidateSpecialComment($post) == 'false') {
				$post_EM= "Only legal characters accpeted: Alphanumeric or '!' , '@' ,'?' ,'.' , '-', ',' ";
			} // end if ValidateSpecialComment
			if ( $validateupdate->ValidateInputLength($post,5000,4) == 'false' ){
				$post_EM= "Blog post must be between 5000 to 4 characters!";
			}// end if valid length
	}// end if $post
	if ($validateupdate->ValidateSpecialComment($author) == 'false'    ||   $validateupdate->ValidateRequiredField($author) == 'false'
		|| $validateupdate->ValidateInputLength($author,20,2) == 'false'){
		$FormValid = false;
			if ( $validateupdate->ValidateRequiredField($author) == 'false') {
				$author_EM= "Author name is required!";
			} // end if ValidateSpecialComment
			if ( $validateupdate->ValidateSpecialComment($author) == 'false') {
				$author_EM= "Only legal characters accpeted: Alphanumeric or '!' , '@' ,'?' ,'.' , '-', ',' ";
			} // end if ValidateSpecialComment	}
			if ( $validateupdate->ValidateInputLength($author,20,2) == 'false' ){
				$author_EM= "Author name must be between 20 to 2 characters!";
			}// end if valid length
	}// end if $author

	if ($validateupdate->ValidateSpecialComment($tags) == 'false'    ||   $validateupdate->ValidateRequiredField($tags) == 'false'
		|| $validateupdate->ValidateInputLength($tags,20,2) == 'false'){
		$FormValid = false;
			if ( $validateupdate->ValidateRequiredField($tags) == 'false') {
				$tags_EM= "Tags name is required!";
			} // end if ValidateSpecialComment
			if ( $validateupdate->ValidateSpecialComment($tags) == 'false') {
				$tags_EM= "Only legal characters accpeted: Alphanumeric or '!' , '@' ,'?' ,'.' , '-', ',' ";
			} // end if ValidateSpecialComment	}
			if ( $validateupdate->ValidateInputLength($tags,20,2) == 'false' ){
				$tags_EM= "Tags need to be between 20 to 2 characters!";
			}// end if valid length
	}// end if $author

		if( $FormValid == true ){
		 	date_default_timezone_set('America/Chicago');
			$date_created = date("Y/m/d");
			$time = date("g:i A");


			$Insert->InsertPost($title, $author, $post, $date_created, $time, $tags);
			$InsertComplete = $FormValid;
			$Message = "Post completed!";
			// move to main page when done , show message to confirm completion...
			header("Location: login.php?Message=".$Message); 

		}// end if valid 
		else{
			$FormValid = false;
			$Message = " Posting not completed! Check your fields.";
			//$_GET['Message'] = $Message;
		}// end if valid 
} // end submit if}
if ( isset($_POST['resetbutton']) ){
	$title= "";
	$post = "";
	$author= "";

	// errors 
	$title_EM= "";
	$post_EM= "";
	$author_EM= "";

}// end reset if


?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Blog site - new blog post</title>
		<link rel="stylesheet" href="styles/mainstyle.css">

	<style>

</style>
</head>
<body>
<ul class="bar">
			<li><a href="main.php">Home</a></li>
			<li><a href="contact.php">Contact</a></li>
			<li><a href="blogs.php">Blogs</a></li>
			<li><a href="register.php">Register</a></li>
			<li><a  class="lastitem" href="login.php">Login</a></li>
	</ul>
<div class="">
	<div class="">
  <h3>Blog - New entry <?php echo $Message; ?></h3>
    <h4>Post a small blog to this website.  </h4>
	<hr>
	</div>
<form name="newblogform" method="post" action="addnewBlog.php">

	 <p>        
        <label for="title">Blog entry title (100 character limit):</label>
        <input type="text" name="title" id="title" 
					value="<?php echo $title;?>"></br>
		<span class="error">  <?php echo $title_EM;  ?> </span>
      </p>

      <p>
        <label for="post">Blog entry (3000 character limit):</label>
		<textarea name="post" id="post" ><?php  echo $post;?></textarea> </br>
		<span class="error">  <?php echo $post_EM;  ?> </span>
      </p>
      <p>
	  <p>
        <label for="tags">Blog tag(s) (3000 character limit):</label>
		<textarea name="tags" id="tags" value="<?php  echo $tags;?>"></textarea> </br>
		<span class="error">  <?php echo $tags_EM;  ?> </span>
      </p>
      <p>
        <label for="author">Your name as it will appear:</label>
		<?php  echo $author;?></br>
      </p>
	  </fieldset>

  <p>
     <input type="submit" name="resetbutton" id="resetbuttonid" value="Reset">
    <input type="submit" name="addbutton" id="submitbuttonid" value="Add">
  </p>
</form>
</div>

</body>
</html>
<?php 
	//header('Location: login.php');

} // end if active user else


?>
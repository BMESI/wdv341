<?php 
if(!isset($_SESSION) ){
	session_start();
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
} // end isset session_start
if ( $_SESSION['validuser'] !== 'yes'){
	header("Location main.php");
}/// end if valid user
else{

	$Login=  "login.php";
	require "../../Final Project/controllers/FormValidation.php";
	require("../../Final Project/controllers/Insert.php");
	require("../../Final Project/controllers/Update.php");
	require $Login;
	$title_EM= "";
	$post_EM= "";
	$author_EM= "";
	$tags_EM = "";
	$SuccessStatement = "Successfull!";
	$FailStatement = "Submission failed!";
	$FormValid = true;
	$InsertComplete = false;
	$Message = "";
	$IDValid = true;
	$Update = new Update();
	$Select = new Select();
	if(isset($_GET['post_ID']) && $_GET['post_ID'] !== ''){

	// input values
		$_SESSION['UpdateID'] = $_GET['post_ID'];
		$UpdateID = $_SESSION['UpdateID'];

		$title= $Select->GetBlogByID($UpdateID,$_SESSION['username'])->getTitle();
		$post =  $Select->GetBlogByID($UpdateID,$_SESSION['username'])->getPost();
		$tags =  $Select->GetBlogByID($UpdateID,$_SESSION['username'])->getTags();
	}// end if isset get

if( isset($_POST['updatebutton']) ){
	$validateupdate = new FormValidation();
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
	} // end if ValidateInputLength time
		if( $FormValid == true ){
			$date_edited = date("Y/m/d");
			//	function UpdateSinglePost($postidARG, $titleARG, $postARG, $date_edited){
			$Update->UpdateSinglePost($UpdateID,$title,$post,$date_edited, $tags);
			$InsertComplete = $FormValid;
			$Message = "Update completed!";
		}// end if valid 
		else{
			$FormValid = false;
			$Message = "Update not completed!";
		}// end if valid 
} // end submit if}
if ( isset($_POST['resetbutton']) ){
	$title= "";
	$post= "";
	$author= "";
	$tags = "";
	$title_EM= "";
	$post_EM= "";
	$author_EM= "";
	$tags_EM = "";
}// end reset if
{
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Event update</title>
	   <link rel="stylesheet" href="style/style.css">
<style>
</style>
</head>
<body>

<div class="">
	<div class="">
  <h3>Blog - New entry <?php echo $Message; ?></h3>
    <h4>Post a small blog to this website.  </h4>
	<hr>
	</div>
<form name="updateblogform" method="post" action="updateBlogPost.php">

		  <fieldset> <legend> Event name, description and presenter info - only use alphanumerics and/or '!' , '@' ,'?' ,'.' , '\', ','</legend>
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

	  </fieldset>

  <p>
     <input type="submit" name="resetbutton" id="resetbuttonid" value="Reset">
    <input type="submit" name="updatebutton" id="submitbuttonid" value="Update">
  </p>
</form>
</div>

</body>
</html>
<?php 
} // end if active user else
?>
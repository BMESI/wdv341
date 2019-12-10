<?php 
if(!isset($_SESSION) ){
	session_start();
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	$ShowCount = 0;
						$_SESSION['page'] = 0;

}
else{
$_SESSION['page']= 5 ;
$UserName = $_SESSION['username'];
}
if ($_SESSION['validuser'] == 'yes'){

// load list by title, author and date. 
require "../../Final Project/models/BlogPostModel.php";
require "../../Final Project/controllers/Select.php";

//$Blogs = new BlogPostModel();
$Select = new Select();




if(isset($_POST['showmore'])  ) {
	$_SESSION['page'] = $_SESSION['page'] + 5;
	//$_SESSION['page'] =$ShowCount;
	$ShowCount =$_SESSION['page'];
						

}
if(isset($_POST['backtotop'])  ) {
	//$ShowCount = $ShowCount + 1;
		//	$_SESSION['page'] = $ShowCount;
					$_SESSION['page'] = 0;
						$ShowCount =$_SESSION['page'];

}

?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8" />
    <title> Blog - Read</title>
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
<h1> You have <?php  echo  count($Select->CheckBlogsCountByID($_SESSION['username'] ));?>  past blog(s) showing currently</h1><hr>

	<?php  
		if (  $_SESSION['page']  >=  count($Select->CheckBlogsCountByID($_SESSION['username']))   ){
		$ShowCount = 0;
		$_SESSION['page'] = 0;		
		} // end if session > rowcount
		for ($a = 0; $a < count($Select->CheckBlogsCountByID($_SESSION['username'])); $a++) { 
	
	?>
	<div class="generalblogs">

<form name="priorblogs" id="priorblogs" method="post" action="blogsValidUser.php?ShowCount=<?php echo $_SESSION['page']; ?>">
<h3 class="deleteoption"> <a href='deleteBlog.php?post_ID=<?php  echo $Select->GetBlogByID($_SESSION['username'])[$a]->getpost_ID();?>'>Delete</a></h3>
<h3> <?php echo $Select->GetBlogByID($_SESSION['username'])[$a]->getpost_ID(); ?></h3>
<h3> <?php echo $Select->GetBlogByID($_SESSION['username'])[$a]->getTitle(); ?></h3>
<h4> <?php echo $Select->GetBlogByID($_SESSION['username'])[$a]->getAuthor(); ?></h4>
<h3><?php echo  $Select->GetBlogByID($_SESSION['username'])[$a]->getDate_created() ; ?></h3>
<h3><?php echo  $Select->GetBlogByID($_SESSION['username'])[$a]->getTime(); ?></h4>
<p><?php  echo $Select->GetBlogByID($_SESSION['username'])[$a]->getPost(); ?></p>
<p>Tags:<?php echo $Select->GetBlogByID($_SESSION['username'])[$a]->getTags(); ?></p>

</div><?php  }// end loop?>

<div class="blognavigation">
<input type="submit" name="showmore" id="showmore" value="showmore">
 <input type="submit" name="backtotop" id="backtotop" value="backtotop">
 </div>
</form>


</body>
</html>
<?php 

}else{
	header("Location: login.php");

}?>


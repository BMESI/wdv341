<?php 
// load list by title, author and date. 
require "../../Final Project/models/BlogPostModel.php";
require "../../Final Project/controllers/Select.php";
//$Blogs = new BlogPostModel();
$Select = new Select();

if(!isset($_SESSION) ) {
 session_start();
$ShowCount = 0;

}else{
$_SESSION['page']= 5 ;

}


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
<h1 class="blogreadingsheader">Blogs from today and before</h1>
<div class="todaysblogs">

<h1>Today''s posts</h1><hr>
	<?php 
	if ( count($Select->CheckBlogsCountToday() ) > 0){
	
	for ($a = 0; $a < sizeof($Select->ViewBlogsToday() ) ; $a++) { ?>
<h3><?php  echo $Select->ViewBlogsToday()[$a]->getTitle(); ?></h3>
<h4 class="author"> <?php  echo "By " . $Select->ViewBlogsToday()[$a]->getAuthor() . " , written on " . $Select->ViewBlogsToday()[$a]->getDate_created()  . ", at " . $Select->ViewBlogsToday()[$a]->getTime(); ?></h4>
<p><?php  echo $Select->ViewBlogsToday()[$a]->getPost(); ?></p>
  <p class="tags"> Tags: <?php echo $Select->ViewBlogsToday()[$a]->getTags();
	}  

} // end if 
else{
	echo "<p class='noposttoday'> Nothing posted today...</p>";
}


?></p>
</div>

<div class="generalblogs">
<h1> <?php  echo count($Select->CheckBlogsCount()); ?>  past blogs showing currently</h1><hr>

	<?php  
	if (  $_SESSION['page']  >=  count($Select->CheckBlogsCount())   ){
		$ShowCount = 0;
		$_SESSION['page'] = 0;		
		} // end if session > rowcount
	for ($a = 0; $a < sizeof($Select->ViewBlogsLimited($ShowCount ) ); $a++) { 
	?>
<form name="priorblogs" id="priorblogs" method="post" action="blogs.php?ShowCount=<?php echo $_SESSION['page']; ?>">
<h3><?php  echo $Select->ViewBlogsLimited($ShowCount)[$a]->getpost_ID(). " - ". $Select->ViewBlogsLimited($ShowCount)[$a]->getTitle(); ?></h3>
<h4 class="author"> <?php  echo "By " . $Select->ViewBlogsLimited($ShowCount)[$a]->getAuthor() . " , written on " . $Select->ViewBlogsLimited($ShowCount)[$a]->getDate_created()  . ", at " . $Select->ViewBlogsLimited($ShowCount )[$a]->getTime(); ?></h4>
<p><?php  echo $Select->ViewBlogsLimited($ShowCount)[$a]->getPost(); ?></p>
<p class="tags">Tags:
<?php
 echo $Select->ViewBlogsLimited($ShowCount)[$a]->getTags(); ?></p>

 <?php } // end loop?> 	
</div>
<div class="blognavigation">
<input type="submit" name="showmore" id="showmore" value="Show more">
 <input type="submit" name="backtotop" id="backtotop" value="Back to top">
 </div>
</form>


</body>
</html>
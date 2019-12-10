<?php 
if(!isset($_SESSION) ){
	session_start(); 	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
}
if ($_SESSION['validuser'] == 'yes'){

include "../../Final Project/Controllers/Delete.php";
include "../../Final Project/Views/Login.php";

$Delete = new Delete();
$DeletePostID = "";
$Message = "Nothing.";
	if(isset($_GET['post_ID'])  && $_GET['post_ID'] !== ""){
		$DeletePostID = $_GET['post_ID'];
		$Message = "Post ID marked for deletion.";

	}// end if isset get pid
	else
	{				
		$Message = "Event not deleted! Please try again.";
	?> 
		<h2> Event deletion failed! CLick link to go back: <a href="login.php">back</h2>
	<?php
	} // end else
	if ( $Delete->DeleteSinglePost($DeletePostID) == "Delete successfull...hope you picked the right post!" ) {
		$Message = "Event  deleted! Press select to reload the event list.";
		header('Location: login.php?Message='.$Message); 
		

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Blog - Delete post</title>
	<style>

</style>
<div id="deletearea">
<h3> <?php  ?></h3>
<form name="deleteblogform" method="GET" action="login.php">

</div>

</body>
</html>
<?php }// end if delete 
else{
	}
}
else{
header('Location: login.php'); 
}
?>
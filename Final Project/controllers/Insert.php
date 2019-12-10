<?php 
require_once("connection.php");

class Insert{

// contructor 
 function __construct(){

	} // end constr
function InsertPost($titleARG, $authorARG, $postARG, $date_createdARG,$post_time_ARG, $tagsArg){
	try{
		global $Connection, $FormValid;
		$SQLStatement_Insert = "INSERT INTO app_users_posts (title, author, post, date_created, date_edited, post_time, tags) VALUES (:title, :author, :post, :date_created, :date_edited, :post_time, :tags);";
		$PreparedInsert = $Connection->prepare($SQLStatement_Insert);
		if( $Connection == true ){
			  $PreparedInsert->bindParam(":title", $titleARG);  
			  $PreparedInsert->bindParam(":author", $authorARG);
			  $PreparedInsert->bindParam(":post", $postARG);
			  $PreparedInsert->bindParam(":date_created", $date_createdARG);
			  $PreparedInsert->bindParam(":date_edited", $date_createdARG);
			  $PreparedInsert->bindParam(":post_time", $post_time_ARG);
			  $PreparedInsert->bindParam(":tags", $tagsArg);
			  $PreparedInsert->execute();
			} // end if valid
			$Connection = null;
		}// end try
		catch(PDOException $Error){
			echo "<br>  Insert failed: " . $Error->getMessage();
	
		} // end caatch		

	}// end function ins post
	function RegisterNewUser($firstnameARG, $emailARG, $passwordARG, $usernameARG){
	try{
		global $Connection, $FormValid;
		$SQLStatement_Insert = "INSERT INTO app_users (firstname, email, password, username) VALUES (:firstname, :email, :password, :username);";
		$PreparedInsert = $Connection->prepare($SQLStatement_Insert);
		if( $Connection){
			  $PreparedInsert->bindParam(":firstname", $firstnameARG);  
			  $PreparedInsert->bindParam(":email", $emailARG);
			  $PreparedInsert->bindParam(":password", $passwordARG);
			  $PreparedInsert->bindParam(":username", $usernameARG);
			  $PreparedInsert->execute();
			} // end if valid
			$Connection = null;
		}// end try
		catch(PDOException $Error){
			echo "<br>  Insert failed: " . $Error->getMessage();
	
		} // end caatch		

	}// end function
} // end class


?>
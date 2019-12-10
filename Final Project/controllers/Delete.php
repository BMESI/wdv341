<?php 
$ConnectionFile = "connection.php";
require_once($ConnectionFile);
		
  class Delete{

	function __construct(){

	}// end constr
	function DeleteSinglePost($post_IDARG){
		try{
			$Results =  ['<span class="error">No matching record(s)...</span>'];
			$inta = 0;
			global $Connection;
			if ($post_IDARG == ""){
				return $Results;
			}else{
			if ( $Connection ){
				$SQLDeleteStatement = $Connection->prepare("DELETE FROM app_users_posts WHERE post_ID= :post_ID");
					$SQLDeleteStatement->bindParam(':post_ID', $post_IDARG);
					$SQLDeleteStatement->execute();	
					$Results = ["Delete successfull...hope you picked the right record!"];
			} // end if connection
				else{
					$Results =  ['<span class="error">No database connection made...</span>'];
				} // end inner esle
			}// end outer else
			$Connection = null;
			 return $Results;
		}// end try
		catch(PDOException $Error){
			$Results = ["<td>Nothing to view...Try some other time...</td>"];		
			return $Results;
		}/// end catch
	}// end DeleteSinglePost
  }// end class


?>
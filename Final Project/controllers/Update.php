<?php 

$ConnectionFile = "connection.php";
 $ValidationFie = "FormValidation.php";
        require_once($ConnectionFile);
		//include_once $ValidationFie;
		
  class Update{

	function __construct(){

	}// end constr
	function UpdateUserInfo($UserIDARG, $Username,$Password, $FirstName, $Email){
		try{
			$UpdatePassed = false;
			$inta = 0;
			global $Connection;
			if ($UserIDARG == ""){
				return $UpdatePassed;
			}
			else{
				if ( $Connection ){
					$SQLUpdateStatement = $Connection->prepare("UPDATE app_users SET firstname = :firstname, email = :email, password = :password, username = :username  WHERE app_id =:app_id");
					$SQLUpdateStatement->bindParam(':app_id', $UserIDARG);
					$SQLUpdateStatement->bindParam(':firstname', $FirstName);
					$SQLUpdateStatement->bindParam(':email', $Email);
					$SQLUpdateStatement->bindParam(':password', $Password);
					$SQLUpdateStatement->bindParam(':username', $Username);

					$SQLUpdateStatement->execute();	
					$UpdatePassed = true;
				} // end if connection
				else{
					$UpdatePassed = false;
				} // end inner esle
			}// end outer else
			$Connection = null;
			 return (boolval($UpdatePassed) ? 'true' : 'false');
		}// end try
		catch(PDOException $Error){
			$UpdatePassed = false;	
			 return (boolval($UpdatePassed) ? 'true' : 'false');
		}/// end catch
	}// end UpdateSingleEvent
  }// end class

?>
<?php 
$ConnectionFile = "connection.php";
 $ValidationFie = "FormValidation.php";
require_once("connection.php");
		
  class Authenticate{
		protected $MaxUsernameLength = 15;
		protected $MaxUserPasswordLength = 10;
		protected $ValidUsernameRegex = "[a-zA-Z0-9]";
		protected $ValidUserPasswordRegex = "[a-zA-Z0-9]";
	function __construct(){

	}// end constr
	function UserAuthenticate($UsernameArg, $UserpasswordArg){
		$ReturnBool = true;
			if (  strlen($UsernameArg) > $this->MaxUsernameLength || strlen($UserpasswordArg) > $this->MaxUserPasswordLength){
						$ReturnBool = false;
			} // end first if branch
			if ( preg_match($UsernameArg, $this->ValidUsernameRegex) == 0  ){
						$ReturnBool = false;
			} // end first if branch
		return (boolval($ReturnBool) ? 'true' : 'false'); 
	} // end auth func
	function UserLogOn($UsernameArg, $UserpasswordArg){
		try{
			global $Connection;
			$ReturnBool = false;
			if ($Connection ){
				$SQLSelectStatement = $Connection->prepare("SELECT username, password FROM app_users WHERE username = :username AND password = :password ");
				$SQLSelectStatement->bindParam(":username",$UsernameArg);
				$SQLSelectStatement->bindParam(":password",$UserpasswordArg);
				$SQLSelectStatement->execute();
				if ( $SQLSelectStatement->rowCount() == 1){
									$ReturnBool = true;
				} // end if rowcount 1
				else{
									$ReturnBool = false;					
				}
				 return (boolval($ReturnBool) ? 'true' : 'false'); 
				 //Connection = null;
			}// end if connectio

		$Connection = null;
		}// end try
		catch(PDOException $Error){

		}/// end catch
	}// end logon
		function SelectForUserUpdate($UsernameArg, $UserpasswordArg){
		try{
			global $Connection;
			$ReturnStuff = [""];
			if ($Connection ){
				$SQLSelectStatement = $Connection->prepare("SELECT app_id, firstname, email, password, username FROM app_users WHERE username = :username AND password = :password ");
				$SQLSelectStatement->bindParam(":username",$UsernameArg);
				$SQLSelectStatement->bindParam(":password",$UserpasswordArg);
				$SQLSelectStatement->execute();
				if ( $SQLSelectStatement->rowCount() == 1){
					foreach($SQLSelectStatement->fetchall(PDO::FETCH_ASSOC) as $row) {
						$ReturnStuff[0] = $row['firstname'];
						$ReturnStuff[1] = $row['email'];
						$ReturnStuff[2] = $row['password'];
						$ReturnStuff[3] = $row['username'];
						$ReturnStuff[4] = $row['app_id'];

					}// end loop
				} // end if rowcount 1
				else{
									$ReturnStuff = ["n/a"];					
				}
				 return $ReturnStuff;
			}// end if connectio

		//$Connection = null;
		}// end try
		catch(PDOException $Error){

		}/// end catch
	} // end retrieval
	function RetrieveUserStuff($UsernameArg, $UserpasswordArg){
		try{
			global $Connection;
			$ReturnStuff = [""];
			if ($Connection ){
				$SQLSelectStatement = $Connection->prepare("SELECT firstname, email FROM app_users WHERE username = :username AND password = :password ");
				$SQLSelectStatement->bindParam(":username",$UsernameArg);
				$SQLSelectStatement->bindParam(":password",$UserpasswordArg);
				$SQLSelectStatement->execute();
				if ( $SQLSelectStatement->rowCount() == 1){
					foreach($SQLSelectStatement->fetchall(PDO::FETCH_ASSOC) as $row) {
						$ReturnStuff[0] = $row['firstname'];
						$ReturnStuff[1] = $row['email'];
					}
				} // end if rowcount 1
				else{
									$ReturnStuff = ["n/a"];					
				}
				 return $ReturnStuff;
				 //Connection = null;
			}// end if connectio

		$Connection = null;
		}// end try
		catch(PDOException $Error){

		}/// end catch
	} // end retrieval
	/*
	Make sure that if a user wants to register, that the username is at least not a duplicate in the database..
	*/
	function IsUsernameDouble($UsernameArg){
		try{
			global $Connection;
			$ReturnStuff = [""];
			if ($Connection ){
				$SQLSelectStatement = $Connection->prepare("SELECT username FROM app_users WHERE username = :username");
				$SQLSelectStatement->bindParam(":username",$UsernameArg);
				$SQLSelectStatement->execute();
				if ( $SQLSelectStatement->rowCount() == 1){
					$ReturnBool = true;
				} // end if rowcount 1
				else{
					$ReturnBool = false;
				}
				 return $ReturnBool;
				 //Connection = null;
			}// end if connectio

		$Connection = null;
		}// end try
		catch(PDOException $Error){

		}/// end catch
	} // end retrieval
  }// end class


?>
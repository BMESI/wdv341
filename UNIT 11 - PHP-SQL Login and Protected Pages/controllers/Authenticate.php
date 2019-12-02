<?php 
// ../../UNIT 11 - PHP-SQL Login and Protected Pages/
//  ../../UNIT 11 - PHP-SQL Login and Protected Pages/
$ConnectionFile = "../../UNIT 11 - PHP-SQL Login and Protected Pages/controllers/connection.php";
 $ValidationFie = "../../UNIT 11 - PHP-SQL Login and Protected Pages/controllers/FormValidation.php";
if (!file_exists($ConnectionFile) || !is_readable($ConnectionFile) ||  !file_exists($ValidationFie) || !is_readable($ValidationFie) ){
        throw new Exception ('<span class="error">Missing website components...</span>');
		} // end if exception
else{
        require_once($ConnectionFile);
	//	require $ValidationFie;
		
  class Authenticate{
		protected $MaxUsernameLength = 15;
		protected $MaxUserPasswordLength = 10;
		protected $ValidUsernameRegex = "[a-zA-Z0-9]";
		protected $ValidUserPasswordRegex = "[a-zA-Z0-9]";
	function __construct(){

	}// end constr
	function EventUserAuthenticate($UsernameArg, $UserpasswordArg){
		$ReturnBool = true;
			if (  strlen($UsernameArg) > $this->MaxUsernameLength || strlen($UserpasswordArg) > $this->MaxUserPasswordLength){
						$ReturnBool = false;
			} // end first if branch
			if ( preg_match($UsernameArg, $this->ValidUsernameRegex) == 0  ){
						$ReturnBool = false;
			} // end first if branch
		return (boolval($ReturnBool) ? 'true' : 'false'); 
	} // end auth func
	function EventUserLogOn($UsernameArg, $UserpasswordArg){
		try{
			global $Connection;
			$ReturnBool = false;
			if ($Connection ){
				$SQLSelectStatement = $Connection->prepare("SELECT event_user_name, event_user_password FROM event_user WHERE event_user_name = :presenters_username AND event_user_password = :presenters_password ");
				$SQLSelectStatement->bindParam(":presenters_username",$UsernameArg);
				$SQLSelectStatement->bindParam(":presenters_password",$UserpasswordArg);
				$SQLSelectStatement->execute();
				if ( $SQLSelectStatement->rowCount() == 1){
						//$Results[0] = $row['presenters_username'];
						//	$Results[1] = $row['presenters_password'];
						//$_SESSION['validuser'] = "yes";
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
  }// end class
} // end else 


?>
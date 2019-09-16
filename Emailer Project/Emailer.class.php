<?php  
/*
This assignment is about creating your first PHP Class.  Remember that in OOP a Class is PHP code that defined the variables/properties and actions/methods of an object. The Class is used as a master copy when instantiating new objects. 
Your assignment is to create an Emailer class and a PHP page that will create, load and display an Emailer object.  The Emailer class can be used to capture and process content that can be used to dynamically create and send an email.  
Create a file called Emailer.php.  All the code for your class should be in this file.  Your Emailer class should have the following information:

Email Class
     Properties:
          -Sender's Address
          -Send To Address
          -Subject Line
          -Message
     Methods
         -constructor  
          -Set/Get Sender
          -Set/Get SendTo
          -Set/Get Message
          -Set/Get Subject
          -sendEmail( )
			-It will properly format the Sender's address as an additional header using the From: format as described in PHP.net for the email( ).
			It will properly format the Message to meet the requirements of the PHP email( ) for the message.
			-It will call the PHP function mail( ) and use the expected parameters.
			-It will return the response of the mail( ) function when the sendEmail( ) is complete.
-Creat a page called processEmail.php.  Your PHP processing page should do the following:
    -Apply the concepts of MVC to your PHP page.
    -Include your Emailer class on this page.
    -Create/Instantiate a new Emailer object.
    -Use the setter methods to load information into your Emailer object.
    -Use the getter methods to output and display the contents of the Emailer object onto your page.  
    -Format the View of your processing page to display a confirmation message once the email has been sent.
When complete please do the following:
    Post all necessary files to your website.
    Update your WDV341 homework page with a link to the assignment.  If your assignment is not on your website it will not  be graded.
    Place a link to your Git repo on the Blackboard assignment. If your assignment is not in your Git repo it will not be graded.
    Place a link to your homework page on the Blackboard assignment.
    Submit your assignment on Blackboard.  If you do not submit the assignment on Blackboard it will not be graded. 
*/

//
// Emailer class, used for emailing.
//
class Emailer {
//
// Props To Emailer
//
 public $From; // "sendersaddress"
 public $To; // change var name to "recipient address"
 public $Subject;// change to "email "??
 public $Message; // "emailmessage"
 public $AddedHeaders;
//
// Construction of Emailer
//
function __construct(){
	// will not do anything, yet.
}
//
// Methods of Emailer.... like, getters and setters 'n stuff
//
//Begin sender methods
 function SetSenderAddr($FromArg){ //  
	  $this->From = $FromArg;

}
 function GetSenderAddr(){
	return  $this->From;

}
//End sender methods
//
//begin send to methods
function SetSendToAddr($ToArg){
	 $this->To = $ToArg;
}
function GetSendToAddr(){
	return $this->To;
}
//end send to methods
//
// begin subject and message methods
function SetSubjectLine($SubjectArg){
	 $this->Subject = $SubjectArg;
}
function GetSubjectLine(){
	return $this->Subject;
}
function SetMessage($MessageArg){
	 $this->Message = $MessageArg;
}
function GetMessage(){
	return  $this->Message;
}
// end subject and message methods
//
// Added headers methods
function SetAddedHeaders($AdditionalHeadersArg){
	 $this->AddedHeaders = $AddedHeadersArg;
}
function GetAddedHeaders(){
	return  $this->AddedHeaders;
}
// end headers methods
//
// Send mail
function SendEmail(){
	$FromAddress = "From: ". $this->GetSenderAddr();
 	if ( mail($this->GetSendToAddr(),$this->GetSubjectLine(), $this->GetMessage(),$FromAddress) )
	{
   		echo("<p>Message successfully sent!</p>");
  	} 
	else 
	{
   		echo("<p>Message delivery failed...</p>");
  	}
}
// end send method
}
// end mailer class
?>
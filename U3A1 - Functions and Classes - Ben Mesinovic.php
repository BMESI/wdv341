<?php 
////// start html assignment instructions
echo "
<h1>Assignment: PHP Functions</h1>

<p>Create a PHP page that will process and display the following pieces of information.  Use a combination of custom PHP functions and functions from the PHP API as needed.</p>

<p>Your page should do the following:</p>
<ul>
   <li>-Create a function that will accept a date input and format it into mm/dd/yyyy format.</li>
   <li>-Create a function that will accept a date input and format it into dd/mm/yyyy format to use when working with international dates..</li>
   <li>-Create a function that will accept a string input.  It will do the following things to the string:.</li>
 <ul> 
	 <li>-Display the number of characters in the string.</li>
     <li>-Trim any leading or trailing whitespace.</li>
     <li>-Display the string as all lowercase characters.</li>
     <li>-Will display whether or not the string contains 'DMACC' either upper or lowercase.</li>
  </ul>
  <li>  -Create a function that will accept a number and display it as a formatted number.   Use 1234567890 for your testing..</li>
  <li>  -Create a function that will accept a number and display it as US currency.  Use 123456 for your testing..</li>
</ul>

<p>When complete please do the following:</p>
<ul>

       <li>    Post all necessary files to your website. </li>
       <li>    Update your WDV341 homework page with a link to the assignment.  If your assignment is not on your website it will not be graded.</li>
       <li>    Include a link to your Git repo on the Blackboard assignment. If your assignment is not in your Git repo it will not be graded.</li>
       <li>    Place a link to your homework page on the Blackboard assignment.</li>
      <li>     Submit your assignment on Blackboard.  If you do not submit the assignment on Blackboard it will not be graded. </li>
	  </ul>
	  <hr> </br>";
/////// end html assignment instructions
/////// Start inputs and outputs section
echo "<form action='U3A1 - Functions and Classes - Ben Mesinovic.php' method='get'>
		<h1>Input the date here: <input type='date' name='date' id='dateinput'>   <input type='submit'></h1> 
		<p id='dateoutputquestion1'></p> <p id='dateoutputquestion2'></p><hr>";
echo "<h1>Trying out alternate input method for the purpose of using PHP's built-in date function.</h1>
			</br><p>Day Number (single digit): <input type='number' name='daynumberinput' id='dayinputbox'>
			</br>Month Number (single digit): <input type='number' name='monthnumberinput' id='monthinputbox'>
			</br>Year Number (four digit): <input type='number' name='yearnumberinput' id='yearinputbox'> <input type='submit'></p>
					<p id='dateoutputquestion1and2'></p><hr>";

echo "<h1>Input a string or text here: <input type='text' name='string' id='stringinput'><input type='submit'></h1>
					<p id='outputquestion3'></p><hr>";

echo "<h1>Input a  number here: <input type='number' step='0.000001' name='number' id='numberinput'>   <input type='submit'></h1>
					<p id='outputquestion4'></p><hr>";

echo "<h1>Input a  currency number here: <input type='number' step='0.01' name='currency' id='currencyinput'>   <input type='submit'></form></h1>
					<p id='outputquestion5'></p><hr>";
/////// End inputs and outputs section


////// Date input
/// Global vars for using in date methods for q1,q2
global $YearSplit;
global $MonthSplit;
global $DaySplit;
//
/// Q1 - format it into mm/dd/yyyy format.
//
function FormatDateOptionOne($DateArg){
	$YearSplit = substr($DateArg,0,4);
	$MonthSplit = substr($DateArg,6,1);
	$DaySplit = substr($DateArg,8,9);
 if( ($DaySplit == null )|| ($MonthSplit == null) || ($YearSplit == null) ){
 	 return "Check input for date function 1...";
	}else{
			return $MonthSplit."/".$DaySplit."/".$YearSplit;
	}
}
//
/// Q2 -  format it into dd/mm/yyyy
//
function FormatDateOptionTwo($DateArg){
$YearSplit = substr($DateArg,0,4);
$MonthSplit = substr($DateArg,6,1);
$DaySplit = substr($DateArg,8,9);
  if( ($DaySplit == null )|| ($MonthSplit == null) || ($YearSplit == null) ){
 	 return "Check input for date function 2...";
	}else{
			return $DaySplit."/".$MonthSplit."/".$YearSplit;
	}
}
//
/// Q1, 2 - combined return, using alternate input method and using PHP date API
//
function FormatDateAlt($DayArg, $MonthArg, $YearArg){
	// if there is no input , provide  a message to say that
  if( ($DayArg == null ) || ($MonthArg == null) || ($YearArg == null) ){
 	 return "Check input for date function number 3...";
	}else{
			$date=date_create($YearArg."-".$MonthArg."-".$DayArg);
			return date_format($date,"m/d/Y") ."     and   ". date_format($date,"d/m/Y");
	}

}
//
///Q3 - Format generic input string: Trim spaces,  to lowercase, check string for "DMACC" 
//
function FormatStringOptionThree($StringArg){
global $InputFormatted;

if($StringArg !== null ) {
	$InputFormatted = trim(strtolower($StringArg), " ");
	$CharCount = strlen($InputFormatted);
	if(stristr($InputFormatted,"dmacc") ){
			return $InputFormatted . " contains the term DMACC."." -- Length of string: ".$CharCount;
		}else{
			return $InputFormatted."  does not contain the term DMACC"." -- Length of string: ".$CharCount;
}
return $InputFormatted;
}else{
	return "There was no input in FunctionStringOptionThree...";
}
}
//
/// Q4 -  accept a number and display it as a formatted number
//
function NumberFormatter($NumberArg){
global $NumberFormatted;
if ( ($NumberArg == "") || ($NumberArg == null) ){
     return "Nothin was put into the 'NumberFormatter' function..";
}
else {
$NumberFormatted = number_format($NumberArg, 2, '.', ',');
return $NumberFormatted;}

}
//
/// Q5 -  accept a number and display it as currency
//
function NumberCurrencyFormatter($NumberArg){
global $NumberFormatted;
if ( ($NumberArg == "") || ($NumberArg == null) ){
     return "Nothin was put into the 'NumberFormatter' function..";
}
else {
$NumberFormatted = number_format($NumberArg, 2, '.', ',');
return "$". $NumberFormatted;
}
}

?>
<!-- Being script to print out answers using JS-->
<script> 
	document.getElementById('dateoutputquestion1').innerHTML =
		"</br>Question 1): <?php  echo FormatDateOptionOne($_GET['date']); ?> "
	document.getElementById('dateoutputquestion2').innerHTML =
		"</br>Question 2):  <?php echo FormatDateOptionTwo($_GET['date']); ?>  </br>";
	document.getElementById('dateoutputquestion1and2').innerHTML =
		"</br>Alternate version of Question 1),2):  <?php echo FormatDateAlt($_GET["daynumberinput"],$_GET["monthnumberinput"],$_GET["yearnumberinput"]); ?>  </br>";
	document.getElementById('outputquestion3').innerHTML =
		"</br> Question 3): <?php echo FormatStringOptionThree($_GET['string']); ?></br>";
	document.getElementById('outputquestion4').innerHTML =
		 "</br> Question 4): <?php echo NumberFormatter($_GET["number"]) ?> </br>";
	document.getElementById('outputquestion5').innerHTML =
		 "</br> Question 5): <?php echo NumberCurrencyFormatter($_GET["currency"]) ?></br>";
</script> 
<!-- End script to print out answers using JS.
	  Begin external links -->
<h1> Github: <a href=''>Unit 3 Assignment 1</a> </h1>
</br><hr><h4>  
<a href='../../index.html'>Return to Index/Home...</a></h4>
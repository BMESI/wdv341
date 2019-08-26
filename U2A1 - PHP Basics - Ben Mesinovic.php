﻿<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>
        Unit 2: Assignment: PHP Basics
    </title>
</head>
<body>
<h1>Assignment: PHP Basics</h1>
	<hr/>

<h3>Create a PHP page for this assignment. Use a combination of PHP, HTML and Javascript to perform the following processes.</h3>
<ul> 
  <li>-Create a variable called yourName.  Assign it a value of your name. </li>
  <li>-Display the assignment name in an h1 element on the page. Include the elements in your output. </li>
  <li>-Use HTML to put an h2 element on the page. Use PHP to display your name inside the element using the variable.</li>
  <li>-Create the following variables:  number1, number2 and total.  Assign a value to them.  </li>
  <li>-Display the value of each variable and the total variable when you add them together. </li>
  <li> Use PHP to create a Javascript array with the following values: PHP,HTML,Javascript.  Output this array using PHP.</li>
    <li>Create a script that will display the values of this array on your page.  NOTE:  Remember PHP is building the array not running it.  </li>

</ul>
</hr>
<h3> When complete please do the following: </h3>
<ul>
   <li>  Post all necessary files to your website. </li>
   <li>  Update your WDV341 homework page with a link to the assignment.  If your assignment is not on your website it WILL NOT BE GRADED. </li>
  <li>   Attach your Git repo address to this assignment </li>
    <li> Place a link to your homework page on the Blackboard assignment. </li>
    <li> Submit your assignment on Blackboard.  If you do not submit the assignment on Blackboard it WILL NOT BE GRADED.  </li>
<ul>
	<hr/>

</body>
</html>

<?php 
// Section 1
//
// Q1
echo "<h4> Question 1 </h4>";
$yourName = "Benjamin Mesinovic";
echo $yourName;
//
// Q2
echo "<h4> Question 2 </h4>";
echo "<h1> Unit 2: PHP Basics</h1>";
echo htmlspecialchars("With elements: <h1> Unit 2: PHP Basics</h1>");
//
// Q3
echo "<h4> Question 3 </h4>";
echo "<h2>".$yourName."</h2>";
//
// Q4, Q5
$number1 = 1;
$number2 = 2;
$total = $number1 + $number2;
echo "<h4> Question 4, 5</h4>";
echo "Number 1:  " . $number1 . "<br/>";
echo "Number 2: \n " . $number2 . "<br/>";
echo "Total : \n " . $total . "<br/>";
echo $total  . " = " . $number1  . " + " . " " . $number2 . "<br/>";
//
/// Q6, Q7
// old code -----     $JS_array = "<script> var Tools = ['PHP, JavaScript, HTML, CSS']; </script>";
echo "<h4> Question 6, 7</h4>";
$script_start_tag = "<script>";
$script_end_tag = "</script>";
$JS_array = "var Tools = ['PHP, JavaScript, HTML, CSS'];";
echo $JS_array . "</br>";
echo $script_start_tag . $JS_array . $script_end_tag;
//echo "</br> JS array " . $JS_array;

echo "<script>
		document.write(Tools[0]); </script>";
		
echo "<h1> Github: <a href='https://github.com/BMESI/wdv341/blob/master/U2A1%20-%20PHP%20Basics%20-%20Ben%20Mesinovic.php'>Unit 2 Assignment 1</a> </h1>";
echo "</br><hr><h4>  <a href='../../index.html'>Return to Index/Home...</a></h4>";
?>
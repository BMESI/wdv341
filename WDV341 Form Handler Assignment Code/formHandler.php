
<?php 
// Report all PHP errors
error_reporting(-1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//display_errors = on;
//Method 1.  This uses a loop to read each set of name-value pairs stored in the $_POST array
// I added an extra variable to copy $_Post values to make another table.
	$tableBody = "";		//use a variable to store the body of the table being built by the script
	$_POSTCOPY = "";

	foreach($_POST as $key => $value)		//This will loop through each name-value in the $_POST array
	{
		$_POSTCOPY .= "<tr>";
	    $_POSTCOPY .=  "<td>$key</td>";	
		$_POSTCOPY .=  "<td>$value</td>";	
		$_POSTCOPY .=  "</tr>";	

		$tableBody .= "<tr>";				//formats beginning of the row
		$tableBody .= "<td>$key</td>";		//dsiplay the name of the name-value pair from the form
		$tableBody .= "<td>$value</td>";	//dispaly the value of the name-value pair from the form
		$tableBody .= "</tr>";				//End this row

	} 
	
	//Method 2.  This method pulls the individual name-value pairs from the $_POST using the name
	//as the key in an associative array.  
	$CheckBoxLabel1= "checkboxname1";
	$CheckBoxLabel2= "checkboxname2";
	$RadioLabel= "radioname";

	$inFirstName = $_POST["firstName"];		//Get the value entered in the first name field
	$inLastName = $_POST["lastName"];		//Get the value entered in the last name field
	$inSchool = $_POST["school"];			//Get the value entered in the school field
	//
	// for chxbx 1 - i want to add this to the exxtra copy of the POST table to make it shown as turned off or unchecked.
	//
	if ( isset ($_POST["checkboxname1"])  ){
		$inCheckbox1 =  $_POST["checkboxname1"];
	}else {
		$inCheckbox1 ="off";
		$_POSTCOPY .="<td>$CheckBoxLabel1</td><td>$inCheckbox1</td>";
	}
	//
	// for chxbx 2 - i want to add this to the exxtra copy of the POST table to make it shown as turned off or unchecked.
	//
	if ( isset ($_POST["checkboxname2"])  ){
	$inCheckbox2 =  $_POST["checkboxname2"];
	}else {
		$inCheckbox2 ="off";
		$_POSTCOPY .="<tr><td>$CheckBoxLabel2</td><td>$inCheckbox2</td></tr>";	
	}
	// for radio
	if ( isset ($_POST["radioname"])  ){
		$inRadio = $_POST["radioname"];
	}else {
		$inRadio ="off";
		$_POSTCOPY .="<tr><td>$RadioLabel</td><td>$inRadio</td></tr>";	
	}
	$inSelectList =  $_POST["selectlistname"];
	  

	  //
	  // if statement for honey pot - if 'email' field  is not empty, then it is spam. 
	  //
	  if(  ! empty($_POST["email"]) ){
	  	  echo "<h1> Spam detected...</h1>";
		  // reroute user to another page and then log details to server 
		  // 
	  }




	/*
	Create a link to the form page on your homework page.
	-Add a set of three radio buttons to the HTML form.
	-Add two checkboxes to the HTML form.
	-Add a drop down list with at least three selections to the HTML form.
	-Update the PHP as needed to display the selected values of all fields on the form.
	-Update the PHP as needed to implement a honeypot form protection.
	
	
	*/



?>

<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV 341 Intro PHP - Code Example</title>
</head>

<body>
<h1>WDV341 Intro PHP</h1>
<h2>Form Handler Result Page - Code Example</h2>
<p>This page displays the results of the Server side processing. </p>
<p>The PHP page has been formatted to use the Model-View-Controller (MVC) concepts. </p>
<h3>Display the values from the form using Method 1. Uses a loop to process through the $_POST array</h3>
<p>
	<table border='a'>
    <tr>
    	<th>Field Name</th>
        <th>Value of Field</th>
    </tr>
	<?php echo $tableBody;  ?>
	</table>
</p>
<p>New Table
	<table border='a'  style="height:600px">
    <tr>
    	<th>Field Name</th>
        <th>Value of Field</th>
    </tr>
	<?php echo $_POSTCOPY;  ?>
	</table>
</p>

<h3>Display the values from the form using Method 2. Displays the individual values.</h3>
<p>School: <?php echo $inSchool; ?></p>
<p>First Name: <?php echo $inFirstName; ?></p>
<p>Last Name: <?php echo $inLastName; ?></p>
<p>Checkbox 1:<?php echo $inCheckbox1; ?></p>
<p>Checkbox 2:<?php echo $inCheckbox2; ?></p>
<p>Radio: <?php echo $inRadio; ?></p>
<p>Select List: <?php echo $inSelectList; ?></p>
</body>
</html>

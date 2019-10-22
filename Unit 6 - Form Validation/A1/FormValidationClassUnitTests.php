<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title></title>
</head>
<body>
    <?php 
	require "CE_FormValidation.php";
     $TestRequiredField = new CE_FormValidation();
	 echo "<h3> Testing all validation functions. If it returns false, that means the function did not allow the argument to pass. True means that the argument is valid.</h3>";
     echo  $TestRequiredField->ValidateRequiredField("") . " '' (empty string) <br>";
	 echo  $TestRequiredField->ValidateRequiredField(" ") . " ' ' (space) <br>";
	 echo  $TestRequiredField->ValidateRequiredField("  ") . " '  ' (double space) <br>";
	 echo  $TestRequiredField->ValidateRequiredField(null). " null value<br>";
	 echo  $TestRequiredField->ValidateRequiredField("undefined"). " undefined (string)<br>";
	 echo  $TestRequiredField->ValidateRequiredField("null"). " null (string) <br>";
	 echo  $TestRequiredField->ValidateRequiredField("nam+e"). " 'nam+e' alpha w/ specials<br>";
	 echo  $TestRequiredField->ValidateRequiredField(" a ") . " ' a ' alpha w/ spaces<br>";
	 echo  $TestRequiredField->ValidateRequiredField("aa lll") . " 'aa lll' alpha w/ space between<br>";
	 echo  $TestRequiredField->ValidateRequiredField("aaaaasdddddddddddd") . "  'aaaaasdddddddddddd' alpha <br>";
	 echo "---------------------------------------------------------------------------------- end ValidateRequiredField <br>";
	 echo "---------------------------------------------------------------------------------- Begin ValidateName<br>";
	      echo  $TestRequiredField->ValidateName("") . " '' (empty string) <br>";
	 echo  $TestRequiredField->ValidateName(" ") . " ' ' (space) <br>";
	 echo  $TestRequiredField->ValidateName("  ") . " '  ' (double space) <br>";
	 echo  $TestRequiredField->ValidateName(null). " null value<br>";
	 echo  $TestRequiredField->ValidateName("undefined"). " undefined (string)<br>";
	 echo  $TestRequiredField->ValidateName("null"). " null (string) <br>";
	 echo  $TestRequiredField->ValidateName("nam+e"). " 'nam+e' alpha w/ specials<br>";
	 echo  $TestRequiredField->ValidateName(" a ") . " ' a ' alpha w/ spaces<br>";
	 echo  $TestRequiredField->ValidateName("aa lll") . " 'aa lll' alpha w/ space between<br>";
	 echo  $TestRequiredField->ValidateName("sadasdas$") . "  'sadasdas$' alpha <br>";
	 echo "---------------------------------------------------------------------------------- Begin RequireNumberInput<br>";
	 echo $TestRequiredField->RequireNumberInput(".") . " .<br>";
	 echo $TestRequiredField->RequireNumberInput("") . " '' <br>";
	 echo $TestRequiredField->RequireNumberInput(null) . " null <br>";
	 echo $TestRequiredField->RequireNumberInput(".5") . " '.5' <br>";
	 echo $TestRequiredField->RequireNumberInput("$") . " '$' <br>";
	 echo $TestRequiredField->RequireNumberInput("1 0") . " '1 0' <br>";
	 echo $TestRequiredField->RequireNumberInput("aaaaaaa4ijihv222") . " aaaaaaa4ijihv222 <br>";
	 echo $TestRequiredField->RequireNumberInput("4.44") . " 4.44<br>";
	 echo $TestRequiredField->RequireNumberInput("444") . " 444 <br>";
	 echo $TestRequiredField->RequireNumberInput("4+44") . " 4+44 <br>";
	 echo $TestRequiredField->RequireNumberInput("+444") . " +444 <br>";
	 echo $TestRequiredField->RequireNumberInput("-444") . " -444 <br>";
	 echo $TestRequiredField->RequireNumberInput("444+") . " 444+ <br>";
	 echo $TestRequiredField->RequireNumberInput("4,444") . " 4,444 <br>";
	 echo $TestRequiredField->RequireNumberInput("2,300") . " 2,300 <br>";
	 echo $TestRequiredField->RequireNumberInput(4,444) . " 4,444 <br>";
	 echo $TestRequiredField->RequireNumberInput(2,300) . " 2,300 <br>";
	 echo $TestRequiredField->RequireNumberInput(23,00) . " 23,00 <br>";
	 echo $TestRequiredField->RequireNumberInput("4,44") . " 4,44 <br>";
	 echo $TestRequiredField->RequireNumberInput(",444") . " ,444 <br>";
	 echo $TestRequiredField->RequireNumberInput(0,444) . " ,444 <br>";

	 echo "---------------------------------------------------------------------------------- Begin ValidatePhoneNUmber <br>";
	 echo  $TestRequiredField->ValidatePhoneNumber(" a ") . "' a '<br>";
	 echo  $TestRequiredField->ValidatePhoneNumber("123-123-1233") . " '123-123-1233' <br>";
	 echo  $TestRequiredField->ValidatePhoneNumber("+1231231234") . " '+1231231234' <br>";
	 echo  $TestRequiredField->ValidatePhoneNumber("1231+231234") . " '1231+231234' <br>";
	 echo  $TestRequiredField->ValidatePhoneNumber("       1231231234") . " '       1231231234' <br>";
	 echo  $TestRequiredField->ValidatePhoneNumber(",1231231234") . " ',1231231234'<br>";
	 echo  $TestRequiredField->ValidatePhoneNumber("-") . " '-'<br>";
	 echo  $TestRequiredField->ValidatePhoneNumber("(123)123-1234") . " '(123)123-1234'<br>";
	 echo  $TestRequiredField->ValidatePhoneNumber("123123as1234") . " '123123as1234'<br>";
	 echo  $TestRequiredField->ValidatePhoneNumber("11231231234") . " '11231231234'<br>";
	 echo  $TestRequiredField->ValidatePhoneNumber("231231234") . " '23123123'<br>";
	 echo  $TestRequiredField->ValidatePhoneNumber(null) . " null<br>";
	 echo  $TestRequiredField->ValidatePhoneNumber("12312312,34") . " '12312312,34'<br>";
	 echo  $TestRequiredField->ValidatePhoneNumber("00112.13123") . " '00112.13123'<br>";
	 echo  $TestRequiredField->ValidatePhoneNumber("0011213123") . " '0011213123'<br>";
	 echo  $TestRequiredField->ValidatePhoneNumber("1231231234") . " '1231231234'<br>";
	 echo "---------------------------------------------------------------------------------- end phone number<br>";

	 echo "---------------------------------------------------------------------------------- begin Validateemail<br>";
	 //echo $TestRequiredField->ValidateEmail('be<me@1.com'). " be<me@1.com<br>";
	 echo $TestRequiredField->ValidateEmail('beme@<1.com'). " beme@<1.com  " . "<br>";
	 echo $TestRequiredField->ValidateEmail("be<me@1.com") . " be<me@1.com  " . "<br>";  // <<<<<<-------- this one breaks somewhere along the line . the '<' symbol disables the rest of the code from echoing... ??
	echo  "<br>";
	echo $TestRequiredField->ValidateEmail('be>me@1.com'). " be>me@1.com<br>";
	echo $TestRequiredField->ValidateEmail('benAtsomeplaceanddontknowhow'). " bmeAtsomeplaceanddontknowhow<br>";
	echo $TestRequiredField->ValidateEmail(null). " null<br>";
	echo $TestRequiredField->ValidateEmail("bme.123.123/?[]1aaa@1.com"). " bme.123.123/?[]1aaa@1.com <br>";
	echo $TestRequiredField->ValidateEmail('beme@1.c'). " beme@1.c<br>";
	echo $TestRequiredField->ValidateEmail("beme@1.com"). " beme@1.com <br>";
	echo $TestRequiredField->ValidateEmail("bme123-123@1.com"). " bme123-123@1.com <br>";
	echo "---------------------------------------------------------------------------------- end email <br>";
	echo "---------------------------------------------------------------------------------- begin ValidateRegistrationList<br>";
	echo $TestRequiredField->ValidateRegistrationList("") . " '' (blank/empty string) <br>";
	echo $TestRequiredField->ValidateRegistrationList("attendee") . " attendee<br>";
	echo $TestRequiredField->ValidateRegistrationList("presenter") . " presenter<br>";
	echo $TestRequiredField->ValidateRegistrationList("volunteer") . " volunteer<br>";
	echo $TestRequiredField->ValidateRegistrationList("Volunteer") . " Volunteer<br>";
	echo $TestRequiredField->ValidateRegistrationList("attENdee") . " attENdee<br>";
	echo $TestRequiredField->ValidateRegistrationList("presenTer") . " presenTer<br>";
	echo $TestRequiredField->ValidateRegistrationList("attend ee") . " Attend ee<br>";
	echo $TestRequiredField->ValidateRegistrationList("prese213nter") . " prese213nter<br>";

    ?>
		 <form name="form" method="post" action="FormValidationClassUnitTests.php"> 
		 <select name="list" id="list"> 
		 <option value=""></option>
		 <option value="attendee">Attendee</option>
		 <option value="presenter">Presenter</option>
		 <option value="volunteer">Volunteer</option>
		 </select>
		 <input type="submit" name="submit" id="submit" value="submit">
		 </form> 
	<?php 
	// just double checking the list submission
	if ( isset($_POST["submit"])){
	$a = $_POST["list"];
		 echo $TestRequiredField->ValidateRegistrationList($_POST["list"]) . " $a <br>";

	}
	echo "---------------------------------------------------------------------------------- <br>";
	echo $TestRequiredField->ValidateBadgeTypeRadio(",") . " , string <br>";
	echo $TestRequiredField->ValidateBadgeTypeRadio("") . " '' empty string <br>";
	echo $TestRequiredField->ValidateBadgeTypeRadio("Lanyard") . " 'Lanyard' <br>";
	echo $TestRequiredField->ValidateBadgeTypeRadio("MaGnet") . " 'MaGnet' <br>";
	echo $TestRequiredField->ValidateBadgeTypeRadio("clip") . " 'clip' <br>";
	echo $TestRequiredField->ValidateBadgeTypeRadio("21321312") . " '21321312'  string <br>";
	echo $TestRequiredField->ValidateBadgeTypeRadio(null) . " null  <br>";
    echo "---------------------------------------------------------------------------------- end ValidateRegistrationList<br>";
	echo "----------------------------------------------------------------------------------  start ValidateMealDayCheckbox<br>";
	
	echo $TestRequiredField->ValidateMealDayCheckbox(""). " '' empty string<br>";
	echo $TestRequiredField->ValidateMealDayCheckbox(" "). " ' ' space string<br>";
	echo $TestRequiredField->ValidateMealDayCheckbox("23"). " '23' number string<br>";
	echo $TestRequiredField->ValidateMealDayCheckbox("--"). " '--' string<br>";
	echo $TestRequiredField->ValidateMealDayCheckbox(213). " 213 as numeric<br>";
	echo $TestRequiredField->ValidateMealDayCheckbox("444+") . " 444+ <br>";
	echo $TestRequiredField->ValidateMealDayCheckbox("4,444") . " 4,444 <br>";
	echo $TestRequiredField->ValidateMealDayCheckbox("2,300") . " 2,300 <br>";
	echo $TestRequiredField->ValidateMealDayCheckbox(4,444) . " 4,444 <br>";
	echo $TestRequiredField->ValidateMealDayCheckbox(2,300) . " 2,300 <br>";
	echo $TestRequiredField->ValidateMealDayCheckbox(23,00) . " 23,00 <br>";
	echo $TestRequiredField->ValidateMealDayCheckbox("sunday_211ds_ss"). " ''sunday_211ds_ss'  (false arg)<br>";
	echo $TestRequiredField->ValidateMealDayCheckbox("sunday(11sM"). " ''sunday(11sM'  (false arg)<br>";
	echo $TestRequiredField->ValidateMealDayCheckbox("Friday"). " ''Friday' (valid string but not an array))<br>";
	echo $TestRequiredField->ValidateMealDayCheckbox("sAturday"). " ''sAturday'  (valid string but not an array)<br>";
	echo $TestRequiredField->ValidateMealDayCheckbox("sunday"). " ''sunday'  (valid string but not an array)<br>";


	?>
		<form name="form2" method="post" action="FormValidationClassUnitTests.php"> 
		<label for="friday">Friday</label>
		<input type="checkbox" name="checkbox[]" id="friday" value="friday">
		<label for="saturday">saturday</label>
		<input type="checkbox" name="checkbox[]" id="saturday" value="saturday">
		<label for="sunday">sunday</label>
		<input type="checkbox" name="checkbox[]" id="sunday" value="sunday">

		 <input type="submit" name="submit2" id="submit" value="submit2">
		 </form> 
		 <?php 
		 // testing values by sending via checkbox.
		 	if ( isset($_POST["submit2"])){
				$arr =[""];	$count = 0;
				if ( isset($_POST["checkbox"])  ){
					$arr = $_POST['checkbox'];
					foreach ($_POST['checkbox'] as $Item=>$Value) {
						echo $TestRequiredField->ValidateMealDayCheckbox($arr) . "  $Value -- checkbox values should be true<br>";
							} // ends looop
				}// ends if chkbx
			} // ends if submit
	    echo "---------------------------------------------------------------------------------- end ValidateMealDayCheckbox<br>";
	    echo "---------------------------------------------------------------------------------- start ValidateSpecialComment<br>";
		echo $TestRequiredField->ValidateSpecialComment(""). " '' empty string<br>";
		echo $TestRequiredField->ValidateSpecialComment(""). "'' empty string<br>";
		echo $TestRequiredField->ValidateSpecialComment("{"). " '{'string<br>";
		echo $TestRequiredField->ValidateSpecialComment("\\"). " '\'string<br>";
		echo $TestRequiredField->ValidateSpecialComment("["). " '['string<br>";
		echo $TestRequiredField->ValidateSpecialComment("^"). " '^'string<br>";
		echo $TestRequiredField->ValidateSpecialComment("<wtf"). " '<'string<br>";
		echo $TestRequiredField->ValidateSpecialComment(">"). " '>'string<br>";
		echo $TestRequiredField->ValidateSpecialComment("#"). "'' # string<br>";
	    echo $TestRequiredField->ValidateSpecialComment("&"). " & string<br>";
		echo $TestRequiredField->ValidateSpecialComment("@"). " @ string<br>";
		echo $TestRequiredField->ValidateSpecialComment("!"). " ! string<br>";
		echo $TestRequiredField->ValidateSpecialComment("something something something something ". $ReturnBool = true." jajajajaj "). " $ReturnBool   string<br>";
		echo $TestRequiredField->ValidateSpecialComment("something something ,something something something ++ something "). " ++  string<br>";
	echo $TestRequiredField->ValidateSpecialComment("something something something something ... jajajajaj "). " ...  string<br>";
	echo $TestRequiredField->ValidateSpecialComment("lorum ipsum etc, lorum ipsum etclorum ipsum etclorum ipsum etclorum ipsum etclorum ipsum etc lorum ipsum etc.") . " lorum ipsum etc, lorum ipsum etclorum ipsum etclorum ipsum etclorum ipsum etclorum ipsum etc lorum ipsum etc. <br>";


	?>
			<form name="form3" method="post" action="FormValidationClassUnitTests.php"> 
		<textarea name="comment" id="comment" rows="4" cols="50" autofocus></textarea>
		 <input type="submit" name="submit3" id="submit3" value="submit3">
		 </form> 
		 <?php 
		 $testcomment ="";
		 		 	if ( isset($_POST["submit3"])){
					$testcomment =  $_POST['comment'];
					$filtercomment = filter_var($testcomment, FILTER_SANITIZE_STRING);
		 		 	echo " -- " .$TestRequiredField->ValidateSpecialComment($filtercomment). " -- " . $filtercomment ."  input directly from textarea <br>";
					} //end if

					$etest = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut euismod mauris ligula, fermentum tristique justo porta sed. Nunc rutrum ligula sed finibus semper. Morbi ac ante porta, sagittis lacus a, accumsan purus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin pulvinar hendrerit commodo. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur suscipit, orci non gravida rutrum, justo ante aliquet sem, sed tempus urna elit sit amet enim. Cras id mauris id felis rutrum interdum. Integer imperdiet ipsum ipsum, id blandit ligula vulputate eget. Integer lectus orci, ullamcorper vel dapibus ut, posuere nec nulla. Nulla eget leo nec libero pellentesque faucibus. Suspendisse efficitur turpis et nunc ornare ornare. Mauris quis suscipit odio. Proin libero dui, sollicitudin vitae enim ac, luctus rhoncus mi. Fusce risus odio, maximus at luctus non, aliquam et sapien. Fusce id purus viverra lacus venenatis laoreet eu at tellus. Suspendisse luctus vel leo id pellentesque. Suspendisse vehicula orci sit amet risus aliquam cursus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer porttitor non metus et sollicitudin. Morbi id molestie tellus. Vestibulum suscipit fermentum ante, et elementum dui sodales at. Vivamus eget.";
									echo $TestRequiredField->ValidateSpecialComment($etest) ." etest var string<br>";

		 ?>
</body>
</html>
<?php 
// start php email process
include "Emailer.class.php";

// From var: to include in email's "FROM" field
$From = "contact@benmesinovic.com";
// TO var: determines where the email is being sent to
$To = "bmesinovic@dmacc.edu";
// SUBJECT?? subject line in email
$Subject = "Hi";
// Message body
$Message = 
"1 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce scelerisque metus neque, ut tempus quam dapibus ut. Ut maximus odio non risus dictum, eu aliquam dui sollicitudin. Morbi tempus gravida ligula at pellentesque. Sed in ligula arcu. Ut ac dapibus dolor. Praesent congue porttitor semper. Duis vitae enim quis nulla fringilla aliquet. Donec quis orci mauris. Integer pretium laoreet dui."."\r\n".
"2 Sed condimentum porta metus, id bibendum mauris scelerisque nec. In sit amet fermentum lacus. Curabitur pretium ullamcorper sapien, sed venenatis mi facilisis sit amet. Vestibulum accumsan eget velit vitae mattis. Sed tincidunt nibh non eleifend fermentum. Duis bibendum quam nibh, eu finibus erat varius eget. Nam consectetur urna sapien, non rutrum sem eleifend et."."\r\n".
"3 Curabitur finibus ante ut dui scelerisque sodales. Nullam arcu mauris, cursus vitae lectus at, finibus dapibus magna. Integer laoreet porta erat. Aliquam ultrices hendrerit nibh at malesuada. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam dolor, efficitur et dignissim quis, pharetra aliquet odio. Sed eu leo quis ligula accumsan pellentesque."."\r\n".
"4 Phasellus nunc arcu, dignissim at leo vitae, finibus dignissim ipsum. Ut blandit ante et varius varius. Donec ut nisl in velit rhoncus mattis eget vel dui. Nulla varius ullamcorper turpis at rutrum. Vivamus eget neque in nunc pellentesque finibus quis a justo. Maecenas quis neque interdum, lobortis dolor eu, imperdiet odio. Vivamus fringilla nunc lorem, sed consectetur ex placerat facilisis."."\r\n".
"5 Nullam in tristique risus, accumsan scelerisque ligula. Mauris ex lorem, lacinia vel dignissim at, porta eu lorem. Ut gravida laoreet sapien, ac suscipit arcu malesuada quis. Nam ullamcorper sodales eros eu gravida. Donec rutrum leo quis magna porta, sit amet feugiat sapien porttitor. Nam convallis felis sed mollis pharetra. Mauris volutpat orci orci, id vestibulum magna eleifend vitae."."\r\n"
;
// end message body 
$AddedHeaders = array($From)."\r\n";
// makke new email object
$TestEmailer2 = new Emailer();
// use set methods
$TestEmailer2->SetSendToAddr($To);
$TestEmailer2->SetSubjectLine($Subject);
$TestEmailer2->SetMessage($Message);
$TestEmailer2->SetSenderAddr($From);
$TestEmailer2->SendEmail();

// end php email process
?>

<h1> WDV341  : PHP  testing emailer class</h1>
<h3> Recip add: <?php echo $TestEmailer2->GetSendToAddr(); ?></h3>
<h3> Sendr add: <?php echo $TestEmailer2->GetSenderAddr(); ?></h3>
<h3> Subject: <?php echo $TestEmailer2->GetSubjectLine(); ?></h3>
<h3> Message: <?php echo $TestEmailer2->GetMessage(); ?></h3>
<h3> Headers: <?php echo $TestEmailer2->GetAddedHeaders(); ?></h3>
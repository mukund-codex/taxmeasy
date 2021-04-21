<?php

ini_set("display_errors","on");
error_reporting(E_ALL);
require("class.phpmailer.php");

$mail = new PHPMailer();

$mail->IsSMTP();
$mail->Host = "updates.tatateledobig.in";

$mail->SMTPAuth = true;
//$mail->SMTPSecure = "ssl";
$mail->Port = 587;
$mail->Username = "dobig";
$mail->Password = "f7b%d6dbf516a";

$mail->From = "KnowMyCustomer@dobig.info";
$mail->FromName = "Test from contact";
$mail->AddAddress("mukunda.v@innovins.com");
//$mail->AddReplyTo("mail@mail.com");

$mail->IsHTML(true);

$mail->Subject = "Test message from server";
$mail->Body = "Test Mail<b>in bold!</b>";
//$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

if(!$mail->Send())
{
echo "Message could not be sent. <p>";
echo "Mailer Error: " . $mail->ErrorInfo;
exit;
}

echo "Message has been sent";

?>
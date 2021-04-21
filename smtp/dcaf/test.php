<?php
function Send_Mail($to,$subject,$body)
{
require("class.phpmailer.php");
$from = "noreply@familyjoyz.com";
$mail = new PHPMailer();
$mail->IsSMTP(true); // SMTP
$mail->SMTPAuth   = true;  // SMTP authentication
$mail->Mailer = "smtp";
$mail->Host= "tls://email-smtp.us-east.amazonaws.com"; // Amazon SES
$mail->Port = 465;  // SMTP Port
$mail->Username = "noreply@familyjoyz.com";  // SMTP  Username
$mail->Password = "fj321";  // SMTP Password
$mail->SetFrom($from, 'From Name');
$mail->AddReplyTo($from,'Technical Support');
$mail->Subject = $subject;
$mail->MsgHTML($body);
$address = $to;
$mail->AddAddress($address, $to);
if(!$mail->Send())
return false;
else
return true;
}
?>
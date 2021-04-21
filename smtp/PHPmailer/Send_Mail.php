<?php
function Send_Mail($to,$subject,$body)
{
require 'class.phpmailer.php';
$from = "noreply@familyjoyz.com";
$mail = new PHPMailer();
$mail->IsSMTP(true); // SMTP
$mail->SMTPAuth   = true;  // SMTP authentication
$mail->Mailer = "smtp";
$mail->Host       = "tls://email-smtp.us-east.amazonaws.com"; // Amazon SES server, note "tls://" protocol
$mail->Port       = 465;                    // set the SMTP port
$mail->Username   = "noreply@familyjoyz.com";  // SES SMTP  username
$mail->Password   = "fj321";  // SES SMTP password
$mail->SetFrom($from, 'From Name');
$mail->AddReplyTo($from,'9lessons Labs');
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
<?php
require '/var/www/html/smtp/test.php';
$to = "to@gmail.com";
$subject = "Test Mail Subject";
$body = "Hi
Email service is working
Amazon SES"; // HTML  tags
Send_Mail($to,$subject,$body);
?>
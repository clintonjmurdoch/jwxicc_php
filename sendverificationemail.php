<?php
session_start();
include("class_lib.php");
$member = unserialize($_SESSION["member"]);
$verifyhash = sha1($member->getUsername() . $member->getEmail());
$verifyurl = "http://jwxicc.com/verifyemail.php?username=" . $member->getUsername() . "&email=" . $member->getEmail() . "&hash=" . $verifyhash;

$path = '/home/jwxiccco/public_html/phpmailer';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);


require("class.phpmailer.php");

$mail = new PHPMailer();

$mail->IsSMTP();  // telling the class to use SMTP
$mail->Host     = "mail.jwxicc.com"; // SMTP server
$mail->SMTPAuth = true; //SMTP auth on
$mail->Username = "murdoch+jwxicc.com"; //SMTP Username
$mail->Password = "cricket1"; //SMTP Password

$mail->From     = "support@jwxicc.com";
$mail->FromName = "Hitchhiker's Guide Support";

$mail->AddAddress($member->getEmail());

$mail->Subject  = "Please verify email with Hitchhiker's Guide";
$mail->IsHTML   = true;
$mail->Body     = "Hi " . $member->getFirstname() . "! \n\n Thanks for joining Hitchhiker's Guide. Please click the link below to verify your email address. \n\n" . $verifyurl . "\n\n Regards,\n The Hitchhiker's Guide Team";
$mail->WordWrap = 50;

if(!$mail->Send()) {
  echo 'Message was not sent.';
  echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
  echo 'success';
}
$_SESSION["member"]=serialize($member);
?>
<?php

$path = '/home/jwxiccco/public_html/phpmailer';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);


require("class.phpmailer.php");

$mail = new PHPMailer();

$mail->IsSMTP();  // telling the class to use SMTP
$mail->Host     = "mail.jwxicc.com"; // SMTP server
$mail->SMTPAuth = true; //SMTP auth on
$mail->Username = "murdoch+jwxicc.com"; //SMTP Username
$mail->Password = "cricket1"; //SMTP Password

$mail->From     = "suggestions@jwxicc.com";
$mail->FromName = "JWXICC.com suggestion";

$mail->AddAddress("vorn@jwxicc.com");
$mail->AddAddress("vaughan_garner@hotmail.com");
$mail->AddAddress("murdoch@jwxicc.com");

$mail->Subject  = "Suggestion from JWXICC.com";
$mail->IsHTML   = false;
$mail->Body     = $_POST["comments"];
$mail->WordWrap = 50;

if(!$mail->Send()) {
  echo 'Message was not sent.';
  echo 'Mailer error: ' . $mail->ErrorInfo;
  echo '<br/>Return to <a href=index.php>home page</a>.';
} else {
  echo '<meta http-equiv="refresh" content="0;URL=thanksforsuggestion.php"/>';
}

?>
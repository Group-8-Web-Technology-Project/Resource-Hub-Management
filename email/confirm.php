<?php
include 'confirm_html.php';

require 'vendor/autoload.php';
require 'encryption.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

function createMailInstance(){
    $mail = new PHPMailer(true);
    try {
        $mail->CharSet = "utf-8";
        $mail->isSMTP();
        $mail->SMTPAuth = true;

        $mail->Host       = 'smtp.gmail.com';
        $mail->Username   = '2021csc048@univ.jfn.ac.lk';
        $mail->Password   = 'bwmy caqc bsac fust';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->isHTML(true);
       
		$mail->setFrom('2021csc048@univ.jfn.ac.lk', 'ResourceHub');
		$mail->AddReplyTo('2021csc048@univ.jfn.ac.lk', 'Do not reply');
    }
    catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }  
    return $mail;
}

function confirmEmail($email,$username,$token){
  global $confirm_html;
  $mail = createMailInstance();
  $code = $email;
  
  $mail->addAddress($email, $username); 
  $mail->Subject = "$username, verify your email";
  $mail->Body = $confirm_html;
  
  $mail->send();
}

function acceptEmail($email,$username,$event,$start,$end,$date,$resource){
	global $accept_html;
    $mail = createMailInstance();

    $mail->addAddress($email, $username); 
    $mail->Subject = "Your Request Has Been Approved";
    $mail->Body = $accept_html;

    $mail->send();
}

function declineEmail($email,$username,$event,$start,$end,$date,$resource,$reason){
	
    $mail = createMailInstance();

    $mail->addAddress($email, $username); 
    $mail->Subject = "Resource Request Declined";
  

    $mail->send();
}

function approveEmail($email,$username){
	global $approve_html;
    $mail = createMailInstance();

    $mail->addAddress($email, $username); 
    $mail->Subject = "Account Has Been Approved";
    $mail->Body = $approve_html;

    $mail->send();
}

function resetEmail($email,$username,$token){
    global $reset_html;
    $mail = createMailInstance();
    $code = encrypt($email);

    $mail->addAddress($email, $username); 
    $mail->Subject = "$username, reset your password";
    $mail->Body = $reset_html;

    $mail->send();
}
















?>
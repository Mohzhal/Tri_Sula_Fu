<?php 
require_once APPPATH."third_party/PHPMailer/PHPMailer.php";
require_once APPPATH."third_party/PHPMailer/SMTP.php";
require_once APPPATH."third_party/PHPMailer/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;	
function sendmail($from, $to, $subject, $content){

	$mail = new PHPMailer(true);

	$mail->isSMTP();
	$mail->SMTPAuth = true;
	$mail->Host = 'smtp.gmail.com';
	$mail->Username = "testajaa112@gmail.com";
	$mail->Password = "tyud nvny zbtw zuur";
	$mail->Port = 465;
	$mail->SMTPSecure = 'ssl';
	// PHPMailer::ENCRYPTION_STARTTLS

	$mail->isHTML(true);
	$mail->setFrom($from);
	$mail->addAddress($to);
	$mail->Subject = $subject;
	$mail->Body = $content;


	if ($mail->send()){
		$response = true;
	}else{
		$response = $mail->ErrorInfo;
	}

	return $response;

}


<?php
add_action('post_mindeset_uplode','email2post');
add_action('send_mindeset_email','emailSend',10,2);

require("PHPMailer_5.2.4/class.phpmailer.php");

class Mail {

	
	public static function sendEmail($to,$subject,$body){
		
		$mail = new PHPMailer();
		$mail->CharSet = 'UTF-8';
		$mail->IsSMTP();  // telling the class to use SMTP
		$mail->Host     = "194.90.105.12"; // SMTP server

		$mail->From     = "globaledtechawards<no-reply@cet.ac.il>";
		$mail->AddAddress($to);

		$mail->Subject  = $subject;
		$mail->Body     = $body;
		$mail->WordWrap = 50;

		if(!$mail->Send()) {
		  return false;
		  //echo 'Mailer error: ' . $mail->ErrorInfo;
		} else {
		  return true;
		}
	}
}


function emailSend($subject,$message){
		
	   $adminEmail=get_option( 'admin_email' );
	  	
	   $mail = new PHPMailer;
	   $mail->CharSet = 'UTF-8';
		$mail->IsSMTP();  // telling the class to use SMTP
		$mail->Host     = "194.90.105.12"; // SMTP server

		$mail->From     = "globaledtechawards<no-reply@cet.ac.il>";
		$mail->AddAddress($adminEmail);

		$mail->Subject  = $subject;
		$mail->Body     = $message;
		$mail->WordWrap = 50;

		if($mail->Send()) {
			echo 'Thanks for your message, you\'ll be replied shortly';
		  return true;
		} else {
				echo 'message send failed, please try again';
			//echo 'Mailer error: ' . $mail->ErrorInfo;
		  return false;
		} 
		 
//	 wp_mail( $adminEmail, $subject, $message, $headers, $attachments ); 

}


function email2post(){
		
	   $adminEmail=get_option( 'admin_email' );
	   $subject='הועלה פוסט לאתר מינדסט';
	   $message='הועלה פוסט לאתר מיננדסט... לידיעתך';
	 	
		
	   $mail = new PHPMailer;
	   $mail->CharSet = 'UTF-8';
		$mail->IsSMTP();  // telling the class to use SMTP
		$mail->Host     = "194.90.105.12"; // SMTP server

		$mail->From     = "globaledtechawards<no-reply@cet.ac.il>";
		$mail->AddAddress($adminEmail);

		$mail->Subject  = $subject;
		$mail->Body     = $message;
		$mail->WordWrap = 50;

		if($mail->Send()) {
		  return true;
		} else {
		  return false;
		} 
		 
//	 wp_mail( $adminEmail, $subject, $message, $headers, $attachments ); 

}


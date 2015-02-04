<?php
add_action('post_mindeset_uplode','email2post');
add_action('send_mindeset_email','emailSend',10,2);
add_action('sendEmail_for_qa','sendEmailForQa',10,3);

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
		//if($email==null){
	        $adminEmail=get_option( 'admin_email' );
        //}
        //else{
	  	    //$adminEmail=$email;
        //}
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
			echo ' <div class="contact-text-server">Thank you for contacting us, we will get back to you shortly.</div>';
		  return true;
		} else {
				echo '<div class="contact-text-server">message send failed, please try again</div>';
			//echo 'Mailer error: ' . $mail->ErrorInfo;
		  return false;
		} 
		 
//	 wp_mail( $adminEmail, $subject, $message, $headers, $attachments ); 

}

function sendEmailForQa($to,$subject,$body){
     $mail = new PHPMailer;
	   $mail->CharSet = 'UTF-8';
		$mail->IsSMTP();  // telling the class to use SMTP
		$mail->Host     = "194.90.105.12"; // SMTP server

		$mail->From     = "globaledtechawards<no-reply@cet.ac.il>";
		$mail->AddAddress($to);

		$mail->Subject  = $subject;
		$mail->Body     = $body;
		$mail->WordWrap = 50;

		if($mail->Send()) {
			
		  return true;
		} else {
				
			
		  return false;
		} 
}
function email2post($id){
		
	   $adminEmail=get_option( 'admin_email' );
       
	   $subject='הועלה פוסט לאתר מינדסט';
	    $message='הועלה פוסט לאתר מיננדסט... לידיעתך';
        $message .= "\n לצפיה בפרטים ולאישור, לחץ על הלינק";
        $message .= "\n" . home_url('/') . "wp-admin/post.php?post=". $id ."&action=edit";
	 	
		
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


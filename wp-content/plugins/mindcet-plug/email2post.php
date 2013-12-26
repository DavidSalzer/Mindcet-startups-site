<?php


add_action('post_mindeset_uplode','email2post');

function email2post(){
	
	  // $headers = 'From: MindCet-Ed Site' . "\r\n";
		
	   $adminEmail=get_option( 'admin_email' );
	   $subject='הועלה פוסט לאתר מיננדסט';
	   $message='הועלה פוסט לאתר מיננדסט... לידיעתך';
	 	 
	 wp_mail( $adminEmail, $subject, $message, $headers, $attachments ); 

}
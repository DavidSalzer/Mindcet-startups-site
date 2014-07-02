<?php
/*
Plugin Name: Draft Notify
Plugin URI: http://www.touchoftechnology.com/draft-notify-wp-plugin-to-send-an-email-when-an-author-saves-a-draft/
Description: When an author saves a post, it sends out an email based on the settings.  Either to a single email address, or to all users above a certain access level.  You can also select whether or not to send emails for revisions.
Author: Andrew Hallman
Version: 1.2
Author URI: http://www.touchoftechnology.com
*/


/*
* The save function
*/

function dddn_process($id) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	// emails anyone on or above this level, unless a specific email address is entered.
	$accessLevel = get_option('draftnotifyuserlevel');  
	$emailAddress = get_option('draftnotifyemail');
        $emailForRevisions = get_option('draftnotifyemailrevisions');
	
                    // Author's first and last name are found in the metadata table.
	$result = $wpdb->get_row("
		SELECT 	post_status, post_title, post_modified, 
                        user_login, display_name, user_email, 
                        {$prefix}usermeta.meta_value as fname, 
                        meta2.meta_value as lname
		FROM 	{$prefix}posts, {$prefix}users
                            LEFT JOIN ({$prefix}usermeta) ON
                                    ({$prefix}usermeta.user_id = {$prefix}users.ID AND 
                                     {$prefix}usermeta.meta_key = 'first_name' )
                            LEFT JOIN ({$prefix}usermeta as meta2) ON
                                    (meta2.user_id = {$prefix}users.ID AND 
                                     meta2.meta_key = 'last_name' )
		WHERE 	{$prefix}posts.post_author = {$prefix}users.ID AND {$prefix}posts.ID = '$id' ");

	if ( (($result->post_status == "draft") || ($result->post_status == "pending")) && $result->post_parent == 0) {

            // first check if there are revisions, or if this is the first save.
            $canEmail = true;
            if(!$emailForRevisions)
            {
                // only check if the setting says to ignore revisions.
                
                $revisionCheck = $wpdb->get_results("
                    SELECT 	* 
                    FROM 	{$prefix}posts
                    WHERE 	{$prefix}posts.post_parent = '$id' AND 
                            {$prefix}posts.post_name != '{$id}-autosave%' ");
                if(count($revisionCheck) > 0)
                {
                    $canEmail = false;
                }
                
            }
            
            // also do the manual check for the autosave of the first draft.  
            $alreadyEmailedList = get_option('draftnotifyemailedlist');
            $emailedEx = explode("|", $alreadyEmailedList);
            
            if(in_array($id, $emailedEx))
            {
                $canEmail = false;
            }
            
            if($canEmail)
            {
		$message = "A draft was created: '" . get_bloginfo('name') . "'\n";
		$message .= "Post Title: " . $result->post_title . "\n";
		$message .= "Post Modified: " . $result->post_modified . "\n";
		//$message .= "Author's Username: " . $result->user_login . "\n<br>";
		
                
                $savedEmailPostLinkVal = get_option('draftnotifyemailpostlink');
                $savedEmailAuthorNameVal = get_option('draftnotifyemailauthorname');
                $savedEmailAuthorEmailAddressVal = get_option('draftnotifyemailauthoremail');
                
                if($savedEmailAuthorNameVal)
                {
                    $message .= "Author's Real Name: {$result->fname} {$result->lname }\n<br>";
                }
                
                
                if($savedEmailAuthorEmailAddressVal)
                {
                    $message .= "Author's Email Address: " . $result->user_email . "\n<br>";
                }
                
                if($savedEmailPostLinkVal)
                {
                    $message .= "\n Link to Pending Posts: " . home_url('/') . "wp-admin/post.php?post=". $id ."&action=edit";
                }
                
		$subject = "Draft on '" . get_bloginfo('name') . "'-" . $result->post_title;

		
		$recipient = $emailAddress;
		if($recipient == "")
		{
			$users = $wpdb->get_results("SELECT user_id FROM {$prefix}usermeta 
			WHERE 	{$prefix}usermeta.meta_key = 'wp_user_level' AND 
					{$prefix}usermeta.meta_value >= " . $accessLevel);
		
			foreach ($users as $user) 
                        {			
				$user_info = get_userdata($user->user_id);
				if($recipient != ""){$recipient .= ',';}
				$recipient .= $user_info->user_email; 
                        }
		} 
		
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		//mail($recipient, $subject, $message, $headers);
             
             do_action('send_mindeset_email',$subject,$message);
                if(!in_array($id, $emailedEx))
                {
                    update_option('draftnotifyemailedlist', "{$alreadyEmailedList}|{$id}" );
                }
            }
	}
	
}
add_action('save_post', 'dddn_process');
add_action('post_mindeset_uplode','dddn_process');








/*
*	Start of the settings page.
*/
add_action('admin_menu', 'draftnotify_admin_add_page');
function draftnotify_admin_add_page() {
	add_options_page('Draft Notify Settings', 'Draft Notify Menu', 'manage_options', 'draftnotify', 'draftnotify_options_page');
	
	add_action('admin_init', 'plugin_admin_init');
}

function plugin_admin_init(){
register_setting( 'draftnotify_options', 'draftnotifyemail' );
register_setting( 'draftnotify_options', 'draftnotifyuserlevel' );
register_setting( 'draftnotify_options', 'draftnotifyemailrevisions' );
register_setting( 'draftnotify_options', 'draftnotifyemailedlist' );
register_setting( 'draftnotify_options', 'draftnotifyemailpostlink' );
register_setting( 'draftnotify_options', 'draftnotifyemailauthorname' );
register_setting( 'draftnotify_options', 'draftnotifyemailauthoremail' );
}


function draftnotify_options_page() {?>
<div>
<h2>Draft Notify Plugin Options</h2>
Use these options to control who and how you get notified about authors creating new drafts.
<form method="post" action="options.php">
<?php 

settings_fields('draftnotify_options');
do_settings_sections('draftnotify_options'); 

echo "<table width='100%'><tr>
<td width='20%' valign='top'><b>Email Address:</b></td>
<td width='20%' valign='top'><input id='draftnotifyemail' name='draftnotifyemail' size='40' type='text' value='".get_option('draftnotifyemail')."' />
<td width='60%' valign='top'>Please enter an email address to send to a specific person.</td>
</td></tr>
<tr>
<td valign='top'><b>Send to all Above Access Level:</b></td>
<td valign='top'>";

// create a dynmaic list based on the available roles.
echo "<select id='draftnotifyuserlevel' name='draftnotifyuserlevel' > ";
$savedSelectVal = get_option('draftnotifyuserlevel');	
$temp =(strlen($savedSelectVal) == 0 || $savedSelectVal < 0)?" selected='selected'":"";
echo "<option value='-1' {$temp}>Use the email Address</option>";

$tempArr = get_editable_roles(); 

foreach($tempArr as $role=>$roleArr)
{
	$tempLevel = getTempLevel($roleArr['capabilities']);
	$temp =($savedSelectVal==$tempLevel)?" selected='selected'":"";
	echo "<option value='{$tempLevel}' {$temp}>{$role}</option>";
}
	
echo "</select></td>
<td valign='top'>If you would like to send to all users above an access level, please select that level in the dropdown.  <br>If you leave both blank, no email will be sent.  If you fill in both, it will use the email address entered.</td>
</tr>
<tr>
<td valign='top'><b>Send Emails when revisions are made:</b></td>
<td valign='top'><select id='draftnotifyemailrevisions' name='draftnotifyemailrevisions' > ";
$savedSelectVal = get_option('draftnotifyemailrevisions');	
$temp =($savedSelectVal == 1)?" selected='selected'":"";
$temp2 =($savedSelectVal == 0)?" selected='selected'":"";
echo "<option value='1' {$temp}>Yes, Recieve emails about all revisions</option>
    <option value='0' {$temp2}>No, Only email about the first draft</option>
</select></td>
<td valign='top'>If you would like an email every time someones saves a revision to the draft, select Yes, otherwise, select NO and you'll only get an email the first time the draft is saved.</td>
</tr>";
      
  echo"<tr><td colspan='3'><h3>Email Format Options</h3></td></tr>";  
$savedEmailPostLinkVal = get_option('draftnotifyemailpostlink');
$savedEmailAuthorNameVal = get_option('draftnotifyemailauthorname');
$savedEmailAuthorEmailAddressVal = get_option('draftnotifyemailauthoremail');

$checked = ($savedEmailPostLinkVal)?" checked='checked' ":"";
echo"<tr>
<td valign='top'><b>Include Link to Posts in Email:</b></td>
<td valign='top'><input id='draftnotifyemailpostlink' name='draftnotifyemailpostlink' type='checkbox' {$checked}> Check to send</td>
<td valign='top'>&nbsp;</td>
</tr>";

$checked = ($savedEmailAuthorNameVal)?" checked='checked' ":"";
echo"<tr>
<td valign='top'><b>Include Author's Real Name in Email:</b></td>
<td valign='top'><input id='draftnotifyemailauthorname' name='draftnotifyemailauthorname' type='checkbox' {$checked}> Check to send</td>
<td valign='top'>&nbsp;</td>
</tr>";

$checked = ($savedEmailAuthorEmailAddressVal)?" checked='checked' ":"";
echo"<tr>
<td valign='top'><b>Include Author's Email Address in Email:</b></td>
<td valign='top'><input id='draftnotifyemailauthoremail' name='draftnotifyemailauthoremail' type='checkbox' {$checked}> Check to send</td>
<td valign='top'>&nbsp;</td>
</tr>";

echo "</table>";

 submit_button(); 
?>
</form></div>

<img style='float:right' width='244' height='228' src='http://www.touchoftechnology.com/wp-content/uploads/2013/02/Logo.jpg'><br><br>This plugin is brought to you by Touch of Tech, Inc.  <a href='http://www.touchoftechnology.com' target='_blank'>www.TouchOfTechnology.com</a><br>
If you have any problems with it, please leave a comment <a href='http://www.touchoftechnology.com/draft-notify-wp-plugin-to-send-an-email-when-an-author-saves-a-draft/'>here</a>.

<?php


}

function getTempLevel($arr)
{
	$tempLevel = -4;
	for($x=0;$x<=10;$x++)
	{
		if(isset($arr["level_{$x}"]) && $arr["level_{$x}"] == 1)
		{
			$tempLevel = $x;
		}
	}
	return $tempLevel;
}

?>

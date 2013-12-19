<div class="wrap">
<?php
$gCounterrors = array();
$gCountsuccess = '';
$gCounterror_found = FALSE;

// Preset the form fields
$form = array(
	'gCount' => '',
	'gCountdisplay' => '',
	'gCountmonth' => '',
	'gCountdate' => '',
	'gCountyear' => '',
	'gCounthour' => '',
	'gCountzoon' => '',
	'gCountid' => ''
);

// Form submitted, check the data
if (isset($_POST['gCountform_submit']) && $_POST['gCountform_submit'] == 'yes')
{
	//	Just security thingy that wordpress offers us
	check_admin_referer('gCountform_add');
	
	$form['gCount'] = isset($_POST['gCount']) ? $_POST['gCount'] : '';
	if ($form['gCount'] == '')
	{
		$gCounterrors[] = __('Please enter the announcement.', WP_gCountUNIQUE_NAME);
		$gCounterror_found = TRUE;
	}

	$form['gCountdisplay'] = isset($_POST['gCountdisplay']) ? $_POST['gCountdisplay'] : '';
	$form['gCountmonth'] = isset($_POST['gCountmonth']) ? $_POST['gCountmonth'] : '';
	$form['gCountdate'] = isset($_POST['gCountdate']) ? $_POST['gCountdate'] : '';
	$form['gCountyear'] = isset($_POST['gCountyear']) ? $_POST['gCountyear'] : '';
	$form['gCounthour'] = isset($_POST['gCounthour']) ? $_POST['gCounthour'] : '';
	$form['gCountzoon'] = isset($_POST['gCountzoon']) ? $_POST['gCountzoon'] : '';

	//	No errors found, we can add this Group to the table
	if ($gCounterror_found == FALSE)
	{
		$sql = $wpdb->prepare(
			"INSERT INTO `".WP_G_Countdown_TABLE."`
			(`gCount`, `gCountdisplay`, `gCountmonth`, `gCountdate`, `gCountyear`, `gCounthour`, `gCountzoon`)
			VALUES(%s, %s, %s, %s, %s, %s, %s)",
			array($form['gCount'], $form['gCountdisplay'], $form['gCountmonth'], $form['gCountdate'], $form['gCountyear'], $form['gCounthour'], $form['gCountzoon'])
		);
		$wpdb->query($sql);
		
		$gCountsuccess = __('New details was successfully added.', WP_gCountUNIQUE_NAME);
		
		// Reset the form fields
		$form = array(
			'gCount' => '',
			'gCountdisplay' => '',
			'gCountmonth' => '',
			'gCountdate' => '',
			'gCountyear' => '',
			'gCounthour' => '',
			'gCountzoon' => '',
			'gCountid' => ''
		);
	}
}

if ($gCounterror_found == TRUE && isset($gCounterrors[0]) == TRUE)
{
	?>
	<div class="error fade">
		<p><strong><?php echo $gCounterrors[0]; ?></strong></p>
	</div>
	<?php
}
if ($gCounterror_found == FALSE && strlen($gCountsuccess) > 0)
{
	?>
	  <div class="updated fade">
		<p><strong><?php echo $gCountsuccess; ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/options-general.php?page=deal-with-countdown">Click here</a> to view the details</strong></p>
	  </div>
	  <?php
}
?>
<script language="JavaScript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/deal-or-announcement-with-countdown-timer/pages/gCountdownform.js"></script>
<div class="form-wrap">
	<div id="icon-edit" class="icon32 icon32-posts-post"><br></div>
	<h2><?php echo WP_gCountTITLE; ?></h2>
	<form name="gCountform" method="post" action="#" onsubmit="return gCountdownform()"  >
      <h3>Add new details</h3>
      
	  <label for="tag-txt">Announcement</label>
      <textarea name="gCount" id="gCount" cols="100" rows="6"></textarea>
      <p>Please enter your announcement text.</p>
      
      <label for="tag-txt">Display status</label>
      <select name="gCountdisplay" id="gCountdisplay">
        <option value=''>Select</option>
		<option value='YES'>Yes</option>
        <option value='NO'>No</option>
      </select>
      <p>Do you want to show this announcement?</p>
	  
	  <label for="tag-txt">Expiration</label>
      <select name="gCountmonth" id="gCountmonth">
		<option value="">--Month--</option>
		<option value='1'>January</option>
		<option value='2'>February</option>
		<option value='3'>March</option>
		<option value='4'>April</option>
		<option value='5'>May</option>
		<option value='6'>June</option>
		<option value='7'>July</option>
		<option value='8'>August</option>
		<option value='9'>September</option>
		<option value='10'>October</option>
		<option value='11'>November</option>
		<option value='12'>December</option>
	  </select>
	  <select name="gCountdate" id="gCountdate">
		<option value="">--Date--</option>
		<?php 
		for($dd = 1; $dd <= 31; $dd++)
		{
			?><option value='<?php echo $dd?>'><?php echo $dd?></option><?php
		}
		?>
	  </select>
	  <select name="gCountyear" id="gCountyear">
		<option value="">--Year--</option>
		<?php 
		for($yy = 2013; $yy <= 2016; $yy++)
		{
			?><option value='<?php echo $yy?>' ><?php echo $yy?></option><?php
		}
		?>
	  </select>
	  <select name="gCounthour" id="gCounthour">
		<option value="">--Time--</option>
		<?php 
		for($hh=1; $hh<=12; $hh++)
		{
			?><option value='<?php echo $hh?>'><?php echo $hh?></option><?php
		}
		?>
      </select>
	  <select name="gCountzoon" id="gCountzoon">
		<option value="">--AM/PM--</option>
		<option value="AM">AM</option>
		<option value="PM">PM</option>
	  </select>
      <p>Please select your expiration date.</p>
	  
      <input name="gCountid" id="gCountid" type="hidden" value="">
      <input type="hidden" name="gCountform_submit" value="yes"/>
      <p style="padding-top:8px;padding-bottom:8px;">
        <input name="publish" lang="publish" class="button" value="Submit" type="submit" />
        <input name="publish" lang="publish" class="button" onclick="gCountredirect()" value="Cancel" type="button" />
        <input name="Help" lang="publish" class="button" onclick="gCounthelp()" value="Help" type="button" />
      </p>
	  <?php wp_nonce_field('gCountform_add'); ?>
    </form>
</div>
<p class="description"><?php echo WP_gCountLINK; ?></p>
</div>
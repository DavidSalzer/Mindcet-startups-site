<div class="wrap">
  <div class="form-wrap">
    <div id="icon-edit" class="icon32 icon32-posts-post"></div>
    <h2><?php echo WP_gCountTITLE; ?></h2>
	<h3>Settings</h3>
    <?php
	$deal_or_announcement_with_countdown_timer_title = get_option('deal_or_announcement_with_countdown_timer_title');
	$deal_or_announcement_with_countdown_timer_timer_color = get_option('deal_or_announcement_with_countdown_timer_timer_color');
	$deal_or_announcement_with_countdown_timer_timer_align = get_option('deal_or_announcement_with_countdown_timer_timer_align');
	$deal_or_announcement_with_countdown_timer_text_color = get_option('deal_or_announcement_with_countdown_timer_text_color');
	$deal_or_announcement_with_countdown_timer_text_align = get_option('deal_or_announcement_with_countdown_timer_text_align');
	$deal_or_announcement_with_countdown_timer_caption = get_option('deal_or_announcement_with_countdown_timer_caption');
	
	if (isset($_POST['gCount_form_submit']) && $_POST['gCount_form_submit'] == 'yes')
	{
		check_admin_referer('gCount_form_setting');
		$deal_or_announcement_with_countdown_timer_title = stripslashes($_POST['deal_or_announcement_with_countdown_timer_title']);
		$deal_or_announcement_with_countdown_timer_timer_color = stripslashes($_POST['deal_or_announcement_with_countdown_timer_timer_color']);
		$deal_or_announcement_with_countdown_timer_timer_align = stripslashes($_POST['deal_or_announcement_with_countdown_timer_timer_align']);
		$deal_or_announcement_with_countdown_timer_text_color = stripslashes($_POST['deal_or_announcement_with_countdown_timer_text_color']);
		$deal_or_announcement_with_countdown_timer_text_align = stripslashes($_POST['deal_or_announcement_with_countdown_timer_text_align']);
		$deal_or_announcement_with_countdown_timer_caption = stripslashes($_POST['deal_or_announcement_with_countdown_timer_caption']);

		update_option('deal_or_announcement_with_countdown_timer_title', $deal_or_announcement_with_countdown_timer_title );
		update_option('deal_or_announcement_with_countdown_timer_timer_color', $deal_or_announcement_with_countdown_timer_timer_color );
		update_option('deal_or_announcement_with_countdown_timer_timer_align', $deal_or_announcement_with_countdown_timer_timer_align );
		update_option('deal_or_announcement_with_countdown_timer_text_color', $deal_or_announcement_with_countdown_timer_text_color );
		update_option('deal_or_announcement_with_countdown_timer_text_align', $deal_or_announcement_with_countdown_timer_text_align );
		update_option('deal_or_announcement_with_countdown_timer_caption', $deal_or_announcement_with_countdown_timer_caption );
		?>
		<div class="updated fade">
			<p><strong>Details successfully updated.</strong></p>
		</div>
		<?php
	}
	?>
	<script language="JavaScript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/deal-or-announcement-with-countdown-timer/pages/gCountdownform.js"></script>
    <form name="ssg_form" method="post" action="">
      
	  <label for="tag-title">Enter widget title</label>
      <input name="deal_or_announcement_with_countdown_timer_title" id="deal_or_announcement_with_countdown_timer_title" type="text" value="<?php echo $deal_or_announcement_with_countdown_timer_title; ?>" size="60" maxlength="1000" />
      <p>Please enter your widget title.</p>
      
	  <label for="tag-title">Timer caption</label>
      <input name="deal_or_announcement_with_countdown_timer_caption" id="deal_or_announcement_with_countdown_timer_caption" type="text" value="<?php echo $deal_or_announcement_with_countdown_timer_caption; ?>" size="60" maxlength="1000" />
      <p>Please enter your timer caption.</p>

	  <label for="tag-title">Timer color</label>
      <input name="deal_or_announcement_with_countdown_timer_timer_color" id="deal_or_announcement_with_countdown_timer_timer_color" type="text" value="<?php echo $deal_or_announcement_with_countdown_timer_timer_color; ?>" maxlength="7" />
      <p>Please enter your timer color.</p>

	  <label for="tag-title">Text color</label>
      <input name="deal_or_announcement_with_countdown_timer_text_color" id="deal_or_announcement_with_countdown_timer_text_color" type="text" value="<?php echo $deal_or_announcement_with_countdown_timer_text_color; ?>" maxlength="7" />
      <p>Please enter your text color.</p>

	  <label for="tag-title">Timer alignment</label>
      <select name="deal_or_announcement_with_countdown_timer_timer_align" id="deal_or_announcement_with_countdown_timer_timer_align">
		<option value="Left" <?php if($deal_or_announcement_with_countdown_timer_timer_align=='Left') { echo 'selected="selected"' ; } ?>>Left</option>
		<option value="Right" <?php if($deal_or_announcement_with_countdown_timer_timer_align=='Right') { echo 'selected="selected"' ; } ?>>Right</option>
		<option value="Center" <?php if($deal_or_announcement_with_countdown_timer_timer_align=='Center') { echo 'selected="selected"' ; } ?>>Center</option>
		<option value="Justify" <?php if($deal_or_announcement_with_countdown_timer_timer_align=='Justify') { echo 'selected="selected"' ; } ?>>Justify</option>
	  </select>
      <p>Please select your timer alignment.</p>

	  <label for="tag-title">Text alignment</label>
      <select name="deal_or_announcement_with_countdown_timer_text_align" id="deal_or_announcement_with_countdown_timer_text_align">
		<option value="Left" <?php if($deal_or_announcement_with_countdown_timer_text_align=='Left') { echo 'selected="selected"' ; } ?>>Left</option>
		<option value="Right" <?php if($deal_or_announcement_with_countdown_timer_text_align=='Right') { echo 'selected="selected"' ; } ?>>Right</option>
		<option value="Center" <?php if($deal_or_announcement_with_countdown_timer_text_align=='Center') { echo 'selected="selected"' ; } ?>>Center</option>
		<option value="Justify" <?php if($deal_or_announcement_with_countdown_timer_text_align=='Justify') { echo 'selected="selected"' ; } ?>>Justify</option>
	  </select>
      <p>Please select your text alignment.</p>
	   
	  <p style="padding-bottom:5px;padding-top:5px;">
		  <input name="gCountsubmit" id="gCountsubmit" class="button" value="Submit" type="submit" />
		  <input name="publish" lang="publish" class="button" onclick="gCountredirect()" value="Cancel" type="button" />
		  <input name="Help" lang="publish" class="button" onclick="gCounthelp()" value="Help" type="button" />
	  </p>
	  <input name="gCount_form_submit" id="gCount_form_submit" value="yes" type="hidden" />
	  <?php wp_nonce_field('gCount_form_setting'); ?>
    </form>
  </div>
  <p class="description"><?php echo WP_gCountLINK; ?></p>
</div>

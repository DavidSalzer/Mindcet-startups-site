<?php
// Form submitted, check the data
if (isset($_POST['frm_gCountdisplay']) && $_POST['frm_gCountdisplay'] == 'yes')
{
	$did = isset($_GET['did']) ? $_GET['did'] : '0';
	
	$gCountsuccess = '';
	$gCountsuccess_msg = FALSE;
	
	// First check if ID exist with requested ID
	$sSql = $wpdb->prepare(
		"SELECT COUNT(*) AS `count` FROM ".WP_G_Countdown_TABLE."
		WHERE `gCountid` = %d",
		array($did)
	);
	$result = '0';
	$result = $wpdb->get_var($sSql);
	
	if ($result != '1')
	{
		?><div class="error fade"><p><strong>Oops, selected details doesn't exist (1).</strong></p></div><?php
	}
	else
	{
		// Form submitted, check the action
		if (isset($_GET['ac']) && $_GET['ac'] == 'del' && isset($_GET['did']) && $_GET['did'] != '')
		{
			//	Just security thingy that wordpress offers us
			check_admin_referer('gCountform_show');
			
			//	Delete selected record from the table
			$sSql = $wpdb->prepare("DELETE FROM `".WP_G_Countdown_TABLE."`
					WHERE `gCountid` = %d
					LIMIT 1", $did);
			$wpdb->query($sSql);
			
			//	Set success message
			$gCountsuccess_msg = TRUE;
			$gCountsuccess = __('Selected record was successfully deleted.', WP_gCountUNIQUE_NAME);
		}
	}
	
	if ($gCountsuccess_msg == TRUE)
	{
		?><div class="updated fade"><p><strong><?php echo $gCountsuccess; ?></strong></p></div><?php
	}
}
?>
<div class="wrap">
  <div id="icon-edit" class="icon32 icon32-posts-post"></div>
    <h2><?php echo WP_gCountTITLE; ?><a class="add-new-h2" href="<?php echo get_option('siteurl'); ?>/wp-admin/options-general.php?page=deal-with-countdown&amp;ac=add">Add New</a></h2>
    <div class="tool-box">
	<?php
		$pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;
		$limit = 20;
		$offset = ($pagenum - 1) * $limit;
		$sSql = "SELECT COUNT(gCountid) AS count FROM ". WP_G_Countdown_TABLE;
		$total = 0;
		$total = $wpdb->get_var($sSql);
		$total = ceil( $total / $limit );
	
		$sSql = "SELECT * FROM `".WP_G_Countdown_TABLE."` order by gCountid desc LIMIT $offset, $limit";
		$myData = array();
		$myData = $wpdb->get_results($sSql, ARRAY_A);
		?>
		<script language="JavaScript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/deal-or-announcement-with-countdown-timer/pages/gCountdownform.js"></script>
		<form name="frm_gCountdisplay" method="post">
      <table width="100%" class="widefat" id="straymanage">
        <thead>
          <tr>
            <th class="check-column" scope="col"><input type="checkbox" name="gCountgroup_item[]" /></th>
			<th scope="col">Announcement</th>
            <th scope="col">Expiration</th>
			<th scope="col">Display</th>
			<th scope="col">Id</th>
          </tr>
        </thead>
		<tfoot>
          <tr>
            <th class="check-column" scope="col"><input type="checkbox" name="gCountgroup_item[]" /></th>
			<th scope="col">Announcement</th>
            <th scope="col">Expiration</th>
			<th scope="col">Display</th>
			<th scope="col">Id</th>
          </tr>
        </tfoot>
		<tbody>
			<?php 
			$i = 0;
			if(count($myData) > 0 )
			{
				foreach ($myData as $data)
				{
					?>
					<tr class="<?php if ($i&1) { echo'alternate'; } else { echo ''; }?>">
						<td align="left"><input type="checkbox" value="<?php echo $data['gCountid']; ?>" name="gCountgroup_item[]"></td>
						<td><?php echo stripslashes($data['gCount']); ?>
						<div class="row-actions">
							<span class="edit"><a title="Edit" href="<?php echo get_option('siteurl'); ?>/wp-admin/options-general.php?page=deal-with-countdown&amp;ac=edit&amp;did=<?php echo $data['gCountid']; ?>">Edit</a> | </span>
							<span class="trash"><a onClick="javascript:gCountdelete('<?php echo $data['gCountid']; ?>')" href="javascript:void(0);">Delete</a></span> 
						</div>
						</td>
						<td><?php echo $data['gCountyear']."-".$data['gCountmonth']."-".$data['gCountdate']."<br>".$data['gCounthour'].":00 ".$data['gCountzoon']; ?></td>
						<td><?php echo $data['gCountdisplay']; ?></td>
						<td><?php echo $data['gCountid']; ?></td>
					</tr>
					<?php 
					$i = $i+1; 
				} 
			}
			else
			{ 
				?><tr><td colspan="5" align="center">No records available.</td></tr><?php 
			} 
			?>
		</tbody>
        </table>
		<?php wp_nonce_field('gCountform_show'); ?>
		<input type="hidden" name="frm_gCountdisplay" value="yes"/>
		<?php
		  $page_links = paginate_links( array(
				'base' => add_query_arg( 'pagenum', '%#%' ),
				'format' => '',
				'prev_text' => __( ' &lt;&lt; ' ),
				'next_text' => __( ' &gt;&gt; ' ),
				'total' => $total,
				'show_all' => False,
				'current' => $pagenum
			) );
		 ?>	
      </form>	
		<div class="tablenav bottom">
			<div class="tablenav-pages"><span class="pagination-links"><?php echo $page_links; ?></span></div>
			<div class="alignleft actions" style="padding-top:8px;">
			  <a class="button" href="<?php echo get_option('siteurl'); ?>/wp-admin/options-general.php?page=deal-with-countdown&amp;ac=add">Add New</a>
			  <a class="button" href="<?php echo get_option('siteurl'); ?>/wp-admin/options-general.php?page=deal-with-countdown&amp;ac=set">Widget setting</a>
			  <a class="button" target="_blank" href="<?php echo WP_gCountFAV; ?>">Help</a>
			</div>		
		</div>
		<h3>Plugin configuration option</h3>
		<ol>
			<li>Add directly in to the theme using PHP code.</li>
			<li>Drag and drop the widget to your sidebar.</li>
		</ol>
	 <p class="description"><?php echo WP_gCountLINK; ?></p>
	</div>
</div>
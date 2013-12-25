<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<?php if (is_search()) { ?>
	   <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>

	<title>
		   <?php
		      if (function_exists('is_tag') && is_tag()) {
		         single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
		      elseif (is_archive()) {
		         wp_title(''); echo ' Archive - '; }
		      elseif (is_search()) {
		         echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
		      elseif (!(is_404()) && (is_single()) || (is_page())) {
		         wp_title(''); echo ' - '; }
		      elseif (is_404()) {
		         echo 'Not Found - '; }
		      if (is_home()) {
		         bloginfo('name'); echo ' - '; bloginfo('description'); }
		      else {
		          bloginfo('name'); }
		      if ($paged>1) {
		         echo ' - page '. $paged; }
		   ?>
	</title>
	
	<link rel="shortcut icon" href="/favicon.ico">
	
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <script id="facebook-jssdk" src="//connect.facebook.net/en_US/all.js#xfbml=1&amp;appId=162470583945071"></script>
    <script src="//platform.linkedin.com/in.js" type="text/javascript">
        lang: en_US
    </script>
    <script type="IN/Share"></script>

	<?php if ( is_singular() ) wp_enqueue_script('comment-reply'); ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="mask"></div>
    <header>
    	<div class="header cf">
        <?php 
				
					$mach=get_option('ye_plugin_options');
	 				$face=$mach['ye_face'];
					$linkin=$mach['ye_linkin'];
					$twitter=$mach['ye_twitter'];
					$ye_tech=$mach['ye_tech'];
				?>
    		<div class="logoAndSocial">
				<a href="http://www.mindcet.org/" class="tagLogo mindcet" target="_blank">
                	<span class="logoMindcet"></span>
                </a>
                <a href="<?php echo  $ye_tech;?>" class="tagLogo" target="_blank">
                	<span class="logoCet"></span>
                </a>
                <div class="timer">
                <?php get_sidebar('countdown');?>
                </div>
                <div class="socialTabs">
                    <a href="<?php echo $linkin; ?>" class="socialTab" target="_blank">
                	    <span class="linkin"></span>
                    </a>
                    <a href="<?php echo $twitter; ?>" class="socialTab" target="_blank">
                	    <span class="twitter"></span>
                    </a>
                    <a href="<?php echo $face; ?>" class="socialTab" target="_blank">
                	    <span class="facebook"></span>
                    </a>			
                </div>
			</div>
          </div>
		<nav class="topNav">
           <?php
		$defaults = array(
          'theme_location'  =>'topMenu',
			'menu'            => 'topMenu',
			'container'       => 'div',
			'container_class' => 'topMenu',
			'menu_class'      => 'menu',
			'echo'            => true,
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		);
		
		wp_nav_menu( $defaults );
		
		?>
           	
           </nav>
    
    
    </header>
 <?php if(!is_front_page()):?>     
	<div id="page-wrap">
<?php endif; ?>
		
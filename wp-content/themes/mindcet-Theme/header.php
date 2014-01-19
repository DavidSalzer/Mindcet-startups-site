<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
    <!--<meta property="og:image" content="<?php //echo site_url();?>/wp-content/uploads/2014/01/final-logo1.png"/>-->
    <meta property="og:title" content="Global EdTech Startup Awards 2014" />
    <meta property="og:description" content="What's your favorite EdTech startup?"/>
    <!--<meta property="og:image" content="http://mindcet.co.il.tigris.nethost.co.il/wp-content/uploads/2014/01/final-logo1.png"/>-->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
     <link rel="image_src" href="<?php echo site_url();?>/wp-content/uploads/2014/01/final-logo1.png" />
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
    
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	<div class="maskall"></div>
	<div class="mask">
    <div id="single-startup-zone"class="inventDescription">
        <div class="inventContener">
        	<span id="invent-close" class="close"></span>

     <!--   <div  class="fb-like invent" data-href="http://localhost/Mindcet-startups-site/?initiator=img3" data-layout="box_count" data-action="like" data-show-faces="false" data-share="false"></div>-->
    		
    
    
        	<div class="inventDescription-append"></div>
        </div>
         <div class="facebook-likes">
        <iframe src="" id="like-frame">
        
        </iframe>
        </div>
<!--        <a href="https://twitter.com/share" class="twitter-share-button" data-url="" data-text="" id="inventTwitterCount">Tweet</a>
<script>
		!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
</script>-->
        <div class="facebook-comments">
        <iframe src="" id="comments-frame">
        
        </iframe>
        </div>
        
    </div>
    <div id="marker-popup" class="mapDescription" style="display: block;">
        <div class="inventContener">
          <span id="invent-close" class="map close"></span>
            <div class="popupDescription-append">
         
            </div>
        </div>
    </div>
    </div>
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
				<!--<a href="http://www.mindcet.org/en/" class="tagLogo mindcet" target="_blank">
                	<span class="logoMindcet"></span>
                </a>-->
                <a href="<?php echo get_theme_mod('link_ImgBg_link');?>" class="tagLogo" target="_blank">
                	<span class="logoCet">
                    	<img src="<?php echo get_theme_mod('link_ImgBg'); ?>" title="<?php echo get_theme_mod('link_ImgBg_text');?>" class="topImgLink">
                    </span>
                </a>
                <div class="timer">
                <?php get_sidebar('countdown');?>
                </div>
                <div class="socialTabs">
                    <div class="socialTab" onClick="openInNewWindow('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo site_url(); ?>&amp;title=<?php echo site_url(); ?>', 100, 100)"><span class="linkin"></span></div>
                    <div class="socialTab" onClick="openInNewWindow('http://twitter.com/intent/tweet?text=<?php echo site_url(); ?>' , 100, 100)"><span class="twitter"></span></div>
                    <div class="socialTab" onClick="openInNewWindow('http://www.facebook.com/sharer/sharer.php?s=100&p[url]=<?php echo site_url(); ?>' , 100, 100)"><span class="facebook"></span></div>
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
		
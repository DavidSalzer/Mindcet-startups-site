<?php
	
	// Add RSS links to <head> section
	automatic_feed_links();
	
	// Load jQuery
	if ( !is_admin() ) {
	   wp_deregister_script('jquery');
	   wp_register_script('jquery', ("http://code.jquery.com/jquery-1.10.1.min.js"), false);
	   wp_enqueue_script('jquery');
	  
	   wp_register_script('cycle', ("http://malsup.github.io/jquery.cycle.all.js"), false);
	   wp_enqueue_script('cycle');
	 
	  wp_register_script('easing', ("http://malsup.github.io/jquery.easing.1.3.js"), false);
	   wp_enqueue_script('easing');
	 
	    wp_register_script('mindcetjs', get_template_directory_uri()."/js/mindcet.js", false);
	   wp_enqueue_script('mindcetjs');
	   
	   
	}
	
	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
    
	// Declare sidebar widget zone
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => 'Sidebar Widgets',
    		'id'   => 'sidebar-widgets',
    		'description'   => 'These are widgets for the sidebar.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2>',
    		'after_title'   => '</h2>'
    	));
		
		
	register_sidebar( array(
		'name'          => 'Countdown  sidebar',
		'id'            => 'countdown',
		'description'   => 'for countdown on the head',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="countdown-title">',
		'after_title'   => '</h3>',
	) );
    }
	
	if(function_exists('register_nav_menus')){
		register_nav_menus( array(
		'topMenu' => 'top Menu',
		'startupMenu'=>'home startup menu',
		'footerMenu'=>'footer menu'
		));
	
	}
?>
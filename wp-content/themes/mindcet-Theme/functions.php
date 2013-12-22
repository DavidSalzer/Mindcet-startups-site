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
	
	
	
	//ajax section
	//wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	//wp_register_script( 'mindcetAjax', get_template_directory_uri(). '/js/mindcetAjax.js',  array('jquery'), 1.0 );
	//wp_enqueue_script('mindcetAjax');
	
   	//add_action( 'wp_ajax_ getAllStartup', 'getStartup' );
	//add_action( 'wp_ajax_nopriv_ getAllStartup', 'getStartup' );  
	//add_action( 'wp_ajax_my_action', 'my_action_callback' );
	//add_action( 'wp_ajax_nopriv_my_action', 'my_action_callback' );
	
	
	function getAllStartup(){
		 $args = array(
        'posts_per_page'   => -1,
        'orderby'          => 'post_date',
        'order'            => 'DESC',
        'post_type'        => 'initiator',
        'post_status'      => 'publish',
        );
    
	$allTech=array();
	
    $myposts = get_posts( $args );
        $caunter=0;
        foreach ( $myposts as $post ) : setup_postdata( $post ); 
    	$techId=$post->ID;
		$title=get_the_title($post->ID);
		$logo=get_the_post_thumbnail( $post->ID,array(220,155), $attr );   
		$descript=get_the_content($post->ID);
		$name=get_post_meta($post->ID,'wpcf-full_mane',true);
		$email=get_post_meta($post->ID,'wpcf-invet_email',true);
		$siteUrl=get_post_meta($post->ID,'wpcf-site-url',true);
		$founder=get_post_meta($post->ID,'wpcf-founder',true);
		$founderEmail=get_post_meta($post->ID,'wpcf-founder-email',true);
		$youtube=get_post_meta($post->ID,'wpcf-youtube-url',true);
		$startupImg=get_post_meta($post->ID,'wpcf-startup-imges');
		
		$tempArry=array('techId'=>$techId,'title'=>$title,'logo'=>$logo,'descript'=>$descript,'name'=>$name,'email'=>$email
		,'siteUrl'=>$siteUrl,'founder'=>$founder,'founderEmail'=>$founderEmail,'youtube'=>$youtube,'startupImg'=>$startupImg);
        $allTech[$techId]=$tempArry;
	  endforeach; 
		return json_encode($allTech);
	}
	
	
	
?>
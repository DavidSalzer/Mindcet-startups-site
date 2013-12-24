<?php
	
	// Add RSS links to <head> section
	automatic_feed_links();
	
	// Load jQuery
	if ( !is_admin() ) {
	   wp_deregister_script('jquery');
	   wp_register_script('jquery', ("http://code.jquery.com/jquery-1.10.1.min.js"), false);
	   wp_enqueue_script('jquery');
	  
	  wp_register_script('easing', ("http://malsup.github.io/jquery.easing.1.3.js"), false);
	   wp_enqueue_script('easing');
	 
	    wp_register_script('mindcetjs', get_template_directory_uri()."/js/mindcet.js", false);
	   wp_enqueue_script('mindcetjs');
	  
	   wp_register_script('deep', (get_template_directory_uri()."/js/deeplink.js"), false);
	   wp_enqueue_script('deep');
	  



	   
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
		//$logo=get_the_post_thumbnail( $post->ID,array(220,155), $attr ); 
       // $thumbnail_id = get_post_thumbnail_id($post->ID);
        //$logo = get_post($thumbail_id);  
		      //  wp_get_attachment_image_src
        $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array(220,155), false, '' );
        $logo= $src;
        $descript=apply_filters ("the_content", $post->post_content);//get_the_content($post->ID);
		$name=get_post_meta($post->ID,'wpcf-full_name',true);
		$email=get_post_meta($post->ID,'wpcf-invet_email',true);
		$siteUrl=get_post_meta($post->ID,'wpcf-site-url',true);
		$founder=get_post_meta($post->ID,'wpcf-founder',true);
		$founderEmail=get_post_meta($post->ID,'wpcf-founder-email',true);
		$youtube=get_post_meta($post->ID,'wpcf-youtube-url',true);
		$startupImg=get_post_meta($post->ID,'wpcf-startup-img',true);
		$startupImg1=get_post_meta($post->ID,'wpcf-startup-img-2',true);
		$startupImg2=get_post_meta($post->ID,'wpcf-startup-img-3',true);
		
        $startupImgArry=array('0'=>$startupImg,'1'=>$startupImg1,'2'=>$startupImg2);
  $tempArry=array('techId'=>$techId,'title'=>$title,'logo'=>$logo,'descript'=>$descript,'name'=>$name,'email'=>$email
  ,'siteUrl'=>$siteUrl,'founder'=>$founder,'founderEmail'=>$founderEmail,'youtube'=>$youtube,'startupImg'=>$startupImgArry);
        $allTech[$techId]=$tempArry;
		//$tempArry=array('techId'=>$techId,'title'=>$title,'logo'=>$logo,'descript'=>$descript,'name'=>$name,'email'=>$email
		//,'siteUrl'=>$siteUrl,'founder'=>$founder,'founderEmail'=>$founderEmail,'youtube'=>$youtube,'startupImg'=>$startupImg,'startupImg1'=>$startupImg,'startupImg2'=>$startupImg);
  //      $allTech[$techId]=$tempArry;
	  endforeach; 
		return json_encode($allTech);
	}
	
	function getAllJudges(){
		 $args = array(
        'posts_per_page'   => -1,
        'orderby'          => 'post_date',
        'order'            => 'DESC',
        'post_type'        => 'judges',
        'post_status'      => 'publish',
        );

    
	$allJudges=array();
	
    $myposts = get_posts( $args );
        $caunter=0;
        foreach ( $myposts as $post ) : setup_postdata( $post ); 
    	$judgesId=$post->ID;
		$title=get_the_title($post->ID);
		$logo=get_the_post_thumbnail( $post->ID,array(220,155), $attr );   
		$descript=get_the_content($post->ID);
		$role=get_post_meta($post->ID,'wpcf-judges_role',true);
		$email=get_post_meta($post->ID,'wpcf-judges_email',true);
		
		$tempArry=array('judgesId'=>$judgesId,'name'=>$title,'imgProfile'=>$logo,'descript'=>$descript,'role'=>$role,'email'=>$email);
        $allJudges[$judgesId]=$tempArry;
	  endforeach; 
		return json_encode($allJudges);
	}
	
	
	///upload file from frontEnd
		//Upload Images
function uploadFile($postId){
	
	$okfile=array('image/gif','image/jpeg','image/jpg','image/pjpeg','image/png','image/x-png');
								
   require_once(ABSPATH . "wp-admin" . '/includes/image.php');
   require_once(ABSPATH . "wp-admin" . '/includes/file.php');
   require_once(ABSPATH . "wp-admin" . '/includes/media.php');
	foreach($_FILES as $field => $file){
			
		if(in_array($_FILES[$file]["type"],$okfile)):

			
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES[$file]["name"]);
		$extension = end($temp);
		
			  $filename=basename($_FILES[$file]["name"]);
			  $uploadedfile = $_FILES[$file];
				  $upload_overrides = array( 'test_form' => false );
				  $uploaded_file  = wp_handle_upload( $uploadedfile, $upload_overrides );
					  if ( $uploaded_file ) {
						// echo "filetype:". $uploaded_file['url'];
						// var_dump($uploaded_file);
						 
						  $attachment = array(
						  'post_title' => $filename,
						  'post_content' => '',
						  'post_type' => 'attachment',
						  'post_parent' => $postId,
						  'post_mime_type' => $_FILES[$file]['type'],
						  'guid' => $uploaded_file['url']
						  );
  
  							
						$id = wp_insert_attachment( $attachment,$uploaded_file['url'], $postid );
				
						if($file=='logo'){
							$metadata = wp_generate_attachment_metadata( $id, $uploaded_file['file']);
							wp_update_attachment_metadata( $id, $metadata );
						
							// Finally! set our post thumbnail
							update_post_meta( $postId, '_thumbnail_id', $id );
						}
						if($file=='img-1'){
							update_post_meta($postId,'wpcf-startup-img',$uploaded_file['url']);
						}
						if($file=='img-2'){
							update_post_meta($postId,'wpcf-startup-img-2',$uploaded_file['url']);
						}
						if($file=='img-3'){
							update_post_meta($postId,'wpcf-startup-img-3',$uploaded_file['url']);
						}
				
				//		echo 'inputName id:'+$inputName;
						//	set_post_thumbnail( $postid, $id );	
						  	//add_post_meta($postid,'wpcf-user_img', $uploaded_file['url']);
							  //Remove it from the array to avoid duplicating during autosave/revisions.
				//			  unset($_FILES[$field]);
  
					 // }else{
						//  $fileEroor='file upload eroor';
						//return $fileEroor; 	 
					}
				endif;	
		  }//end foreach
}

function fileUp($postid){
		if ($_FILES) { //if there is any file
			
    		$fileEr=array();
			$okfile=array('image/gif','image/jpeg','image/jpg','image/pjpeg','image/png','image/x-png');
			$postid=$postid;
			$MAXFILE=1000;	
			
	        require_once(ABSPATH . "wp-admin" . '/includes/image.php');
            require_once(ABSPATH . "wp-admin" . '/includes/file.php');
            require_once(ABSPATH . "wp-admin" . '/includes/media.php');

			
			
	        foreach ($_FILES as $file => $array) {
             //////check file types
			 if(in_array($_FILES[$file]["type"],$okfile)){ //TYPE...
			 
			 $filename=basename($_FILES[$file]["name"]);
			
			 $uploadedfile = $_FILES[$file];
				  $upload_overrides = array( 'test_form' => false );
				 				 //echo "<pre>".print_r($uploadedfile,1)."</pre>";

				  $uploaded_file  = wp_handle_upload( $uploadedfile, $upload_overrides );
					//	echo "<pre>".print_r($uploaded_file,1)."</pre>";
					  if ( $uploaded_file ) {
						// echo "filetype:". $uploaded_file['url'];
						// var_dump($uploaded_file);
						 
						  $attachment = array(
						  'post_title' => $filename,
						  'post_content' => '',
						  'post_type' => 'attachment',
						  'post_parent' => $postid,
						  'post_mime_type' => $_FILES[$file]['type'],
						  'guid' => $uploaded_file['file']
						  );
  
  						//echo ;	
							
						$id = wp_insert_attachment( $attachment,$uploaded_file['file'], $postid );
						if($file=='logo'){
							$metadata = wp_generate_attachment_metadata( $id, $uploaded_file['file']);
							wp_update_attachment_metadata( $id, $metadata );
						
							// Finally! set our post thumbnail
							update_post_meta( $postid, '_thumbnail_id', $id );
						}
				
						if($file=='img-1'){
							update_post_meta($postid,'wpcf-startup-img',$uploaded_file['url']);
						}
						if($inputName=='img-2'){
							update_post_meta($postid,'wpcf-startup-img-2',$uploaded_file['url']);
						}
						if($file=='img-3'){
							update_post_meta($postid,'wpcf-startup-img-3',$uploaded_file['url']);
						}
			  
					  }
			
			 /////
			    if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
                    return "upload error : " . $_FILES[$file]['error'];
                }else{
					//$attach_id = media_handle_upload( $file, $new_post );
				//	echo "file ok<br>";

				}
			 }else{
					switch ($_FILES[$file]["error"]) {
					case 0:
						//is ok ...
						break;
					case 1:
						$fileEr[$file]='file 2 big...';
						break;
					case 2:
						$fileEr[$file]='file 2 big...';
						break;
					case 3:
						$fileEr[$file]='somthing happen...';
						break;
					case 4:
						$fileEr[$file]='no file...';
						break;
					default:
					$fileEr[$file]='no file...';
				 	}
				 
					return $fileEr;
				}//TYPE...      
            }//end forech
			
        //return $fileEr;
		 }


}

?>
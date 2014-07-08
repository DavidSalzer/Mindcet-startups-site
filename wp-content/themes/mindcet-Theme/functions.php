<?php
    $test=0;
        add_filter('locale', 'wpse27056_setLocale');
        function wpse27056_setLocale($locale) {
            if (!is_admin() ) {
                return 'en_US';
            }
    
            return $locale;
        }
    
        // Add RSS links to <head> section
        automatic_feed_links();
    
        add_action('init', 'myStartSession', 1);
        function myStartSession() {                        
            if(!session_id()) {
                session_start();
            }
        }
        wp_enqueue_style( 'mobile', get_template_directory_uri()."/mobile.css" );
        // Load jQuery
        if ( !is_admin() ) {
    
    
           wp_deregister_script('jquery');
           wp_register_script('jquery', ("http://code.jquery.com/jquery-1.10.1.min.js"), false);
           wp_enqueue_script('jquery');
    
    
          wp_register_script('easing', ("http://malsup.github.io/jquery.easing.1.3.js"), false);
           wp_enqueue_script('easing');
    
              wp_register_script('hammer.min', get_template_directory_uri()."/js/hammer.min.js", false);
           wp_enqueue_script('hammer.min');
    
            wp_register_script('mindcetjs', get_template_directory_uri()."/js/mindcet.js", false);
           wp_enqueue_script('mindcetjs');
    
    //
            wp_register_script('deep', (get_template_directory_uri()."/js/deeplink.js"), false);
           wp_enqueue_script('deep');
    
            if(is_front_page()){
                wp_register_script('selection', (get_template_directory_uri()."/js/selection.js"), false);
                wp_enqueue_script('selection');
            }
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
            'topMenuPage'=>'top menu for page',
            'startupMenu'=>'home startup menu',
            'footerMenu'=>'footer menu',
            'footerMenuPage'=>'footer menu for page',
            'logoMenu'=>'logos menu',
            'sponsersLogoMenu'=>'sponsers logo menu'
            ));
    
        }
    
    
    
        //ajax section
        wp_localize_script('function','ajax_script',array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    
            wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );	//wp_register_script( 'mindcetAjax', get_template_directory_uri(). '/js/mindcetAjax.js',  array('jquery'), 1.0 );
        //wp_enqueue_script('mindcetAjax');
    
        add_action( 'wp_ajax_addLike', 'addLike' );
        add_action( 'wp_ajax_nopriv_addLike', 'addLike' );  
    
        add_action( 'wp_ajax_sendMesg', 'sendMesg' );
        add_action( 'wp_ajax_nopriv_sendMesg', 'sendMesg' );  
        //add_action( 'wp_ajax_my_action', 'my_action_callback' );
        //add_action( 'wp_ajax_nopriv_my_action', 'my_action_callback' );
        add_action( 'wp_ajax_catGallery', 'catGallery' );
        add_action( 'wp_ajax_nopriv_catGallery', 'catGallery' ); 
    
        add_action( 'wp_ajax_addStartUp', 'addStartUp' );
        add_action( 'wp_ajax_nopriv_addStartUp', 'addStartUp' ); 
    
        add_action( 'wp_ajax_registerNews', 'registerNews' );
        add_action( 'wp_ajax_nopriv_registerNews', 'registerNews' ); 
        
        add_action( 'wp_ajax_updateLikeTwittStartupSingle', 'updateLikeTwittStartupSingle' );
        add_action( 'wp_ajax_nopriv_updateLikeTwittStartupSingle', 'updateLikeTwittStartupSingle' ); 

        add_action('save_post', 'mailChimpPublishPost');

        function registerNews(){
        $email=$_REQUEST['mail'];
        require_once( get_template_directory().'/inc/Mailchimp.php');
             $listId='8366e2458d';
             $merge_vars=array(
                 'FNAME' =>'anonimus register'
            );
             $apiKey='129c1db8a40f40aa3417c7d277581b9f-us6';
            $mailChimp=new Mailchimp($apiKey);
            //$mailChimp->lists->su
            $result=$mailChimp->lists->subscribe($listId, array('email'=>$email),
                                                $merge_vars,
                                                false,
                                                true,
                                                true,
                                                false
                                               );
            if($result) {
                echo 1;
            }else{
                    echo 2;
                }
            die();
    
    
        }
    
    
        function addStartUp(){
            $privatekey = "6Lc_Pu4SAAAAAP4_SfbPOk9VHWyJnFhU-4HPSgX1";
              $resp = recaptcha_check_answer ($privatekey,
                                            $_SERVER["REMOTE_ADDR"],
                                            $_POST["recaptcha_challenge_field"],
                                            $_POST["recaptcha_response_field"]);
    
              if (!$resp->is_valid) {
                // What happens when the CAPTCHA was entered incorrectly
                    echo '0';
                  }else{
                    echo '1';
    
                    $_SESSION['capch']='capch';
    
                }
            die();
        }
    
    
    
        function catGallery(){
          $catId=$_REQUEST['catId'];
		$tagName=$_REQUEST['tagName'];
		$currentYear=$_REQUEST['currentYear'];
		if($tagName){
			$tag = get_term_by('name', $tagName, 'post_tag');
			$tagId=$tag->term_id;
			//echo "tag id is: ".$tagId;
		}
		
		$args = array( 'posts_per_page' =>-1,'post_type'=>'initiator','year'=>$currentYear,'post_status'=>'publish','cat' => $catId,'tag_id'=>$tagId);
		//$myposts = get_posts( $args );
		
		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) :
		//foreach ( $myposts as $post ) : setup_postdata( $post ); 
		$caunter=0;
		echo "<span class='placholderSlide'></span><ul class='inventList'>";
		 while ( $the_query->have_posts() ) : $the_query->the_post(); 
			?>
    	<?php	
			if($caunter==3){
                    echo "</ul><ul class='inventList'>";
                }else{
                }
        ?>
           <li idtec="<?php echo the_ID();?>">
                <div class="winner"></div>
                <div class="finalList"></div>
                    <div class="img-wrap">
                    <?php echo get_the_post_thumbnail($post->ID, 'medium'); ?>
                    </div>
                <h2><a href="<?php echo get_permalink($post->ID); ?>" idtech="<?php echo the_ID(); ?>">
               <?php echo get_the_title($post->ID);?>    </a> </h2>
            </li>
    <?php	if($caunter==3){
                $caunter=0;
               }
     $caunter++;
        
		//endforeach;
		endwhile;
		endif;
		wp_reset_postdata();
        echo "</ul><span class='placholderSlide'></span>";
               
   
	    die(); 
            } 
    
    
    
            function addLike(){
                $mach=get_option('ye_plugin_options');
                $days=$mach['ye_voteDays'];
                $good=$mach['ye_voteGood'];
                $bad=$mach['ye_voteErorr'];
    
    
                if(isset($_COOKIE['vote'])){
                    echo $bad;
                die;
                }
    
                if(isset($_POST['postId'])){
                    $like= get_post_meta($_POST['postId'],'wpcf-likes',true);
                    if($like==''||empty($like)){
                            //echo $_POST['postId'];
                            $like=1;
                        }else{
                            //echo $like;
                            $like++;
                    }
                     update_post_meta($_POST['postId'],'wpcf-likes', $like);
                     echo $good;
                    }else{
    
    
                } 
    
                setcookie('vote', 'vote', time()+(3600*24*$days));//expire in 1 hour 
    
                die;
            }
    
            function sendMesg(){
                $first=esc_attr($_POST['first']);
                $last=esc_attr($_POST['last']);
                $email=esc_attr($_POST['email']);
                $message=esc_attr($_POST['msg']);
    
              // $adminEmail=get_option( 'admin_email' );
               $subject='התקבלה פניה מהאתר ';
               $subject.= 'From: '.$first.' '.$last.' <'.$email.'>' . "\r\n";
    
    
    
                 do_action('send_mindeset_email',$subject,$message);
                die();
            }
    
    
            /////////////////////////////////end ajax///////////////////////////////////
            function getAllVotes(){
                $current_year = date('Y');
                 $args = array(
                'posts_per_page'   => -1,
                'orderby'          => 'post_date',
                'order'            => 'DESC',
                'post_type'        => 'votes',
                'post_status'      => 'publish',
                'year'             => $current_year
                );
    
            $allVotes=array();
    
            $myposts = get_posts( $args );
    
                $vote=array();
                foreach ( $myposts as $post ) : setup_postdata( $post ); 
                $caunter=0;
    
                $title=get_the_title($post->ID);
                $descript=apply_filters ("the_content", $post->post_content);
                $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array(220,155), false, '' );
                $logo= $src;
    
                $parmalink=get_permalink($post->ID);	
                $long=get_field('longitude',$post->ID);
                $lat=get_field('latitude',$post->ID);
                $rel=get_field('fevorite',$post->ID);
                    foreach($rel as $fav){
                      $vote['favId'][$caunter]=$fav->ID;
                       $caunter++;	
                    }
                $vote['markerId']=$post->ID;
                $vote['title']=$title;
                $vote['logo']=$logo;
                $vote['descript']=$descript;
                $vote['lat']=$lat;
                $vote['lon']=$long;
                $vote['parmalink']=$parmalink;
    
    
                array_push($allVotes,$vote);
                $vote=array();
                endforeach;
                return json_encode($allVotes);
            }
    
    
            function getAllStartup(){
                 $args = array(
                'posts_per_page'   => -1,
                'orderby'          => 'post_date',
                'order'            => 'DESC',
                'post_type'        => 'initiator',
                'post_status'      => 'publish',
                );
    
                $allTech=array();
    
    
        $allYearsTech = array();
    
        foreach(posts_by_year($args) as $year => $posts) :
    
            $allYearsTech[$year] =array() ;
    
    
     foreach($posts as $post) : setup_postdata($post); 
            //the_permalink();  the_title(); 
    
                //$myposts = get_posts( $args );
                $caunter=0;
                //foreach ( $myposts as $post ) : setup_postdata( $post ); 
                $techId=$post->ID;
                $title=get_the_title($post->ID);            
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
                $category=wp_get_post_categories($post->ID);
                $likes=get_post_meta($post->ID,'wpcf-likes',true);
                $slogen= get_post_meta($post->ID, 'wpcf-slogen', true);
                $winner=get_post_meta($post->ID,'wpcf-winner',true);
                $finalList=get_post_meta($post->ID,'wpcf-final-list',true);
                $parmalink=get_permalink($post->ID);
    
                $mach=get_option('ye_plugin_options');
                if($mach['ye_fev']){
                    $ye_fev=$mach['ye_fev'];
                }else{
                    $ye_fev=array();
                    $ye_fev['Img']=get_theme_mod('fev_img');
                    $ye_fev['link']=get_theme_mod('fev_link');
                    $ye_fev['H1']=get_theme_mod('fev_h1');
                    $ye_fev['text']=get_theme_mod('fev_text');
                }
    
                $startupImgArry=array('0'=>$startupImg,'1'=>$startupImg1,'2'=>$startupImg2);
    
                $tempArry=array('techId'=>$techId,'title'=>$title,'slogen'=>$slogen,'logo'=>$logo,'descript'=>$descript,'name'=>$name,'email'=>$email
          ,'siteUrl'=>$siteUrl,'founder'=>$founder,'founderEmail'=>$founderEmail,'youtube'=>$youtube,'startupImg'=>$startupImgArry,'category'=>$category,'like'=>$likes,'winner'=>$winner,'finalList'=>$finalList,'permalink'=>$parmalink);
                $allYearsTech[$year][$techId]=$tempArry;
                $allYearsTech[$year]['fev']=$ye_fev;
    
               endforeach;
    endforeach; 
    
                return json_encode($allYearsTech);
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
    
                                //$fileEr['fileUp']='ok';
    
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
                                if($file=='img-2'){
                                    update_post_meta($postid,'wpcf-startup-img-2',$uploaded_file['url']);
                                }
                                if($file=='img-3'){
                                    update_post_meta($postid,'wpcf-startup-img-3',$uploaded_file['url']);
                                }
    
                              }
    
                     /////
                        if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
                          //  return "upload error : " . $_FILES[$file]['error'];
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
                                $fileEr[$file]='file is too big...';
                                break;
                            case 2:
                                $fileEr[$file]='file is too big...';
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
    
        //castomise thems
        if ( class_exists( 'WP_Customize_Control' ) ) {
    
            class Example_Customize_Textarea_Control extends WP_Customize_Control {
            public $type = 'textarea';
    
            public function render_content() {
?>
<label>
    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
</label>
<?php
          }
      }
    
      }
    
    
      function mytheme_customize_register( $wp_customize ) {
         //All our sections, settings, and controls will be added here
         //1. Define a new section (if desired) to the Theme Customizer
         $wp_customize->add_section( 'my_options', 
               array(
                  'title' =>'midedcet Addon', //Visible title of section
                //  'priority' => 35, //Determines what order this appears in
                //  'capability' => 'edit_theme_options', //Capability needed to tweak
                  'description' => 'Top Link Color setting.', //Descriptive tooltip
               ) 
            );
    
           //2. Register new settings to the WP database...
          $wp_customize->add_setting( 'link_textcolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
               array(
                  'default' => '#6a6a6a', //Default setting/value to save
             //     'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
             //     'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
              //    'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
               ) 
            );  	  
    
             //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
            $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
               $wp_customize, //Pass the $wp_customize object (required)
               'link_textcolor', //Set a unique ID for the control
               array(
                  'label' => 'link color', //Admin-visible name of the control
                  'section' => 'my_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                  'settings' => 'link_textcolor', //Which setting to load and manipulate (serialized is okay)
                  'priority' => 10, //Determines the order this control appears in for the specified section
               ) 
            ) );
    
            //set a img for link at the top
            $wp_customize->add_section( 'Img_link', 
               array(
                  'title' =>'בחירת תמונה', //Visible title of section
                  'description' => 'בחירת תמונה עבור לינק ליד לוגו מינדסט', //Descriptive tooltip
               ) 
            );
    
           //2. Register new settings to the WP database...
          $wp_customize->add_setting( 'link_ImgBg', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
               array(
                  'default' => '', //Default setting/value to save
                   ) 
            );  	  
    
             //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
            $wp_customize->add_control( new WP_Customize_Image_Control( //Instantiate the color control class
               $wp_customize, //Pass the $wp_customize object (required)
               'top_link_ImgBg', //Set a unique ID for the control
               array(
                  'label' => 'תמונת לינק', //Admin-visible name of the control
                  'section' => 'Img_link', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                  'settings' => 'link_ImgBg', //Which setting to load and manipulate (serialized is okay)
                  'priority' => 10, //Determines the order this control appears in for the specified section
               ) 
            ) );
    
            $wp_customize->add_setting( 'link_ImgBg_text', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
               array(
                  'default' => '', //Default setting/value to save
                   ) 
            );  	  
    
             //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
            $wp_customize->add_control( 
               'link_ImgBg_text', //Set a unique ID for the control
               array(
                  'label' => 'טקסט תמונת לינק', //Admin-visible name of the control
                  'section' => 'Img_link', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                  'settings' => 'link_ImgBg_text', //Which setting to load and manipulate (serialized is okay)
                  'priority' => 10, //Determines the order this control appears in for the specified section
               ) 
             );
    
    
          $wp_customize->add_setting( 'link_ImgBg_link', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
               array(
                  'default' => 'http://www.mindcet.org/', //Default setting/value to save
                   ) 
            );  	  
    
             //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
            $wp_customize->add_control( 
               'link_ImgBg_link', //Set a unique ID for the control
               array(
                  'label' =>'הכנס לינק', //Admin-visible name of the control
                  'section' => 'Img_link', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                  'settings' => 'link_ImgBg_link', //Which setting to load and manipulate (serialized is okay)
                  'priority' => 10, //Determines the order this control appears in for the specified section
               ) 
             );
    
    
            $wp_customize->add_section( 'defult_year', 
               array(
                  'title' =>'שנה דיפולטיבית', //Visible title of section
                  'description' => 'יציג את רשימת הסטארטפים מהשנה הזאת.', //Descriptive tooltip
               ) 
            );
    
             $wp_customize->add_setting( 'default_year_text', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
               array(
                  'default' => '', //Default setting/value to save
                   ) 
            );  	  
    
    
            ////  //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
            $wp_customize->add_control( 
               'default_year_text_input', //Set a unique ID for the control
               array(
                  'label' => 'שנה', //Admin-visible name of the control
                  'section' => 'defult_year', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                  'settings' => 'default_year_text', //Which setting to load and manipulate (serialized is okay)
                  'priority' => 10, //Determines the order this control appears in for the specified section
               ) 
             );
    
    
    //       //set a img for link at the top
            $wp_customize->add_section( 'fev_defult', 
               array(
                  'title' =>'מועדף defult', //Visible title of section
                  'description' => 'פבוריט בריירת מחדל אם לא נבחר אחר', //Descriptive tooltip
               ) 
            );
    
           //2. Register new settings to the WP database...
          $wp_customize->add_setting( 'fev_img', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
               array(
                  'default' => '', //Default setting/value to save
                   ) 
            );  	  
    
             //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
            $wp_customize->add_control( new WP_Customize_Image_Control( //Instantiate the color control class
               $wp_customize, //Pass the $wp_customize object (required)
               'fev_Bg', //Set a unique ID for the control
               array(
                  'label' => 'תמונת לינק', //Admin-visible name of the control
                  'section' => 'fev_defult', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                  'settings' => 'fev_img', //Which setting to load and manipulate (serialized is okay)
                  'priority' => 10, //Determines the order this control appears in for the specified section
               ) 
            ) );
    
                $wp_customize->add_setting( 'fev_link', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
               array(
                  'default' => '', //Default setting/value to save
                   ) 
            );  	  
    
    
              //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
            $wp_customize->add_control( 
               'fev_link_area', //Set a unique ID for the control
               array(
                  'label' => 'לינק', //Admin-visible name of the control
                  'section' => 'fev_defult', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                  'settings' => 'fev_link', //Which setting to load and manipulate (serialized is okay)
                  'priority' => 10, //Determines the order this control appears in for the specified section
               ) 
             );
    
    
            $wp_customize->add_setting( 'fev_h1', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
               array(
                  'default' => '', //Default setting/value to save
                   ) 
            );  	  
    
    
             //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
            $wp_customize->add_control( 
               'fev_title', //Set a unique ID for the control
               array(
                  'label' => 'כותרת', //Admin-visible name of the control
                  'section' => 'fev_defult', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                  'settings' => 'fev_h1', //Which setting to load and manipulate (serialized is okay)
                  'priority' => 10, //Determines the order this control appears in for the specified section
               ) 
             );
    
              $wp_customize->add_setting( 'fev_text', 
               array(
                  'default' => 'Some default text', 
                   ) 
            );  	  
    
    
            $wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'textarea_setting', array(
              'label'   => 'Textarea Setting',
              'section' => 'fev_defult',
              'settings'   => 'fev_text',
          ) ) );
    
    
    
    
      }
      add_action('wp_head','getCssForLink');
    
      add_action( 'customize_register', 'mytheme_customize_register' );
    
      //function to get the theam setting
      function getCssForLink(){
?>
<style>
    .topMenu ul li a{
        color:<?php echo get_theme_mod('link_textcolor');?>;
    }
    
</style>
<?php
    }
    
?>


<?php
    
    
    
    function mailChimp($email,$name){
         require_once( get_template_directory().'/inc/Mailchimp.php');
         $listId='8366e2458d';
         $merge_vars=array(
             'FNAME' => $name
        );
         $apiKey='129c1db8a40f40aa3417c7d277581b9f-us6';
        $mailChimp=new Mailchimp($apiKey);
        //$mailChimp->lists->su
        $result=$mailChimp->lists->subscribe($listId, array('email'=>$email),
                                            $merge_vars,
                                            false,
                                            true,
                                            true,
                                            false
                                           );
        if($result)return true;
    }

    function mailChimpPublishPost($id){
        if( ( $_POST['post_status'] == 'publish' ) && ( $_POST['original_post_status'] != 'publish' ) ){
           
            $post = get_post($id);
            setup_postdata($post);
            $title=get_the_title($post->ID); 
            $email=get_post_meta($post->ID,'wpcf-email_up',true);
            $link=get_permalink($post->ID);
    // $recipient="treut@cambium.co.il";
    //  $message="qqqq" .$email;
    //
    //          
    //           $subject='התקבלה פניה מהאתר ';
    //mail($email, $subject, $message);

        require_once( get_template_directory().'/inc/Mailchimp.php');
         $listId='8366e2458d';
         $merge_vars=array(
             'FNAME' => $name,
             'STATUS'=> 'published',
             'LINK' => $link
        );
         $apiKey='129c1db8a40f40aa3417c7d277581b9f-us6';
        $mailChimp=new Mailchimp($apiKey);        
        $result=$mailChimp->lists->updateMember($listId, array('email'=>$email),
                                            $merge_vars,
                                            false,
                                            true,
                                            true,
                                            false
                                           );
        if($result)return true;
        
        
        }
               
    }
    
    
    
    require( get_template_directory() .'/inc/recaptcha-php/recaptchalib.php' );
    
    function myCapch(){
?>
<script type="text/javascript">
    var RecaptchaOptions = {
       theme : 'clean'
    };
</script>
<?php
    
                    // Get a key from https://www.google.com/recaptcha/admin/create
                    //qa
                    //$publickey = "6LdQPu4SAAAAACRzwW4h8VQtluCUAqLiMrhRQNKp";
                    //$privatekey = "6LdQPu4SAAAAAPdPdicVgCnfxcw4N9xb0z_wKX1E";

                    //production
                    $publickey = "6Lc_Pu4SAAAAAPo3yZJ8UQkagt5Wm_tA4W5x8Qpz";
                    $privatekey = "6Lc_Pu4SAAAAAP4_SfbPOk9VHWyJnFhU-4HPSgX1";
    
                    # the response from reCAPTCHA
                    $resp = null;
                    # the error code from reCAPTCHA, if any
                    $error = null;
    
                    # was there a reCAPTCHA response?
                    echo recaptcha_get_html($publickey,$error);
    
        }
    
        function myCapchIsValid(){
          $privatekey = "6LdQPu4SAAAAAPdPdicVgCnfxcw4N9xb0z_wKX1E";
          $resp = recaptcha_check_answer ($privatekey,
                                        $_SERVER["REMOTE_ADDR"],
                                        $_POST["recaptcha_challenge_field"],
                                        $_POST["recaptcha_response_field"]);
    
          if (!$resp->is_valid) {
            // What happens when the CAPTCHA was entered incorrectly
            die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
                 "(reCAPTCHA said: " . $resp->error . ")");
          } else {
            // Your code here to handle a successful verification
          }
    
        }
    
    
        function posts_by_year() {
      // array to use for results
      $years = array();
    
      // get posts from WP
      $posts = get_posts(array(
        'numberposts' => -1,
        'orderby' => 'post_date',
        'order' => 'ASC',
        'post_type' => 'initiator',
        'post_status' => 'publish'
      ));
    
      // loop through posts, populating $years arrays
      foreach($posts as $post) {
        $years[date('Y', strtotime($post->post_date))][] = $post;
      }
    
      // reverse sort by year
      krsort($years);
    
      return $years;
    }
    
    function get_defauly_year(){
       $defaultYear=get_theme_mod('default_year_text');
    
       if($defaultYear!=""){
           return $defaultYear;
       }
       return date('Y');
    }

   function updateLikeTwittStartupSingle(){
        $id=$_REQUEST['id'];
        $post = get_post($id);
        setup_postdata($post);
        $data=(array)json_decode(file_get_contents("https://graph.facebook.com/?ids=".str_replace("?p=","?initiator=",get_permalink($post->ID))));
        $data=$data[key($data)];               
        update_post_meta( $post->ID, 'wpcf-likes', $data->shares );

        $twitt=json_decode(file_get_contents("http://urls.api.twitter.com/1/urls/count.json?url=".str_replace("?p=","?initiator=",get_permalink($post->ID))));               
        update_post_meta( $post->ID, 'wpcf-twitts', $twitt->count );
        echo 1;
   }

    //function updateLikeTwittStartup(){
    //    $args = array(
    //        'posts_per_page'   => -1,
    //        'orderby'          => 'post_date',
    //        'order'            => 'DESC',
    //        'post_type'        => 'initiator',
    //        'post_status'      => 'publish',
    //    );
    //       
    //    
    //    //loop all startup and update likes and twiits
    //    foreach(posts_by_year($args) as $year => $posts) : 
    //        foreach($posts as $post) : setup_postdata($post);             
    //            $data=(array)json_decode(file_get_contents("https://graph.facebook.com/?ids=".str_replace("?p=","?initiator=",get_permalink($post->ID))));
    //            $data=$data[key($data)];
    //            //echo "https://graph.facebook.com/?ids=".get_permalink($post->ID);
    //            //echo "shares: ". $data->shares ."<br/>\n";
    //            
    //           update_post_meta( $post->ID, 'wpcf-likes', $data->shares );

    //           $twitt=json_decode(file_get_contents("http://urls.api.twitter.com/1/urls/count.json?url=".str_replace("?p=","?initiator=",get_permalink($post->ID))));
    //            //$twitt=$twitt->count;
    //            //echo $twitt;
    //            update_post_meta( $post->ID, 'wpcf-twitts', $twitt->count );
    //           
    //        endforeach;
    //    endforeach; 
    //
    //            
    //}

   
    
    
    

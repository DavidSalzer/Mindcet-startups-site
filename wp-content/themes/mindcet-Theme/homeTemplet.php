<?php
    /*
        Template Name: Home Page
    */
        get_header(); 
?>
<?php
    
    //add_post_meta(165,'wpcf-user_img', 
    //	"http://localhost/mindset/wp-content/uploads/2013/12/free-images1-big.jpg"
    //);
?>
<?
    set_post_thumbnail( 165, 176177178179 );
    
    
?>


<div id="newsletter-btn"></div>


<div class="page-wrap">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <section class="home">
        <?php  echo get_the_post_thumbnail( $page->ID, 'full',array('class'=>'mainPageBg'));?>
        <!--<div class="fb-like" data-href="http://localhost/Mindcet-startups-site/" data-layout="standard" data-action="like" data-show-faces="false" data-share="false"></div>-->
        <div id="fb-like-site" class="fb-img">
            <div class="fb-like" data-href="<?php echo site_url(); ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false">
            </div>
        </div>

        <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" data-size="small" data-count="horizontal" data-url="<?php echo site_url(); ?>" data-text="What's your favorite EdTech startup? Global EdTech Startup Awards 2015. &#35;Edtech #Startups #Education">Tweet</a>

        <div class="entry">
            <div class="entry-design">
                <a href="/?page_id=8" id="offerStartUp">Add a Startup</a>

                <!-- AddThis Button BEGIN -->
                                    <!--<div class="addthis_toolbox addthis_default_style">
                                                                                                                                                                                                                                                                                                                                                                                                                            <a class="addthis_button_tweet"></a>
                                                                                                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                                                                            <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
                                                                                                                                                                                                                                                                                                                                                                                                                            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52d6681e180b98e3"></script>-->
                <!-- AddThis Button END -->
            </div>
        </div>

        <!----form inventors--->
        <?php
            
              if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "new_post"&& isset($_POST['submit'])) {
                 //get the category
           // do_action('sendEmail_for_qa',"treut@cambium.co.il","test1","there is post");
                 if($_SESSION['capch']!='capch'){
                             $error['initiator']= "<div class='form-end-message'>Oops!<br><br> Something got wrong, please try again</div><div class='planes'></div>";	
           // do_action('sendEmail_for_qa',"treut@cambium.co.il","test2","error captcha");
                }
                   //check wich categories choose
                    $args = array(
                        'orderby' => 'name',
                        'order' => 'ASC',
                        'hide_empty'=>0
                    );
                    $categories = get_categories($args);
                    $selectCat=array();
                    
                    foreach($categories as $category) { 
                        if(isset($_POST[ $category->term_id])){array_push($selectCat,$category->term_id);}
                    }
                 
                   // if($_POST['category']!='none'){$selectCat=$_POST['category'];}

                    //check wich tags choose
                    $arg=array('hide_empty'=>false,'orderby'=>'name','order' => 'ASC');
                    $tags = get_tags($arg);
                    $selectTag=array();
                    foreach ( $tags as $tag ) {                        
                        if(isset($_POST[ "tag".$tag->term_id])){array_push($selectTag,$tag->name);}
                    }
                               
                    //array_push($selectTag,"test tag");
                  //if($_POST['tags']!='none'){$tag=$_POST['tags'];}

                  $selectChannel=array();

                  if(isset($_POST['making-education'])){array_push($selectChannel,'making-education');}
                  if(isset($_POST['iot-in-education'])){array_push($selectChannel,'iot-in-education');}
                  if(isset($_POST['safety-net'])){array_push($selectChannel,'safety-net');}
            
                 

                // Do some minor form validation to make sure there is content
                if (isset ($_POST['title'])) {
                    $title =  $_POST['title'];
                } else {
                    echo 'Please enter the wine name';
                }
                if (isset ($_POST['description'])) {
                    $description = nl2br($_POST['description']);
                } else {
                    echo 'Please enter some notes';
                }
            
                if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                 // $error= "E-mail is not valid";
                }else{
                  $email= $_POST['email'];
                }
                if (isset ($_POST['city'])) {
                    $city =  $_POST['city'];
                } else {
                    echo 'Please enter the city';
                }
                if (isset ($_POST['country'])) {
                    $country =  $_POST['country'];
                } else {
                    echo 'Please enter the country';
                }

                
                if(!filter_var($_POST['founderMail'], FILTER_VALIDATE_EMAIL)){
                 // $error['email']= "E-mail Founder is not valid";
            
                }else{
                  $founderMail= $_POST['founderMail'];
                }
                if(!filter_var($_POST['site'], FILTER_VALIDATE_URL)){
                 //  $error['url']= "URL is not valid";
                }else{
                  $site=$_POST['site'];
                }
                //if( $my_post=get_page_by_title( $title, 'OBJECT', 'initiator' )){
                //     $error['initiator']= "<div class='form-end-message'>Oops!<br><br> Something got wrong, please try again</div><div class='planes'></div>";	
                //   //   
                //}else{
                    if(empty($error['initiator'])){
                        // do_action('sendEmail_for_qa',"treut@cambium.co.il","test3","not empty");
                        $name=filter_input(INPUT_POST,'invetName',FILTER_SANITIZE_STRING);
                        $founder=filter_input(INPUT_POST,'founder',FILTER_SANITIZE_STRING);
                        $youtubeUrl=filter_input(INPUT_POST,'youtubeUrl',FILTER_SANITIZE_STRING);
                        $slogen=filter_input(INPUT_POST,'slogen',FILTER_SANITIZE_STRING);
                        // ADD THE FORM INPUT TO $new_post ARRAY
                        $new_post = array(
                        'post_title'	=>	$title,
                        'post_content'	=>	$description,
                        'post_status'	=>	'pending',           // Choose: publish, preview, future, draft, etc.
                        'post_type'	=>	'initiator',  //'post',page' or use a custom post type if you want to
                        'post_category' => $selectCat,
                        'tags_input'=>$selectTag
                        );
            
                        //SAVE THE POST
                        $pid = wp_insert_post($new_post);
                        
                       //  do_action('sendEmail_for_qa',"treut@cambium.co.il","test4","post id"+$pid);
                       wp_set_object_terms( $pid,$selectChannel, 'channel' );
                       
                       //SET OUR CASTUOM FIELDS
            
                        update_post_meta($pid, 'wpcf-full_name', $name);
                        update_post_meta($pid, 'wpcf-city', $city);
                        update_post_meta($pid, 'wpcf-country', $country);
                        update_post_meta($pid, 'wpcf-email_up', $email);
                        update_post_meta($pid, 'wpcf-site-url', $site);
                        update_post_meta($pid, 'wpcf-founder', $founder);
                        update_post_meta($pid, 'wpcf-founder-email', $founderMail);
                        update_post_meta($pid, 'wpcf-slogen', $slogen);
            
                       update_post_meta($pid, 'wpcf-youtube-url', $youtubeUrl);
            
            
                    //uploadFile($pid);
                        $fileEr=fileUp($pid);	
            
                        //destroy session
                        $_SESSION['capch']=='';
                        unset($_SESSION['capch']);
            
            
                        // subscrib to mailchimp
                        if(isset($_POST['ads']) && $_POST['ads']=='yes')
                         mailChimp( $email, $name);
            
                        do_action('post_mindeset_uplode',$pid);
            
                        //REDIRECT TO THE NEW POST ON SAVE
                    //	$link = get_permalink( $pid );
                    }//if empty eprrr
              //  }//if post is not there...
            
            } // END THE IF STATEMENT THAT STARTED THE WHOLE FORM
            
            //POST THE POST YO
            do_action('wp_insert_post', 'wp_insert_post');
            
        ?>
        <div id="offer-zone" class="inventorPopUp">
            <div id="offer-zone-inner">
                <div id="sign-header-mobile" class="mobile-header">Sign Your Startup</div>
                <div id="validate-area">
                    <div id="validate-general-error" class="validate-error">* please insert a valid text
                    </div>
                    <div id="validate-checkbox-error" class="validate-error">* please check it out...
                    </div>
                    <div id="validate-description-error" class="validate-error">* please insert less than 200 words to description field
                    </div>
                    <div id="validate-img-error" class="validate-error">* file is too big, Please ensure that file size is less than 2Mb
                    </div>
                    <div id="validate-slogen-error" class="validate-error">* please insert text with maximum 140 characters mission field
                    </div>
                </div>
                <span class="close"></span>
                <span class="triangle"></span>
                <form id="new_post" name="new_post" class="popInvent" method="post" action="" class="wpcf7-form" enctype="multipart/form-data">

                    <div id="formPart1">
                        <?php
                            //echo get_theme_mod('competition_status_check_box');
                            if(1 == get_theme_mod('competition_status_check_box')){
                            
                        ?>
                        <!-- post Category -->
                        <input type="text" id="invetName" value="" tabindex="10" name="invetName" placeholder="Your name" />*
                        <!-- post Category -->
                        <fieldset class="formfield">
                            <input type="email" id="email" value="" tabindex="11" name="email" placeholder="Your E-Mail" /> *
                        </fieldset>

                        <input type="text" id="city" value="" tabindex="11" name="city" placeholder="Your City" /> *

                        <input type="text" id="country" value="" tabindex="11" name="country" placeholder="Your Country" /> *
                        <!-- post name -->
                        <input type="text" id="title" value="" tabindex="12" name="title" placeholder="StartUp name" /> *
                        <!-- post Category -->
                        <input type="text" id="founder" value="" tabindex="13" name="founder" placeholder="Founder" />

                        <!-- post Category -->
                        <input type="email" id="founderMail" value="" tabindex="14" name="founderMail" placeholder="Founder E-Mail" />

                        <!-- post slogen -->
                        <input type="text" id="slogen" value="" tabindex="15" name="slogen" placeholder="Startup's tagline in 140 characters or less" />*
                        <?php
                            }
                            else{
                        ?>
                        <div id="stop-up-startup" class="form-end-message">
                        The Applications stage is over.<br> We invite you to apply to the next year competition.
                            <div class="planes"></div>
                            <div class="form-end-social">
                                <a href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]=<?php echo site_url(); ?>&p[images][0]=<?php echo get_theme_mod('link_ImgBg');?>&p[title]=Global EdTech Startup Awards 2015&p[summary]=What's your favorite EdTech startup?" class="social fb" title="(Share on Facebook)" target="_blank">Share on <span class="letter-space">Facbook</span></a>

                                <!--<a href="http://twitter.com/intent/tweet?text=What's your favorite EdTech startup? %0D%0AGlobal EdTech Startup Awards 2014. <?php echo site_url(); ?> &hashtags=Edtech,Startups,Education" class="social twitter" title="(Tweet This Link)" target="_blank">Share on <span class="letter-space">Twitter</span></a<?php echo site_url(); ?> &hashtags=Edtech,Startups,Education" class="social twitter" title="(Tweet This Link)" target="_blank">Share on <span class="letter-space">Twitter</span></a><?php echo site_url(); ?> &hashtags=Edtech,Startups,Education" class="social twitter" title="(Tweet This Link)" target="_blank">Share on <span class="letter-space">Twitter</span></a><?php echo site_url(); ?> &hashtags=Edtech,Startups,Education" class="social twitter" title="(Tweet This Link)" target="_blank">Share on <span class="letter-space">Twitter</span></a><?php echo site_url(); ?> &hashtags=Edtech,Startups,Education" class="social twitter" title="(Tweet This Link)" target="_blank">Share on <span class="letter-space">Twitter</span></a<?php echo site_url(); ?> &hashtags=Edtech,Startups,Education" class="social twitter" title="(Tweet This Link)" target="_blank">Share on <span class="letter-space">Twitter</span></a><?php echo site_url(); ?> &hashtags=Edtech,Startups,Education" class="social twitter" title="(Tweet This Link)" target="_blank">Share on <span class="letter-space">Twitter</span></a><?php echo site_url(); ?> &hashtags=Edtech,Startups,Education" class="social twitter" title="(Tweet This Link)" target="_blank">Share on <span class="letter-space">Twitter</span></a><?php echo site_url(); ?> &hashtags=Edtech,Startups,Education" class="social twitter" title="(Tweet This Link)" target="_blank">Share on <span class="letter-space">Twitter</span></a<?php echo site_url(); ?> &hashtags=Edtech,Startups,Education" class="social twitter" title="(Tweet This Link)" target="_blank">Share on <span class="letter-space">Twitter</span></a><?php echo site_url(); ?> &hashtags=Edtech,Startups,Education" class="social twitter" title="(Tweet This Link)" target="_blank">Share on <span class="letter-space">Twitter</span></a><?php echo site_url(); ?> &hashtags=Edtech,Startups,Education" class="social twitter" title="(Tweet This Link)" target="_blank">Share on <span class="letter-space">Twitter</span></a>-->
                                <span class="social twitter" onclick="openInNewWindow('http://twitter.com/intent/tweet?text=What\'s your favorite EdTech startup? %0D%0AGlobal EdTech Startup Awards 2015. <?php echo site_url(); ?> &hashtags=Edtech,Startups,Education' , 100, 100)">Share on <span class="letter-space">Twitter</span></span>

                                <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo site_url(); ?>&amp;title=Global EdTech Startup Awards 2015&summary=What's your favorite EdTech startup?" class="social linkedin" title="(Share on LinkedIn)" target="_blank">Share on <span class="letter-space">LinkedIn</span></a>

                            </div>
                        </div>
                        <?php
                            }
                            
                            
                        ?>

                    </div>
                    <?php
                        if(1 == get_theme_mod('competition_status_check_box')){
                    ?>

                    <div id="formPart1-2">
                       
                        <div class="categories">Startup's categories <span class="astro">*</span>
                            <div id="validate-select-error" class="validate-error">* Please select at least one
                            </div>
                            <br>
                        </div>                          
                        <fieldset class="categories-input" id="category">
                            <div class="categories">Select Sector</div>                         
                            <?php
                                $args = array(
                                  'orderby' => 'name',
                                  'order' => 'ASC',
                                  'hide_empty'=>0
                                  );
                                $categories = get_categories($args);
                                foreach($categories as $category) { ?>
                                    <label for="<?php echo $category->term_id;?>"><input type="checkbox" id="<?php echo $category->term_id;?>" name="<?php echo $category->term_id;?>" value="<?php echo $category->term_id;?>"><span></span><?php echo $category->name ;?><br></label>
                               
                            <?php } ?>
                        
                        </fieldset>
                        
                        <fieldset class="categories-input" id="tags">
                            <div class="categories">Select product category</div>
                            <?php
                                    
                                $arg=array('hide_empty'=>false,'orderby'=>'name','order' => 'ASC');
                                $tags = get_tags($arg);
                                foreach ( $tags as $tag ) {
                                    $tag_link = get_tag_link( $tag->term_id );
                                    $nameTag=$tag->name;
                                    if(strtolower($nameTag)=='other'){ 
                                        $last='<label for="tag'.$tag->term_id.'"><input type="checkbox" id="tag'.$tag->term_id.'" name="tag'.$tag->term_id.'" value="'.$tag->term_id.'"><span></span>'.$tag->name.'<br></label>';
                                    }else{
                            ?>                               
                                        <label for="tag<?php echo $tag->term_id;?>"><input type="checkbox" id="tag<?php echo $tag->term_id;?>" name="tag<?php echo $tag->term_id;?>" value="<?php echo $tag->term_id;?>"><span></span><?php echo $tag->name;?><br></label>
                                    <?php }?>
                            <?php
                                }//end foreach
                                echo $last;
                                ?>
                        </fieldset>                                               

                        <fieldset class="categories-input" id="tracks">
                            <div class="categories">Check here if you want to participate in the special tracks of the competition</div>                           
                            <label for="making-education"><input type="checkbox" id="making-education" name="making-education" value="17"><span></span>Making Education<br></label>
                            <label for="iot-in-education"><input type="checkbox" id="iot-in-education" name="iot-in-education" value="19"><span></span>IoT in Education<br></label>
                            <label for="safety-net"> <input type="checkbox" id="safety-net" name="safety-net" value="20"><span></span>Safety Net<br></label>                           
                        </fieldset>

                    </div>
                    <div id="formPart2">
                        <textarea id="description" tabindex="20" name="description" cols="30" rows="1" placeholder="About the startup"></textarea>*
                        <input type="url" id="site" value="" tabindex="21" name="site" placeholder="Link to website" />*
                        <fieldset class="formfield">
                            <input type="url" id="youtubeUrl" value="" tabindex="22" name="youtubeUrl" placeholder="Link to video (YouTube/Vimeo)" />
                        </fieldset>

                        <fieldset class="formfield input-border">
                            <span class="title-logo logoimg">Logo</span>
                            <div class="upload" onclick="getFile('#logo')">Select file</div>
                            <div class="input-outer">
                                <input type="file" id="logo" value="Upload" name="logo" tabindex="23" name="logo" placeholder="" onchange="sub(this)" />
                            </div>
                        </fieldset>
                        <fieldset class="formfield input-border">
                            <span class="title-logo img1">Add a photo</span>
                            <div class="upload" onclick="getFile('#img-1')">Select file</div>
                            <div class="input-outer">
                                <input type="file" id="img-1" value="" tabindex="24" name="img-1" placeholder="" onchange="sub(this)" />
                            </div>
                        </fieldset>
                        <fieldset class="formfield input-border">
                            <span class="title-logo img2">Add a photo</span>
                            <div class="upload" onclick="getFile('#img-2')">Select file</div>
                            <div class="input-outer">
                                <input type="file" id="img-2" value="" tabindex="25" name="img-2" placeholder="" onchange="sub(this)" />
                            </div>
                        </fieldset>

                        <fieldset class="formfield input-border">
                            <span class="title-logo img3">Add a photo</span>
                            <div class="upload" onclick="getFile('#img-3')">Select file</div>
                            <div class="input-outer">
                                <input type="file" id="img-3" value="" tabindex="26" name="img-3" placeholder="" />
                            </div>
                        </fieldset>

                    </div>

                    <div id="formPart3">

                    </div>
                    <?php
                        $res=(empty($fileEr))?'good':'bad';
                    ?>
                    <div id="formPart4" class="<?php echo $res;if(isset($_POST['submit']))echo ' show'?>">
                        <?php if(!empty($error['initiator'])){echo $error['initiator'];}else{?>

                        <div class="form-end-message">
                        Yippee! <br><br>The startup you added submitted for approval and will be uploaded in a few minutes.
                        You're more than welcome to share the competition with your friends! <br>
                            <div class="planes"></div>
                            <div class="form-end-social">
                                <a href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]=<?php echo site_url(); ?>&p[images][0]=<?php echo get_theme_mod('link_ImgBg');?>&p[title]=Global EdTech Startup Awards 2015&p[summary]=What's your favorite EdTech startup?" class="social fb" title="(Share on Facebook)" target="_blank">Share on <span class="letter-space">Facbook</span></a>

                                <!--<a href="http://twitter.com/intent/tweet?text=What's your favorite EdTech startup? %0D%0AGlobal EdTech Startup Awards 2014. <?php echo site_url(); ?> &hashtags=Edtech,Startups,Education" class="social twitter" title="(Tweet This Link)" target="_blank">Share on <span class="letter-space">Twitter</span></a><?php echo site_url(); ?> &hashtags=Edtech,Startups,Education" class="social twitter" title="(Tweet This Link)" target="_blank">Share on <span class="letter-space">Twitter</span></a><?php echo site_url(); ?> &hashtags=Edtech,Startups,Education" class="social twitter" title="(Tweet This Link)" target="_blank">Share on <span class="letter-space">Twitter</span></a><?php echo site_url(); ?> &hashtags=Edtech,Startups,Education" class="social twitter" title="(Tweet This Link)" target="_blank">Share on <span class="letter-space">Twitter</span></a><?php echo site_url(); ?> &hashtags=Edtech,Startups,Education" class="social twitter" title="(Tweet This Link)" target="_blank">Share on <span class="letter-space">Twitter</span></a><?php echo site_url(); ?> &hashtags=Edtech,Startups,Education" class="social twitter" title="(Tweet This Link)" target="_blank">Share on <span class="letter-space">Twitter</span></a><?php echo site_url(); ?> &hashtags=Edtech,Startups,Education" class="social twitter" title="(Tweet This Link)" target="_blank">Share on <span class="letter-space">Twitter</span></a><?php echo site_url(); ?> &hashtags=Edtech,Startups,Education" class="social twitter" title="(Tweet This Link)" target="_blank">Share on <span class="letter-space">Twitter</span></a><?php echo site_url(); ?> &hashtags=Edtech,Startups,Education" class="social twitter" title="(Tweet This Link)" target="_blank">Share on <span class="letter-space">Twitter</span></a><?php echo site_url(); ?> &hashtags=Edtech,Startups,Education" class="social twitter" title="(Tweet This Link)" target="_blank">Share on <span class="letter-space">Twitter</span></a><?php echo site_url(); ?> &hashtags=Edtech,Startups,Education" class="social twitter" title="(Tweet This Link)" target="_blank">Share on <span class="letter-space">Twitter</span></a><?php echo site_url(); ?> &hashtags=Edtech,Startups,Education" class="social twitter" title="(Tweet This Link)" target="_blank">Share on <span class="letter-space">Twitter</span></a>-->
                                <span class="social twitter" onclick="openInNewWindow('http://twitter.com/intent/tweet?text=What\'s your favorite EdTech startup? %0D%0AGlobal EdTech Startup Awards 2015. <?php echo site_url(); ?> &hashtags=Edtech,Startups,Education' , 100, 100)">Share on <span class="letter-space">Twitter</span></span>

                                <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo site_url(); ?>&amp;title=Global EdTech Startup Awards 2015&summary=What's your favorite EdTech startup?" class="social linkedin" title="(Share on LinkedIn)" target="_blank">Share on <span class="letter-space">LinkedIn</span></a>


                            </div>
                        </div>


                        <?php }?>
                    </div>
                    <div class="capchArea">
                        <?php myCapch() ?>
                    </div>

                    <fieldset class="submit">
                        <input type="submit" value="Submit" tabindex="40" id="submit" name="submit" />
                    </fieldset>

                    <input type="hidden" name="action" value="new_post" />
                    <?php
                        wp_nonce_field( 'new-post' );
                                            }
                    ?>

                </form>
                <?php
                    
                    if(1 == get_theme_mod('competition_status_check_box')){
                ?>
                <div id="nav-area">
                    <span id="page-number-1" class="page-number">1/4</span>
                    <span id="page-number-1-2" class="page-number">2/4</span>
                    <span id="page-number-2" class="page-number">3/4</span>
                    <span id="page-number-3" class="page-number">4/4</span>
                    <div class="last-page"><div class="nav-page-img">Back</div></div>
                    <div class="next-page"><div class="nav-page-img">Next</div></div>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>

        <!-- end form -->
    </section>
    <?php endwhile; ?>
    <?php else : ?>
    <h2>Not Found</h2>
    <?php endif; ?>



</div>
<?php
    
    
?>

<?php
    
    //."  ".get_option('')."  ".get_option('')."  ".get_option('');
    switch (get_option('first_order')) {
        case 'value1':
            include(locate_template('areasTemplates/startups.php'));
            break;
        case 'value2':
            include(locate_template('areasTemplates/map.php'));
            break;
        case 'value3':
            include(locate_template('areasTemplates/judges.php'));
            break;
            case 'value4':
            include(locate_template('areasTemplates/description.php'));
            break;
    }
    
     switch (get_option('second_order')) {
        case 'value1':
            include(locate_template('areasTemplates/startups.php'));
            break;
        case 'value2':
            include(locate_template('areasTemplates/map.php'));
            break;
        case 'value3':
            include(locate_template('areasTemplates/judges.php'));
            break;
            case 'value4':
            include(locate_template('areasTemplates/description.php'));
            break;
    }
    
     switch (get_option('third_order')) {
        case 'value1':
            include(locate_template('areasTemplates/startups.php'));
            break;
        case 'value2':
            include(locate_template('areasTemplates/map.php'));
            break;
        case 'value3':
            include(locate_template('areasTemplates/judges.php'));
            break;
            case 'value4':
            include(locate_template('areasTemplates/description.php'));
            break;
    }
    
     switch (get_option('fourth_order')) {
        case 'value1':
            include(locate_template('areasTemplates/startups.php'));
            break;
        case 'value2':
            include(locate_template('areasTemplates/map.php'));
            break;
        case 'value3':
            include(locate_template('areasTemplates/judges.php'));
            break;
            case 'value4':
            include(locate_template('areasTemplates/description.php'));
            break;
    }
    
?>

<div id="urlHide">
    <?php $term=get_page_by_title('Competition terms and condition');echo $term->guid;?>
</div>
<script>
    $('#formPart3').on('click','#terms',function(){
        urlhide=$('#urlHide').text();
        $(this).attr('href',urlhide);
        return true;
    
    });
    
</script>
<!--<iframe src="http://localhost/Mindcet-startups-site/?page_id=639" style="width: 687px;height: 514px;"></iframe>-->
<!--<iframe src="http://mindcet.co.il.tigris.nethost.co.il/?page_id=639" style="width: 687px;height: 514px;"></iframe>-->
<?php get_footer(); ?>



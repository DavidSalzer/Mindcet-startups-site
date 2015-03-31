<?php
    /*
        Template Name: New Inventor Form
    */
    
    get_header('page');
?>

<div class="" id="post-<?php the_ID(); ?>">

    <h2><?php the_title(); ?></h2>

    <?php
        
        if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "addStartupForm"&& isset($_POST['submit'])) {
            //get the category
            if($_SESSION['capch']!='capch'){
                $error['initiator']= "<div class='form-end-message'>Oops!<br><br> Something got wrong, please try again</div><div class='planes'></div>";	
            //do_action('sendEmail_for_qa',"treut@cambium.co.il","test2","error captcha");
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
                        //if(isset($_POST['ads']) && $_POST['ads']=='yes')
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

    <div class="entry">

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

        <form class="popInvent" id="addStartupForm" method="post" action="" name="addStartupForm" enctype="multipart/form-data">
            <div id="formPart1">
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
                        foreach($categories as $category) {
                    ?>
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

                <fieldset class="categories-input">
                    <div class="categories">Check here if you want to participate in the special tracks of the competition</div>
                    <label for="making-education"><input type="checkbox" id="making-education" name="making-education" value="17"><span></span>Making Education<br></label>
                    <label for="iot-in-education"><input type="checkbox" id="iot-in-education" name="iot-in-education" value="19"><span></span>IoT in Education<br></label>
                    <label for="safety-net"> <input type="checkbox" id="safety-net" name="safety-net" value="20"><span></span>Safety Net<br></label>
                </fieldset>



                <textarea id="description" tabindex="20" name="description" cols="30" rows="1" placeholder="About the startup"></textarea>*
                <input type="url" id="site" value="" tabindex="21" name="site" placeholder="Link to website" />*
                <fieldset class="formfield">
                    <input type="url" id="youtubeUrl" value="" tabindex="22" name="youtubeUrl" placeholder="Link to video (YouTube/Vimeo)" />
                </fieldset>

                <fieldset class="formfield input-border">
                    <span class="title-logo logoimg">Logo</span>
                    <div class="upload" onclick="getFile('#logo')">Select file</div>
                    <div class="input-outer">
                        <input type="file" id="logo" value="Upload" name="logo" tabindex="23" name="logo" placeholder="" />
                    </div>
                </fieldset>
                <fieldset class="formfield input-border">
                    <span class="title-logo img1">Add a photo</span>
                    <div class="upload" onclick="getFile('#img-1')">Select file</div>
                    <div class="input-outer">
                        <input type="file" id="img-1" value="" tabindex="24" name="img-1" placeholder="" />
                    </div>
                </fieldset>
                <fieldset class="formfield input-border">
                    <span class="title-logo img2">Add a photo</span>
                    <div class="upload" onclick="getFile('#img-2')">Select file</div>
                    <div class="input-outer">
                        <input type="file" id="img-2" value="" tabindex="25" name="img-2" placeholder="" />
                    </div>
                </fieldset>

                <fieldset class="formfield input-border">
                    <span class="title-logo img3">Add a photo</span>
                    <div class="upload" onclick="getFile('#img-3')">Select file</div>
                    <div class="input-outer">
                        <input type="file" id="img-3" value="" tabindex="26" name="img-3" placeholder="" />
                    </div>
                </fieldset>


                <div class="capchArea">
                    <?php myCapch() ?>
                </div>

                <div class="bottomArea">
                    <label for="ads">
                        <input type="checkbox" id="ads" name="ads" value="yes" checked>
                        <span></span>I wish to receive interesting information about new EdTech startups.<br><br>
                    </label>
                    <label for="terms">
                        <input type="checkbox" id="terms" name="terms" checked>
                        <span></span> I accept the <a href="#" id="terms" target="_blank">terms</a> of the Global EdTech Startups Awards.<br>
                    </label>
                    <fieldset class="submit">
                        <input type="submit" value="Submit" tabindex="40" id="submit" name="submit" />
                    </fieldset>

                    <input type="hidden" name="action" value="addStartupForm" />
                </div>
            </div>

            <?php
                $res=(empty($fileEr))?'good':'bad';
            ?>
            

        </form>

        <div id="formPart4" class="<?php echo $res;if(isset($_POST['submit']))echo ' show'?>">
                <?php if(!empty($error['initiator'])){echo $error['initiator'];}else{?>

                <div class="form-end-message">
                        Yippee! <br><br>The startup you added submitted for approval and will be uploaded in a few minutes.
                        You're more than welcome to share the competition with your friends! <br>
                    <div class="planes"></div>
                    <div class="form-end-social">
                        <a href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]=<?php echo site_url(); ?>&p[images][0]=<?php echo get_theme_mod('link_ImgBg');?>&p[title]=Global EdTech Startup Awards 2015&p[summary]=What's your favorite EdTech startup?" class="social fb" title="(Share on Facebook)" target="_blank">Share on <span class="letter-space">Facbook</span></a>

                      
                        <span class="social twitter" onclick="openInNewWindow('http://twitter.com/intent/tweet?text=What\'s your favorite EdTech startup? %0D%0AGlobal EdTech Startup Awards 2015. <?php echo site_url(); ?> &hashtags=Edtech,Startups,Education' , 100, 100)">Share on <span class="letter-space">Twitter</span></span>

                        <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo site_url(); ?>&amp;title=Global EdTech Startup Awards 2015&summary=What's your favorite EdTech startup?" class="social linkedin" title="(Share on LinkedIn)" target="_blank">Share on <span class="letter-space">LinkedIn</span></a>


                    </div>
                </div>


                <?php }?>
            </div>

    </div>
</div>

    </div>
</div>
<?php get_footer('page'); ?>
		
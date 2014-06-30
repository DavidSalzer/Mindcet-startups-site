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

        <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" data-size="small" data-count="horizontal" data-url="<?php echo site_url(); ?>" data-text="What's your favorite EdTech startup? Global EdTech Startup Awards 2014. &#35;Edtech #Startups #Education">Tweet</a>

        <div class="entry">
            <div class="entry-design">
                <a href="<?php echo $pageUrl->guid;?>" id="offerStartUp">Add a Startup</a>

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
            
                 if($_SESSION['capch']!='capch'){
                             $error['initiator']= "<div class='form-end-message'>Oops!<br><br> Something got wrong, please try again</div><div class='planes'></div>";	
            
                }
            
            
                   if($_POST['category']!='none'){$selectCat=$_POST['category'];}
            
                  if($_POST['tags']!='none'){$tag=$_POST['tags'];}
            
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
                if( $my_post=get_page_by_title( $title, 'OBJECT', 'initiator' )){
                     $error['initiator']= "<div class='form-end-message'>Oops!<br><br> Something got wrong, please try again</div><div class='planes'></div>";	
                }else{
                    if(empty($error['initiator'])){
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
                        'post_category' => array($selectCat),
                        'tags_input'=>array($tag)
                        );
            
                        //SAVE THE POST
                        $pid = wp_insert_post($new_post);
            
                       //SET OUR CASTUOM FIELDS
            
                        update_post_meta($pid, 'wpcf-full_name', $name);
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
            
                        do_action('post_mindeset_uplode');
            
                        //REDIRECT TO THE NEW POST ON SAVE
                    //	$link = get_permalink( $pid );
                    }//if empty eprrr
                }//if post is not there...
            
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
                        <!-- post Category -->
                        <input type="text" id="invetName" value="" tabindex="10" name="invetName" placeholder="Your name" />*
                        <!-- post Category -->
                        <fieldset class="formfield">
                            <input type="email" id="email" value="" tabindex="11" name="email" placeholder="Your E-Mail" /> *
                        </fieldset>

                        <!-- post name -->
                        <input type="text" id="title" value="" tabindex="12" name="title" placeholder="StartUp name" /> *
                        <!-- post Category -->
                        <input type="text" id="founder" value="" tabindex="13" name="founder" placeholder="Founder" />

                        <!-- post Category -->
                        <input type="email" id="founderMail" value="" tabindex="14" name="founderMail" placeholder="Founder E-Mail" />

                        <!-- post slogen -->
                        <input type="text" id="slogen" value="" tabindex="15" name="slogen" placeholder="Startup mission up to 140 characters" />*
                        <fieldset class="categories-input">
                            <div class="categories">Startup's categories <span class="astro">*</span>
                                <div id="validate-select-error" class="validate-error">* Please select at least one
                                </div>
                                <br>
                            </div>
                            <?php
                                
                                $args = array(
                                  'orderby' => 'name',
                                  'order' => 'ASC',
                                  'hide_empty'=>0
                                  );
                                $categories = get_categories($args);
                            ?>
                            <select name="category" id="category">

                                <option value="none">Select Sector</option>
                                <?php  foreach($categories as $category) { ?>
                                <option value="<?php echo $category->term_id;?>"><?php echo $category->name ;?></option>
                                <?php } ?>
                            </select>

                            <select name="tags" id="tags">
                                <option value="none">Select product category</option>
                                <?php
                                    
                                    $arg=array('hide_empty'=>false,'orderby'=>'name','order' => 'ASC');
                                    $tags = get_tags($arg);
                                    foreach ( $tags as $tag ) {
                                        $tag_link = get_tag_link( $tag->term_id );
                                ?>
                                <?php
                                    
                                        $nameTag=$tag->name;
                                    if(strtolower($nameTag)=='other'){ 
                                        $last= '<option value="'.$tag->name.'">'.$tag->name.'</option>';
                                        }else{
                                ?>
                                <option value="<?php echo $tag->name;?>"><?php echo $tag->name ;?></option>
                                <?php }?>
                                <?php
                                    }
                                                                   echo $last;
                                ?>

                            </select>


                            <?php
                                /*?><label class="styleCheckbox"></label>					
                                                               <input type="checkbox" id="<?php echo $category->slug;?>" name="<?php echo $category->slug;?>" value="<?php echo $category->term_id;?>">
                                                               <span></span><?php echo $category->name ;?>
                                                           </label><?php */?>
                                
                                
                                                 </fieldset>            
                                               </div>
                                
                                               <div id="formPart2">    
                                
                                
                                                   <!-- post Category -->
                                
                                                   <!-- post Content -->
                                                   <!--<fieldset class="formfield">-->
                                                  <textarea id="description" tabindex="20" name="description" cols="30" rows="1" placeholder="About the startup"></textarea>*
                                                   <!--</fieldset>-->
                                
                                                   <!-- post Category -->
                                                   <!--<fieldset class="formfield">-->
                                                       <input type="url" id="site" value="" tabindex="21" name="site" placeholder="Link to website"/>*
                                                   <!--</fieldset>-->
                                
                                                   <!-- post Category -->
                                                   <fieldset class="formfield">
                                                       <input type="url" id="youtubeUrl" value="" tabindex="22" name="youtubeUrl" placeholder="Link to video (YouTube/Vimeo)"/>
                                                   </fieldset>
                                
                                                   <fieldset class="formfield input-border">
                                                       <span class="title-logo logoimg">Logo</span>
                                                       <div class="upload" onclick="getFile('#logo')">Select file</div>
                                                       <div class="input-outer">
                                                           <input type="file" id="logo" value="Upload" name="logo" tabindex="23" name="logo" placeholder="" onchange="sub(this)"/>
                                                       </div>
                                                   </fieldset>
                                
                                                   <!-- post Category -->
                                
                                                   <fieldset class="formfield input-border">
                                                       <span class="title-logo img1">Add a photo</span>
                                                       <div class="upload" onclick="getFile('#img-1')">Select file</div>
                                                       <div class="input-outer">
                                                           <input type="file" id="img-1" value="" tabindex="24" name="img-1" placeholder="" onchange="sub(this)" />
                                                       </div>
                                                   </fieldset>
                                
                                                   <!-- post Category -->
                                
                                                   <fieldset class="formfield input-border">
                                                       <span class="title-logo img2">Add a photo</span>
                                                       <div class="upload" onclick="getFile('#img-2')">Select file</div>
                                                       <div class="input-outer">
                                                           <input type="file" id="img-2" value="" tabindex="25" name="img-2" placeholder="" onchange="sub(this)"/>
                                                       </div>
                                                   </fieldset>
                                
                                                   <!-- post Category -->
                                
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
                                               <?php  $res=(empty($fileEr))?'good':'bad';
                            ?>
                            <div id="formPart4" class="<?php echo $res;if(isset($_POST['submit']))echo ' show'?>">
                                <?php if(!empty($error['initiator'])){echo $error['initiator'];}else{?>

                                <div class="form-end-message">
                        Yippee! <br><br>The startup you added submitted for approval and will be uploaded in a few minutes.
                        You're more than welcome to share the competition with your friends! <br>
                                    <div class="planes"></div>
                                    <div id="form-end-social">
                                        <a href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]=<?php echo site_url();?>&p[images][0]=&p[title]=&p[summary]" class="social fb" title="(Share on Facebook)" target="_blank">Share on <span class="letter-space">Facbook</span></a>

                                        <a href="http://twitter.com/intent/tweet?text=<?php echo site_url();?>" class="social twitter" title="(Tweet This Link)" target="_blank">Share on <span class="letter-space">Twitter</span></a>

                                        <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo site_url();?>" class="social linkedin" title="(Share on LinkedIn)" target="_blank">Share on <span class="letter-space">LinkedIn</span></a>

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
                            <?php wp_nonce_field( 'new-post' ); ?>

                </form>
                <div id="nav-area">
                    <span id="page-number-1" class="page-number">1/3</span>
                    <span id="page-number-2" class="page-number">2/3</span>
                    <span id="page-number-3" class="page-number">3/3</span>
                    <div class="last-page"><div class="nav-page-img">Back</div></div>
                    <div class="next-page"><div class="nav-page-img">Next</div></div>
                </div>
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
  $currentyear= get_defauly_year();
    $yearArray= array();
    
    foreach(posts_by_year() as $year => $posts) :
        array_push($yearArray, $year);
    endforeach;
?>

<div id="startups-banner" class="middelBanner">
    <h2>The Startups
        <select name="year" id="yearNav">
            <option value="none">Select Year</option>
            <?php foreach(posts_by_year() as $year => $yearArray) :?>
            <option <?php if ($year == $currentyear ) echo 'selected'; ?> value="<?php echo $year; ?>"><?php echo $year; ?></option>
            <?php endforeach; ?>
        </select>
    </h2>
</div>

<?php //if ( has_nav_menu( 'startupMenu') ):?>

<nav class="inventorNav">

    <select name="category" id="categoryNav">

        <option value="none"> Select Sector</option>
        <?php  foreach($categories as $category) { ?>
        <option value="<?php echo $category->term_id;?>"><?php echo $category->name ;?></option>
        <?php } ?>
    </select>

    <select name="tags" id="tagsNav">
        <option value="none">Select product category</option>
        <?php
            
            $arg=array('hide_empty'=>false,'orderby'=>'name','order' => 'ASC');
            $tags = get_tags($arg);
            foreach ( $tags as $tag ) {
                $tag_link = get_tag_link( $tag->term_id );
        ?>
        <?php
            
                $nameTag=$tag->name;
            if(strtolower($nameTag)=='other'){ 
                $last= '<option value="'.$tag->name.'">'.$tag->name.'</option>';
                }else{
        ?>
        <option value="<?php echo $tag->name;?>"><?php echo $tag->name ;?></option>
        <?php }?>

        <?php
            } 
                               echo $last;
        ?>
    </select>

</nav>
<?php //endif;?>
<div class="page-wrap inventors">
    <div class="rightScroll" id="inventScrollR"><div class="rightScroll-arrow"></div></div>
    <div class="leftScroll" id="inventScrollL"><div class="leftScroll-arrow"></div></div>
    <?php
        
       
            $args = array(
            'posts_per_page'   => -1,
            'orderby'          => 'post_date',
            'order'            => 'DESC',
            'post_type'        => 'initiator',
            'year'             => $currentyear,
            'post_status'      => 'publish'
            );
        
        $myposts = get_posts( $args );
            $caunter=0;
          echo "<div id='scrollInventorCon'><span class='placholderSlide'></span><ul class='inventList'>";
            foreach ( $myposts as $post ) : setup_postdata( $post );
    ?>
    <?php
        if($caunter==3){
                        echo "</ul><ul class='inventList'>";
                    }else{
                    }
    ?>
    <li idtec="<?php echo $post->ID;?>">
        <div class="winner"></div>
        <div class="finalList"></div>
        <div class="img-wrap">
            <?php echo get_the_post_thumbnail( $post->ID,array(220,155), $attr ); ?>
        </div>
        <h2> <a href="<?php the_permalink(); ?>" idtech="<?php echo $post->ID;?>">
                <?php the_title(); ?>
            </a> </h2>
    </li>
    <?php
        if($caunter==3){
                    $caunter=0;
                   }
    ?>
    <?php
        $caunter++; endforeach; 
               wp_reset_postdata();
    ?>
    <?php
        {
                echo "</ul><span class='placholderSlide'></span></div>";
                }
    ?>

</div>
<div id="map-banner" class="middelBanner">
    <h2>EdTech Mapping</h2>
</div>

<!--marker popup-->
<div class="page-wrap mapping">
    <div class="google-map">
        <div id="map"></div>

    </div>
    <div class="best-invent">
        <div id="best-invent-title">
            <?php echo get_theme_mod('fev_h1');?>
        </div>

        <div id="best-invent-logo">
            <div id="best-logo-frame">
                <img class="best-logo" src="<?php echo get_theme_mod('fev_img');?>" alt="TextmyBrain logo">
            </div>
        </div>
        <div id="best-invent-description">
            <?php echo get_theme_mod('fev_text');?>
        </div>
    </div>
</div>
<div class="middelBanner">
    <h2> The Judges</h2>
</div>
<div class="page-wrap judges">
    <div id="judgeDescription-bg">
        <div class="judgeDescription">
            <span class="close"></span>


        </div>
    </div>

    <div class="rightScroll" id="judgesR"><div class="rightScroll-arrow"></div></div>
    <div class="leftScroll" id="judgesL"><div class="leftScroll-arrow"></div></div>
    <div class="judgesContenar" id="judgesCon">
        <span class="placholderSlide"></span>
        <?php
                $args = array(
                'posts_per_page'   => -1,
                'orderby'          => 'post_date',
                'order'            => 'DESC',
                'post_type'        => 'judges',
                'post_status'      => 'publish',
                );
            
            $myposts = get_posts( $args );
                $caunter=0;
                foreach ( $myposts as $post ) : setup_postdata( $post );
        ?>


        <div class="judgesAvantar" judgeid="<?php echo $post->ID;?>">
            <div class="judge-pic">
                <?php echo get_the_post_thumbnail( $post->ID,array(220,155), $attr ); ?>
            </div>
            <h2> <?php the_title(); ?></h2>
            <div class="judgestext">
                <?php  echo get_post_meta($post->ID,'wpcf-judges_role',true);?>
            </div>
        </div>

        <?php
            endforeach; 
                   wp_reset_postdata();
        ?>
        <!--<div class="judgesAvantar hide"> </div>-->
    </div>
</div>
<div id="judges-banner" class="middelBanner">
    <h2> The Competition</h2>
</div>

<div class="page-wrap contect">
    <article class="unreset">
        <?php the_content();?>
    </article>
</div>
<div id="urlHide">
    <?php $term=get_page_by_title('Competition terms and condition');echo $term->guid;?>
</div>
<script>
    allYearsTech=<?php echo getAllStartup(); ?>;
    allTech=allYearsTech[<?php echo $currentyear?>];
    console.log(allYearsTech);
    console.log("***********************************");
    console.log(allTech);
    allTechArray=Object.keys(allTech);
    allJudges=<?php echo getAllJudges(); ?>;
    allVotes=<?php echo getAllVotes(); ?>;
    popupall(allTech);
    popupallJ(allJudges);
    popupallV(allVotes);
    
    $('#formPart3').on('click','#terms',function(){
        urlhide=$('#urlHide').text();
        $(this).attr('href',urlhide);
        return true;
    
    });
</script>
<!--<iframe src="http://localhost/Mindcet-startups-site/?page_id=639" style="width: 687px;height: 514px;"></iframe>-->
<!--<iframe src="http://mindcet.co.il.tigris.nethost.co.il/?page_id=639" style="width: 687px;height: 514px;"></iframe>-->

<?php get_footer(); ?>



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


<div class="page-wrap">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
  <section  class="home">
    <div class="entry">
        <div class="entry-design">
            <p class="entry-main-title">Changing</p>
            <p id="entry-main-title-2" class="entry-main-title">Education</p>
            <p id="entry-main-title-3" class="entry-main-title">Mindset</p>
            <p>The most promising EdTech startups 2013</p>
          <?php $homeContant=get_the_content(); ?>
          <?php $pageUrl = get_page_by_title( 'Offer a Startup' ); ?>
          <a href="<?php echo $pageUrl->guid;?>" id="offerStartUp">Offer a Startup</a> </div> </div>
      <!----form inventors--->
    <?php 
  if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "new_post"&& isset($_POST['submit'])) {
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
		 $error['initiator']= "initiator title is already exists";	
	}else{
		if(empty($error['initiator'])){
			$name=filter_input(INPUT_POST,'invetName',FILTER_SANITIZE_STRING);
			$founder=filter_input(INPUT_POST,'founder',FILTER_SANITIZE_STRING);
			$youtubeUrl=filter_input(INPUT_POST,'youtubeUrl',FILTER_SANITIZE_STRING);
			// ADD THE FORM INPUT TO $new_post ARRAY
			$new_post = array(
			'post_title'	=>	$title,
			'post_content'	=>	$description,
			'post_status'	=>	'pending',           // Choose: publish, preview, future, draft, etc.
			'post_type'	=>	'initiator'  //'post',page' or use a custom post type if you want to
			);
		
			//SAVE THE POST
			$pid = wp_insert_post($new_post);
		
		   //SET OUR CASTUOM FIELDS
			update_post_meta($pid, 'wpcf-full_name', $name);
			update_post_meta($pid, 'wpcf-email_up', $email);
			update_post_meta($pid, 'wpcf-site-url', $site);
			update_post_meta($pid, 'wpcf-founder', $founder);
			update_post_meta($pid, 'wpcf-founder-email', $founderMail);
		   
		   update_post_meta($pid, 'wpcf-youtube-url', $youtubeUrl);
			
		
		//uploadFile($pid);
			$fileEr=fileUp($pid);	
			
			//REDIRECT TO THE NEW POST ON SAVE
		//	$link = get_permalink( $pid );
		}//if empty eprrr
	}//if post is not there...
	
} // END THE IF STATEMENT THAT STARTED THE WHOLE FORM

//POST THE POST YO
do_action('wp_insert_post', 'wp_insert_post');
?>
    <div id="offer-zone" class="inventorPopUp">
    <span class="close">X</span>
    <span class="triangle"></span>
    <form id="new_post" name="new_post" class="popInvent" method="post" action="" class="wpcf7-form" enctype="multipart/form-data">
        
        <div id="formPart1">
            <!-- post name -->
            <!--<fieldset name="title">-->
                <input type="text" id="title" value="" tabindex="5" name="title" placeholder="StartUp Name" />
            <!--</fieldset>-->
    
            <!-- post Category -->
            <!--<fieldset class="formfield">-->
                <input type="text" id="invetName" value="" tabindex="10" name="invetName" placeholder="Your Name" />
            <!--</fieldset>-->
    
            <!-- post Category -->
            <fieldset class="formfield">
                <input type="email" id="email" value="" tabindex="15" name="email" placeholder="Your E-Mail"/>
            </fieldset>

            <!-- post Category -->
            
            <fieldset class="formfield input-border">
                <span class="title-logo logoimg">Logo</span>
                <div class="upload">
                    <input type="file" id="logo" value="Upload" name="logo" tabindex="25" name="logo" placeholder="" />Select file
                </div>
            </fieldset>

            <!-- post Content -->
            <!--<fieldset class="formfield">-->
           <textarea id="description" tabindex="35" name="description" cols="30" rows="1" placeholder="About You/Your Startup"></textarea>
            <!--</fieldset>-->
        </div>
        
        <div id="formPart2">    
            <!-- post Category -->
            <!--<fieldset class="formfield">-->
                <input type="text" id="founder" value="" tabindex="25" name="founder" placeholder="Founder" />
            <!--</fieldset>-->
        
             <!-- post Category -->
            <!--<fieldset class="formfield">-->
                <input type="email" id="founderMail" value="" tabindex="30" name="founderMail" placeholder="Founder E-Mail" />
            <!--</fieldset>-->

            <!-- post Category -->
            <!--<fieldset class="formfield">-->
                <input type="url" id="site" value="" tabindex="20" name="site" placeholder="Link to Site"/>
            <!--</fieldset>-->
        
            <!-- post Category -->
            <fieldset class="formfield">
                <input type="url" id="youtubeUrl" value="" tabindex="20" name="youtubeUrl" placeholder="Link to Video"/>
            </fieldset>
        
            <!-- post Category -->
            
            <fieldset class="formfield input-border">
                <span class="title-logo img1">Add Your Photo</span>
                <div class="upload">
                    <input type="file" id="img-1" value="" tabindex="25" name="img-1" placeholder="" />Select file
                </div>
            </fieldset>

            <!-- post Category -->
            
            <fieldset class="formfield input-border">
                <span class="title-logo img2">Add Your Photo</span>
                <div class="upload">
                    <input type="file" id="img-2" value="" tabindex="25" name="img-2" placeholder="" />Select file
                </div>
            </fieldset>

            <!-- post Category -->
            
            <fieldset class="formfield input-border">
                <span class="title-logo img3">Add Your Photo</span>
                <div class="upload">
                    <input type="file" id="img-3" value="" tabindex="25" name="img-3" placeholder="" />Select file
                </div>
            </fieldset>

        </div>
            
        <div id="formPart3">

        </div>
        <?php  $res=(empty($fileEr))?'good':'bad';?>
        <div id="formPart4" class="<?php echo $res;?>">
            	<?php if(!empty($error['initiator'])){echo $error['initiator'];}else{?>
        
            <div class="form-end-message">
                Yippee! The startup you added submitted for approval and will be uploaded in a few minutes.<br>
                You're more than welcome to share the competition with your friends! <br>
            </div>
        
        
        		<?php }?>	
        </div>
    
    
        <fieldset class="submit">
            <input type="submit" value="Sign" tabindex="40" id="submit" name="submit" />
        </fieldset>
    
        <input type="hidden" name="action" value="new_post" />
        <?php wp_nonce_field( 'new-post' ); ?>
    </form>
    <div id="validate-error">* please insert a valid text </div>
    <span id="page-number-1" class="page-number">1/3</span>
    <span id="page-number-2" class="page-number">2/3</span>
    <span id="page-number-3" class="page-number">3/3</span>
    <div class="last-page"><div class="nav-page-img">Back</div></div>
    <div class="next-page"><div class="nav-page-img">Next</div></div>
        <!--<div class="page-2-buttons"><div class="last-page"><div class="nav-page-img">Back</div></div></div>
    <div class="page-3-buttons"><div class="last-page"><div class="nav-page-img">Back</div></div></div>
    <div class="page-1-buttons"><div class="next-page"><div class="nav-page-img">Next</div></div></div>
    <div class="page-2-buttons"><div class="next-page"><div class="nav-page-img">Next</div></div></div>-->
    </div>
      
      <!-- end form -->
  </section>
  <?php endwhile; ?>
  <?php else : ?>
  <h2>Not Found</h2>
  <?php endif; ?>

    <div id="single-startup-zone"class="inventDescription">
        <span id="invent-close" class="close">x</span>
        <!--<div class="topArea">
            <div class="title ellipsis">Class Dojo</div>
            <div class="logo"></div>
        </div>
        <div class="socialArea">
            <div class="social fb"></div>
            <div class="social twitter"></div>
            <div class="social linkedin"></div>
            <div class="social likes"></div>
        </div>
        <div class="mainArea">
                <div class="movie"></div>
                <div class="names ellipsis">Israel Israeli</div>
                <div class="description">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis manitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis vidLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis manitatis per seacula quarta decima et quinta decima. Eorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis manitatis per seacula quarta decima et quinta decima. Eoodem modo typi, qui nunc nobis vid</div>
                <div class="gallery">
                    <div class="gallery-img"></div>
                    <div class="gallery-img"></div>
                    <div class="gallery-img"></div>
                </div>
                <div class="fb-comments"></div>
        </div>-->
    </div>

</div>
<div id="startups-banner" class="middelBanner">
  <h2>The Startups</h2>
</div>
<?php if ( has_nav_menu( 'startupMenu') ):?>

<nav class="inventorNav">
           <?php
		$defaults = array(
			'theme_location'  =>'startupMenu',
			'menu'            => 'startupMenu',
			'container'       => 'div',
			'container_class' => 'inventHome',
			'menu_class'      => 'menu',
			'echo'            => true,
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		);
		
		wp_nav_menu( $defaults );
		
		?>
           	
 </nav>
 <?php endif;?>
<div class="page-wrap inventors" >
    <div class="rightScroll" id="inventScrollR"><div class="rightScroll-arrow"></div></div>
    <div class="leftScroll" id="inventScrollL"><div class="leftScroll-arrow"></div></div>
    <?php
        $args = array(
        'posts_per_page'   => -1,
        'orderby'          => 'post_date',
        'order'            => 'DESC',
        'post_type'        => 'initiator',
        'post_status'      => 'publish',
        );
    
    $myposts = get_posts( $args );
        $caunter=0;
        echo "<div id='scrollInventorCon'><span class='placholderSlide'></span><ul class='inventList'>";
        foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
    <?php	if($caunter==3){
                    echo "</ul><ul class='inventList'>";
                }else{
                }
        ?>
    <li  idTec="<?php echo $post->ID;?>"> <?php echo get_the_post_thumbnail( $post->ID,array(220,155), $attr ); ?>
      <h2> <a href="<?php the_permalink(); ?>" id="<?php echo $post->ID;?>">
        <?php the_title(); ?>
        </a> </h2>
    </li>
    <?php	if($caunter==3){
                $caunter=0;
               }?>
    <?php $caunter++; endforeach; 
        wp_reset_postdata();?>
    <?php	if($caunter!=3){
            echo "</ul><span class='placholderSlide'></span></div>";
            }
		?>
        
</div>
<div  class="middelBanner">
  <h2> The Judges</h2>
</div>
<div class="page-wrap judges">
	<div id="judgeDescription" class="judgeDescription">
        <span class="close">x</span>

        <!--<div class="judgeDescriptionLeft">
            <div class="judgeDescription-img"></div>
            <div class="contactMe"><a href="mailto:email@echoecho.com" >Contact Me</a></div>
        </div>
        <div class="judgeDescriptionRight">
            <div class="judgeDescription-name"> title - name</div>
            <div class="judgeDescription-role"> title - role</div>
            <div class="judgeDescription-full">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis manitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis vidLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis manitatis per seacula quarta decima et quinta decima. Eorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis manitatis per seacula quarta decima et quinta decima. Eoodem modo typi, qui nunc nobis vid</div>
        </div>-->
    </div>

    <div class="rightScroll" id="judgesR"><div class="rightScroll-arrow"></div></div>
    <div class="leftScroll" id="judgesL"><div class="leftScroll-arrow"></div></div>
<div class="judgesContenar" id="judgesCon">
	
    <div class="judgesAvantar hide"> </div>
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
        foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
	
		
    <div class="judgesAvantar" judgeId="<?php echo $post->ID;?>"> 
		<?php echo get_the_post_thumbnail( $post->ID,array(220,155), $attr ); ?>
      	<h2> <?php the_title(); ?></h2>
        <div class="judgestext">           
        	<?php  echo get_post_meta($post->ID,'wpcf-judges_role',true);?>
        </div>
    </div>
    
    <?php endforeach; 
        wp_reset_postdata();?>
	<div class="judgesAvantar hide"> </div>
</div>
</div>
<div id="judges-banner" class="middelBanner">
  <h2> The Competition</h2>
</div>
<div class="page-wrap contect">
	<article>
	<?php echo $homeContant ;?>
	</article>
</div>
<script>
     allTech=<?php echo getAllStartup(); ?>;
     allJudges=<?php echo getAllJudges(); ?>;
     popupall(allTech);
     popupallJ(allJudges);
    	 
</script>
<?php get_footer(); ?>



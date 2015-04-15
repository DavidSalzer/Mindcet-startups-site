<?php
/*
	Template Name: New Inventor Form
*/

if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "new_post") {
	
	// Do some minor form validation to make sure there is content
	if (isset ($_POST['title'])) {
		$title =  $_POST['title'];
	} else {
		echo 'Please enter the wine name';
	}
	if (isset ($_POST['description'])) {
		$description = $_POST['description'];
	} else {
		echo 'Please enter some notes';
	}
	
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	  $error= "E-mail is not valid";
	}else{
	  $email= $_POST['email'];
	}
	if(!filter_var($_POST['founderMail'], FILTER_VALIDATE_EMAIL)){
	 $error= "E-mail Founder is not valid";
	}else{
	  $founderMail= $_POST['founderMail'];
	}
	if(!filter_var($_POST['site'], FILTER_VALIDATE_URL)){
	   $error= "URL is not valid";
	}else{
	  $site=$_POST['site'];
	}
	
	if(empty($error)){
			$name=filter_input(INPUT_POST,'invetName',FILTER_SANITIZE_STRING);
			$founder=filter_input(INPUT_POST,'founder',FILTER_SANITIZE_STRING);
			
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
		   
			
			//REDIRECT TO THE NEW POST ON SAVE
			$link = get_permalink( $pid );
			wp_redirect( $link );
	}//if empty eprrr
} // END THE IF STATEMENT THAT STARTED THE WHOLE FORM

//POST THE POST YO
do_action('wp_insert_post', 'wp_insert_post');





get_header(); ?>
<div id="container">
            <div id="content" role="main">
	<?php if(!empty($error)) echo $error;?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php if ( is_front_page() ) { ?>
                        <h2 class="entry-title"><?php the_title(); ?></h2>
                    <?php } else { ?>
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    <?php } ?>

                    <div class="form-content">
                        <?php the_content(); ?>
                        <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
                        <?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
                        
                        <!-- WINE RATING FORM -->

<div class="wpcf7">
<form id="new_post" name="new_post" method="post" action="" class="wpcf7-form" enctype="multipart/form-data">
	<!-- post name -->
	<!--<fieldset name="title">-->
		<label for="title">כותרת מיזם:</label>
		<input type="text" id="title" value="" tabindex="5" name="title" />
	<!--</fieldset>-->

	<!-- post Category -->
	<!--<fieldset class="formfield">-->
		<label for="invetName">שם יזם:</label>
		<input type="text" id="invetName" value="" tabindex="10" name="invetName" />
	<!--</fieldset>-->

	<!-- post Category -->
	<!--<fieldset class="formfield">-->
		<label for="email">מייל יזם:</label>
		<input type="email" id="email" value="" tabindex="15" name="email" />
	<!--</fieldset>-->
    
    <!-- post Category -->
	<!--<fieldset class="formfield">-->
		<label for="site">Site URL:</label>
		<input type="url" id="site" value="" tabindex="20" name="site" />
	<!--</fieldset>-->
    
    <!-- post Category -->
	<!--<fieldset class="formfield">-->
		<label for="founder">founder:</label>
		<input type="text" id="founder" value="" tabindex="25" name="founder" />
	<!--</fieldset>-->
    
     <!-- post Category -->
	<!--<fieldset class="formfield">-->
		<label for="founderMail">founder mail:</label>
		<input type="email" id="founderMail" value="" tabindex="30" name="founderMail" />
	<!--</fieldset>-->

	<!-- post Content -->
	<!--<fieldset class="formfield">-->
		<label for="description">תיאור קצר</label>
		<textarea id="description" tabindex="35" name="description" cols="80" rows="10"></textarea>
	<!--</fieldset>-->



	<!--<fieldset class="submit">-->
		<input type="submit" value="Post Review" tabindex="40" id="submit" name="submit" />
	<!--</fieldset>-->

	<input type="hidden" name="action" value="new_post" />
	<?php wp_nonce_field( 'new-post' ); ?>
</form>
</div> <!-- END WPCF7 -->

                        
                        
                    </div><!-- .entry-content -->
                </div><!-- #post-## -->


<?php endwhile; // end of the loop. ?>

            </div><!-- #content -->
        </div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
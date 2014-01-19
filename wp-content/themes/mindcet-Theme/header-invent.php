<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php wp_head(); ?>
    
   <?php 
   	if(isset($_GET['postid'])){
			$post=get_post($_GET['postid']);
			$name=$post->post_name;
			$img= wp_get_attachment_image_src( get_post_thumbnail_id($post->ID, 'thumbnail'));
			$url=$post->guid;
	}
   
   ?>
   <meta property="og:title" content="Global EdTech Startup Awards 2014"/>
   <meta property="og:description" content="<?php echo $name;?> name is my favorite EdTech startup. What's yours?"/>
   <meta property="og:image" content="<?php echo $img[0];?>">
   <meta property="og:url" content="<?php echo $url;?>">
</head>

<body>
    
  
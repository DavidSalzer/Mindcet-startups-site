<?php get_header('invent'); ?>
	<?php if (have_posts()) { while (have_posts()) : the_post(); ?>
    <?php 
		 echo get_the_post_thumbnail($page->ID, 'thumbnail'); 
	
	?>

<?php
	 $urlgo=site_url().'?page_id=22/#'.$post->ID;
//	wp_redirect($urlgo);
?>
<?php endwhile;}else{
		 $urlgo=site_url();
//		wp_redirect($urlgo);
	}
 ?>
 
 <script>
 	window.location="<?php echo $urlgo; ?>";
 </script>
<?php wp_footer();?>
<?php get_header('invent'); ?>
	<?php if (have_posts()) { while (have_posts()) : the_post(); ?>

<?php
	 $urlgo=site_url().'/#'.$post->ID;
	wp_redirect($urlgo);
?>
<?php endwhile;}else{
		 $urlgo=site_url();
		wp_redirect($urlgo);
	}
 ?>
<?php get_footer();?>
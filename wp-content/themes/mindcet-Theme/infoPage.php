<?php
    /*
          Template Name: Info Page
      */
    
    
?>

<?php get_header('page'); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div id="newsletter-btn"></div>
<div class="post pageTemplet" id="post-<?php the_ID(); ?>">

    <h2 class="new-stat-title"><?php the_title(); ?></h2>

    <?php //include (TEMPLATEPATH . '/inc/meta.php' ); ?>

    <div class="entry info-entry">

       <?php the_content(); ?>

    </div>

    <?php //edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

</div>

<?php // comments_template(); ?>

<?php endwhile; endif; ?>

<?php //get_sidebar(); ?>

<?php get_footer(); ?>
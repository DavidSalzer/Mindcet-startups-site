<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
    <div class="middelBanner">
        <h2> Blog</h2>
    </div>
   
        <?php echo get_the_post_thumbnail( the_ID(),array(220,155), $attr ); ?>
   
    <h2><?php the_title(); ?></h2>

    <div class="meta">
        <em>Posted on:</em> <?php the_time('F jS, Y') ?>
        <em>by</em> <?php the_author() ?>
    </div>

    <div class="entry">

        <?php the_content(); ?>

    </div>
</div>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
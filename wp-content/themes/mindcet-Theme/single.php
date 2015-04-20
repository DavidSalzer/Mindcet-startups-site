<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
    <div class="middelBanner">
        <h2> Blog</h2>
    </div>
    <div class="page-wrap contect home-post-wrapper">

        <div class="post-img">
            <?php echo get_the_post_thumbnail( the_ID(),array(220,155), $attr ); ?>
        </div>
        <div class="home-title">

            <?php the_title(); ?>
        </div>
        <div class="home-date">
            <em>Posted on:</em> <?php the_time('F jS, Y') ?>
            <em>by</em> <?php the_author() ?>
        </div>

        <div class="home-content">

            <?php the_content(); ?>

        </div>
    </div>
    <?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>

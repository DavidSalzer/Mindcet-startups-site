<?php get_header(); ?>
<div class="middelBanner">
    <h2> Blog</h2>
</div>
<div class="page-wrap contect home-blog-wrapper">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <section class="home-blog">

        <div class="home-half home-half-left">

            <div class="home-title">
                <a href="<?php the_permalink() ?>">
                    <?php the_title(); ?>
                </a>
            </div>

            <div class="home-date">
                <em>Posted on:</em> <?php the_time('F jS, Y') ?>
                <em>by</em> <?php the_author() ?>
            </div>

              <div class="home-content-img-mobile">
                <?php echo get_the_post_thumbnail( the_ID(),array(220,155), $attr ); ?>
            </div>

            <div class="home-content">
                <?php the_content(); ?>
            </div>
        </div>
        <div class="home-half home-half-right">
            <div class="home-content-img">
                <?php echo get_the_post_thumbnail( the_ID(),array(220,155), $attr ); ?>
            </div>
        </div>
    </section>
    <?php endwhile; ?>
    <?php /*include (TEMPLATEPATH . '/inc/nav.php' );*/ ?>

    <?php else : ?>

    <h2>Not Found</h2>

    <?php endif; ?>
</div>
<?php/* get_sidebar();*/ ?>

<?php get_footer(); ?>
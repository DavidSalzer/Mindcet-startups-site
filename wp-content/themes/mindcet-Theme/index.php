<?php get_header(); ?>
    <div class="middelBanner">
        <h2> Blog</h2>
    </div>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<section class="home">

			<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>

			<div class="meta">
                <em>Posted on:</em> <?php the_time('F jS, Y') ?>
                <em>by</em> <?php the_author() ?>
            </div>

			<div class="entry">
				<?php the_content(); ?>
			</div>

			<?php echo get_the_post_thumbnail( the_ID(),array(220,155), $attr ); ?>

		</section>

	<?php endwhile; ?>

	<?php /*include (TEMPLATEPATH . '/inc/nav.php' );*/ ?>

	<?php else : ?>

		<h2>Not Found</h2>

	<?php endif; ?>

<?php/* get_sidebar();*/ ?>

<?php get_footer(); ?>
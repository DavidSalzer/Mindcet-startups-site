
<div id="random-startup-area">
    <div class="middelBanner">
        <h2> The Startup</h2>
    </div>
    <div class="page-wrap ">
    <?php 
        $args = array(
            'showposts'   => 1,
            'orderby'          => 'rand',
            'post_type'        => 'initiator',
            'year'             => $currentyear,
            'post_status'      => 'publish'
        );            
        $myposts = get_posts( $args );              
        foreach ( $myposts as $post ) : setup_postdata( $post );
        
    ?>
        <div><?php echo get_the_title($post->ID);?></div>
        <div><?php echo apply_filters ("the_content", $post->post_content);?></div>
        <div class="img-wrap">
            <?php echo get_the_post_thumbnail( $post->ID,array(220,155), $attr ); ?>
        </div>
        <?php   endforeach; ?>
    </div>
</div>
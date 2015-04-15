
<div id="random-startup-area">
    <div class="middelBanner">
        <h2> The Startup</h2>
    </div>
    <div class="page-wrap rand-page-wrap">
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
        <div class="img-wrap img-rand rand-box">
            <?php echo get_the_post_thumbnail( $post->ID,array(220,155), $attr ); ?>
        </div>
        <div class="rand-wrapper-content rand-box">
            <div class="rand-title"><?php echo get_the_title($post->ID);?></div>
            <div class="rand-content"><?php echo apply_filters ("the_content", $post->post_content);?></div>
        </div>
        
        <?php   endforeach; ?>
    </div>
</div>
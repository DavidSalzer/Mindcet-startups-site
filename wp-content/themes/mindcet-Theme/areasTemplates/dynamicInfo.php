
<div id="media-area">
    <div class="middelBanner">
        <h2> Media</h2>
    </div>
    <div class="page-wrap rand-page-wrap">
   <div>blog</div>
        <ul>
        <?php
            $args = array(
                'numberposts' => 3,
                'offset' => 0,
                'category' => 0,
                'orderby' => 'post_date',
                'order' => 'DESC',                
                'post_type' => 'post',
                'post_status' => 'publish'
            );

            $recent_posts = wp_get_recent_posts($args);
	        foreach ( $recent_posts as $post ){
         ?>
            <li>
                <a href="<?php echo get_permalink($post["ID"])?>" class="rand-title"><?php echo  $post["post_title"];?></a>
                <div class="rand-content"><?php echo apply_filters ("the_content", $post["post_content"]);?></div>
                <div class="img-wrap img-rand rand-box">
                    <?php echo get_the_post_thumbnail( $post["ID"],array(220,155), $attr ); ?>
                </div>
            </li>

        <?php }?>
        </ul>
        <a class="twitter-timeline" href="https://twitter.com/RCambium" data-widget-id="588629575057313793" width="300">Tweets by @RCambium</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>


        <!--<div class="img-wrap img-rand rand-box">
            <?php echo get_the_post_thumbnail( $post->ID,array(220,155), $attr ); ?>
        </div>
        <div class="rand-wrapper-content rand-box">
            <div class="rand-title"><?php echo get_the_title($post->ID);?></div>
            <div class="rand-content"><?php echo apply_filters ("the_content", $post->post_content);?></div>
        </div>-->
        
       
    </div>
</div>
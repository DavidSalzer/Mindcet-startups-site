
<div id="judges-area">
    <div class="middelBanner">
        <h2> The Judges</h2>
    </div>
    <div class="page-wrap judges">
        <div id="judgeDescription-bg">
            <div class="judgeDescription">
                <span class="close"></span>


            </div>
        </div>

        <div class="rightScroll" id="judgesR"><div class="rightScroll-arrow"></div></div>
        <div class="leftScroll" id="judgesL"><div class="leftScroll-arrow"></div></div>
        <div class="judgesContenar" id="judgesCon">
            <span class="placholderSlide"></span>
            <?php
                    $args = array(
                    'posts_per_page'   => -1,
                    'orderby'          => 'post_date',
                    'order'            => 'DESC',
                    'post_type'        => 'judges',
                    'post_status'      => 'publish',
                    );
                
                $myposts = get_posts( $args );
                    $caunter=0;
                    foreach ( $myposts as $post ) : setup_postdata( $post );
            ?>


            <div class="judgesAvantar" judgeid="<?php echo $post->ID;?>">
                <div class="judge-pic">
                    <?php echo get_the_post_thumbnail( $post->ID,array(220,155), $attr ); ?>
                </div>
                <h2> <?php the_title(); ?></h2>
                <div class="judgestext">
                    <?php  echo get_post_meta($post->ID,'wpcf-judges_role',true);?>
                </div>
            </div>

            <?php
                endforeach; 
                       wp_reset_postdata();
            ?>
            <!--<div class="judgesAvantar hide"> </div>-->
        </div>
    </div>
</div>
<script>
 allJudges=<?php echo getAllJudges(); ?>;
 //popupallJ(allJudges);
</script>
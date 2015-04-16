 <?php
    //get current year
    $currentyear= get_defauly_year();
    $yearTechArray= array();
    
    foreach(posts_by_year() as $year => $posts) :
        array_push($yearTechArray, $year);
    endforeach;
?>

<div id="startups-area">
    <div id="startups-banner" class="middelBanner">
        <h2>The Startups
            <select name="year" id="yearNav">
                <option value="none">Select Year</option>
                <?php foreach(posts_by_year() as $year => $yearTechArray) :?>
                <option <?php if ($year == $currentyear ) echo 'selected'; ?> value="<?php echo $year; ?>"><?php echo $year; ?></option>
                <?php endforeach; ?>
            </select>
        </h2>
    </div>

    <?php //if ( has_nav_menu( 'startupMenu') ):?>

    <nav class="inventorNav">

        <select name="category" id="categoryNav">

            <option value="none"> Select Sector</option>
            <?php
                
                $args = array('orderby' => 'name','order' => 'ASC','hide_empty'=>0);
                $categories = get_categories($args);
                
                foreach($categories as $category) {
            ?>
            <option value="<?php echo $category->term_id;?>"><?php echo $category->name ;?></option>
            <?php } ?>
        </select>

        <select name="tags" id="tagsNav">
            <option value="none">Select product category</option>
            <?php
                
                $arg=array('hide_empty'=>false,'orderby'=>'name','order' => 'ASC');
                $tags = get_tags($arg);
                foreach ( $tags as $tag ) {
                    $tag_link = get_tag_link( $tag->term_id );
            ?>
            <?php
                
                    $nameTag=$tag->name;
                if(strtolower($nameTag)=='other'){ 
                    $last= '<option value="'.$tag->name.'">'.$tag->name.'</option>';
                    }else{
            ?>
            <option value="<?php echo $tag->name;?>"><?php echo $tag->name ;?></option>
            <?php }?>

            <?php
                } 
                                   echo $last;
            ?>
        </select>

    </nav>
    <?php //endif;?>
    <div class="page-wrap inventors">
        <div class="rightScroll" id="inventScrollR"><div class="rightScroll-arrow"></div></div>
        <div class="leftScroll" id="inventScrollL"><div class="leftScroll-arrow"></div></div>
        <?php
                $args = array(
                    'posts_per_page'   => -1,
                    'orderby'          => 'post_date',
                    'order'            => 'DESC',
                    'post_type'        => 'initiator',
                    'year'             => $currentyear,
                    'post_status'      => 'publish'
                );
            
                $myposts = get_posts( $args );
                $caunter=0;
                echo "<div id='scrollInventorCon'><span class='placholderSlide'></span><ul class='inventList'>";
                foreach ( $myposts as $post ) : setup_postdata( $post );
        ?>
        <?php
            if($caunter==3){
                            echo "</ul><ul class='inventList'>";
                        }else{
                        }
        ?>
        <li idtec="<?php echo $post->ID;?>">
            <div class="winner"></div>
            <div class="finalList"></div>
            <div class="img-wrap">
                <?php echo get_the_post_thumbnail( $post->ID,array(220,155), $attr ); ?>
            </div>
            <h2> <a href="<?php the_permalink(); ?>" idtech="<?php echo $post->ID;?>">
                    <?php the_title(); ?>
                </a> </h2>
        </li>
        <?php
            if($caunter==3){
                        $caunter=0;
                       }
        ?>
        <?php
            $caunter++; endforeach; 
                   wp_reset_postdata();
        ?>
        <?php
            {
                    echo "</ul><span class='placholderSlide'></span></div>";
                    }
        ?>

    </div>
</div>
<script>
    
    result=<?php echo getAllStartup(); ?>;
    allYearsTech=result[0];
    allYearsTechByOrder=result[1];
    allTech=allYearsTech[<?php echo $currentyear?>];
    
    //for prev and next startups
    allTechArray=Object.keys(allTech);
    
    
</script>
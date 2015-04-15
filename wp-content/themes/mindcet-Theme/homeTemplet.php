<?php
    /*
        Template Name: Home Page
    */
        get_header(); 
?>
<?php
    
    //add_post_meta(165,'wpcf-user_img', 
    //	"http://localhost/mindset/wp-content/uploads/2013/12/free-images1-big.jpg"
    //);
?>
<?
    set_post_thumbnail( 165, 176177178179 );
    
    
?>


<div id="newsletter-btn"></div>


<div class="page-wrap">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <section class="home">
        <?php  echo get_the_post_thumbnail( $page->ID, 'full',array('class'=>'mainPageBg'));?>
        <!--<div class="fb-like" data-href="http://localhost/Mindcet-startups-site/" data-layout="standard" data-action="like" data-show-faces="false" data-share="false"></div>-->
        <div id="fb-like-site" class="fb-img">
            <div class="fb-like" data-href="<?php echo site_url(); ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false">
            </div>
        </div>

        <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" data-size="small" data-count="horizontal" data-url="<?php echo site_url(); ?>" data-text="What's your favorite EdTech startup? Global EdTech Startup Awards 2015. &#35;Edtech #Startups #Education">Tweet</a>

        <div class="entry">
            <div class="entry-design">
                <a href="/?page_id=3371" id="offerStartUp">Add a Startup</a>
            </div>
        </div>
    </section>
    <?php endwhile; ?>
    <?php else : ?>
    <h2>Not Found</h2>
    <?php endif; ?>



</div>
<?php
    
    
?>

<?php
    
    //."  ".get_option('')."  ".get_option('')."  ".get_option('');
    switch (get_option('first_order')) {
        //case 'value1':
        //    include(locate_template('areasTemplates/startups.php'));
        //    break;
        //case 'value2':
        //    include(locate_template('areasTemplates/map.php'));
        //    break;
        case 'value3':
            include(locate_template('areasTemplates/judges.php'));
            break;
            case 'value4':
            include(locate_template('areasTemplates/description.php'));
            break;
    }
    
     switch (get_option('second_order')) {
        //case 'value1':
        //    include(locate_template('areasTemplates/startups.php'));
        //    break;
        //case 'value2':
        //    include(locate_template('areasTemplates/map.php'));
        //    break;
        case 'value3':
            include(locate_template('areasTemplates/judges.php'));
            break;
            case 'value4':
            include(locate_template('areasTemplates/description.php'));
            break;
    }
    
     switch (get_option('third_order')) {
        //case 'value1':
        //    include(locate_template('areasTemplates/startups.php'));
        //    break;
        //case 'value2':
        //    include(locate_template('areasTemplates/map.php'));
        //    break;
        case 'value3':
            include(locate_template('areasTemplates/judges.php'));
            break;
            case 'value4':
            include(locate_template('areasTemplates/description.php'));
            break;
    }
    
     switch (get_option('fourth_order')) {
        //case 'value1':
        //    include(locate_template('areasTemplates/startups.php'));
        //    break;
        //case 'value2':
        //    include(locate_template('areasTemplates/map.php'));
        //    break;
        case 'value3':
            include(locate_template('areasTemplates/judges.php'));
            break;
            case 'value4':
            include(locate_template('areasTemplates/description.php'));
            break;
    }
    
?>

<div id="urlHide">
    <?php $term=get_page_by_title('Competition terms and condition');echo $term->guid;?>
</div>
<script>
    $('#formPart3').on('click','#terms',function(){
        urlhide=$('#urlHide').text();
        $(this).attr('href',urlhide);
        return true;
    
    });
    
</script>
<!--<iframe src="http://localhost/Mindcet-startups-site/?page_id=639" style="width: 687px;height: 514px;"></iframe>-->
<!--<iframe src="http://mindcet.co.il.tigris.nethost.co.il/?page_id=639" style="width: 687px;height: 514px;"></iframe>-->
<?php get_footer(); ?>



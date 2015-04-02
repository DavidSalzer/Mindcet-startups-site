
  <?php 
        //$homeContant=get_the_content(); 
        
        $competitionContent =get_post_custom();//get_post_meta( get_the_ID() );
        
        //get all custom field of home page 
         $about=$competitionContent['wpcf-about'][0];
         $whoCanApply=$competitionContent['wpcf-who-can-apply'][0];
         $tracks=$competitionContent['wpcf-tracks'][0];
         $theProccess=$competitionContent['wpcf-the-proccess'][0];
         $judges=$competitionContent['wpcf-judges'][0];
         $partners=$competitionContent['wpcf-partners'][0];
         $apply=$competitionContent['wpcf-apply'][0];

        ?>

<div id="description-area">
    <div id="judges-banner" class="middelBanner">
        <h2> The Competition</h2>
    </div>

    <div class="page-wrap contect">
        <article class="unreset">
             <?php the_content();?>
            <!--<?php echo $about?>
            <?php echo $whoCanApply?>
            <?php echo $tracks?>
            <?php echo $theProccess?>
            <?php echo $judges?>
            <?php echo $partners?>
            <?php echo $apply?>-->
        </article>
    </div>    
</div>

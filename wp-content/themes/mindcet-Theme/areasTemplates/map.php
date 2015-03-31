<div id="map-area" style="display: none;">
    <div id="map-banner" class="middelBanner">
        <h2>EdTech Mapping</h2>
    </div>

    <!--marker popup-->
    <div class="page-wrap mapping">
        <div class="google-map">
            <div id="map"></div>

        </div>
        <div class="best-invent">
            <div id="best-invent-title">
                <?php echo get_theme_mod('fev_h1');?>
            </div>

            <div id="best-invent-logo">
                <div id="best-logo-frame">
                    <img class="best-logo" src="<?php echo get_theme_mod('fev_img');?>" alt="TextmyBrain logo">
                </div>
            </div>
            <div id="best-invent-description">
                <?php echo get_theme_mod('fev_text');?>
            </div>
        </div>
    </div>
</div>

 <script>
    allVotes=<?php echo getAllVotes(); ?>;
   
   
    popupallV(allVotes);
    </script>

</div>
            <div id="footer">
            <div class="footerLogos"><p>Partners:</p>
            	    <?php
					$defaults = array(
						'theme_location'  =>'logoMenu',
						'menu'            => 'logoMenu',
						'container'       => 'div',
						'container_class' => 'logo_menu',
						'menu_class'      => 'menu',
						'echo'            => false,
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					);
					
					$menu =wp_nav_menu( $defaults );
					$menu = str_replace('<a',"<a target='_blank'",$menu);
					echo $menu;
					
					?>
            
                
            </div>
            <div class="footerLogos"><p>Sponsors:</p>
            	<?php
				$defaults = array(
					'theme_location'  =>'sponsersLogoMenu',
					'menu'            => 'sponsersLogoMenu',
					'container'       => 'div',
					'container_class' => 'logo_menu',
					'menu_class'      => 'menu',
					'echo'            => false,
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				);
					
				$menu =wp_nav_menu( $defaults );
				$menu = str_replace('<a',"<a target='_blank'",$menu);
				echo $menu;
					
				?>
            
                
            </div>
        	<nav class="footerNav">
                <div class="unitedNav">
                 
                
                
			   <?php
            $defaults = array(
                 'theme_location'  =>'footerMenu',
                'menu'            => 'footerMenu',
                'container'       => 'div',
                'container_class' => 'footerMenu',
                'menu_class'      => 'menufooter',
                'echo'            => true,
				
                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            );
            
            wp_nav_menu( $defaults );
            
            ?>
           	<!--<span class="copyr">&copy;<?php echo date("Y"); echo " "; bloginfo('name'); ?></span></div>-->
                    <div class="copyr">
                        <div id="all-rights-reserved-cambium">&copy;<?php echo "  " ;echo date("Y"); echo " MindCET."; ?></div>
                        <div>All rights reserved</div>
                    </div>
                    <a id="my-logo" href="http://www.cambium.co.il" class="devby"><p>developed by</p></a>
                </div>
           </nav>
        
        
			
		</div>



	<?php wp_footer(); ?>
	
	<!-- Don't forget analytics -->
   <section id="contactUsForm">
       <div id="contact-us-mobile-header" class="mobile-header">Contact Us</div>
                  <div class="loading">
                  	Sending...
                  </div>
                  <span class="close"></span>
                    
                    <form>
                        <input type="text" id="cfirst" name="cfirst" placeholder="First Name">
                        <input type="text" id="clast" name="clast" placeholder="Last Name">
                        <input type="email" id="cemail" name="cemail" placeholder="Your E-mail">
                        <textarea name="cmessage" id="cmessage" placeholder="Your Message"></textarea>
                        <input type="button" id="cbtm" value="Send">
                    
                    </form>
                    <span class="triangle"></span>
   </section>
   
  <div class="aboutUsMask"> 
   <section id="aboutUs">
   	      <?php $about=get_page_by_title('about us');?>	
    <span class="close"></span>
            <div class="logo">
                  <?php echo get_the_post_thumbnail($about->ID,'thumbnail', array('class' => 'aboutLogo')  ); ?>
            </div>     
                  <h1><?php echo $about->post_title;?></h1>
				  <div class="media">
                		<?php $field = get_field('about_us_video', $about->ID,true);
							  echo $field;
						 ?>  
                  </div>
                <article>
                  	<?php echo $about->post_content;?>
                  </article>  
                  <div class="gallery">
                  		<?php 
							if($field = get_field('img1', $about->ID)){?>
                        	<img src="<?php echo $field;?>">
						<?php }?>
                        <?php if($field = get_field('img2', $about->ID)){?>
                        	<img src="<?php echo $field;?>">
						<?php }?>
                        <?php if($field = get_field('img3', $about->ID)){?>
                        	<img src="<?php echo $field;?>">
						<?php }?>
                  </div>    
              
 		  </section>
  <div>	
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47170376-1', 'globaledtechawards.org');
  ga('send', 'pageview');

  

</script>	
</body>

</html>

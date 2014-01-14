            <div id="footer">
            <div class="footerLogos">
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
            
            
                <?php /*?><a href="http://www3.cet.ac.il/" target="_blank" class="">
                	<span class="logoMatach"></span>
                </a>
                <!--<a href="<?php echo site_url();?>" target="_blank" class="mindcet">-->
                <a href="http://www.mindcet.org/" target="_blank" class="mindcet">
                
                	<span class="logoMindcet"></span>
                </a>
                <a href="https://angel.co/socraticlabs" class="" target="_blank">
                	<span class="logoCet"></span>
                </a>
                <a href="http://paueducation.com/en/content/pierre-antoine-ullmo" target="_blank" class="">
                	<span class="logoPau"></span>
                </a>
                <a href="http://www.edtechincubator.com/" target="_blank" class="">
                	<span class="logoEdTech"></span>
                </a<?php */?>
                
            </div>
        	<nav class="footerNav">
                <div class="unitedNav">
                  <section id="contactUsForm">
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
                        <div>&copy;<?php echo "  " ;echo date("Y"); echo " MindCET."; ?></div>
                        <div>All rights reserved</div>
                    </div>
                    <a href="http://www.cambium.co.il" class="devby">developed by </a>
                </div>
           </nav>
        
        
			
		</div>

	</div>

	<?php wp_footer(); ?>
	
	<!-- Don't forget analytics -->
  
	
</body>

</html>

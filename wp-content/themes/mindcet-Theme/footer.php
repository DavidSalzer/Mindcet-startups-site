		<div id="footer">
            <div class="footerLogos">
                <a href="<?php echo site_url();?>" class="mindcet">
                	<span class="logoMindcet"></span>
                </a>
                <a href="" class="">
                	<span class="logoCet"></span>
                </a>
                <a href="" class="">
                	<span class="logoMatach"></span>
                </a>
            </div>
        	<nav class="footerNav">
                <div class="unitedNav">
			   <?php
            $defaults = array(
                'menu'            => 'footerMenu',
                'container'       => 'div',
                'container_class' => 'footerMenu',
                'menu_class'      => 'menufooter',
                'echo'            => true,
				
                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            );
            
            wp_nav_menu( $defaults );
            
            ?>
           	<span class="copyr">&copy;<?php echo date("Y"); echo " "; bloginfo('name'); ?></span></div>
           </nav>
        
        
			
		</div>

	</div>

	<?php wp_footer(); ?>
	
	<!-- Don't forget analytics -->
	
</body>

</html>

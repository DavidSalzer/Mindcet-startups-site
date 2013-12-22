<?php
//error_reporting(E_ALL);
/*Plugin Name: Mindcet setting
Plugin URI:cambium.co.il
Descriotion: home setting and more...
Author: yanai edri
Author URI:cambium.co.il
Version:1.0*/

class MindCet_Option{
	public $options;
	
	public function __construct(){
		$this->options=get_option('ye_plugin_options');
		$this->register_setting_and_fields();
	}

	public function add_menu_page(){
		add_options_page('Mindcet option','ניהול אתר MINDCET','administrator',__FILE__,array('MindCet_Option','mindcet'));
	}
	
	
	public function mindcet(){
		?>
		<div class="wrap">
			<?php screen_icon();?><h2>הגדרות אתר MINDCET</h2>
			<form method="post" action="options.php" enctype="multipart/form-data"> 
				<?php settings_fields('ye_plugin_options');?>
				<?php do_settings_sections(__FILE__);?>
				<p class="submit">
					<input type="submit" name="submit" class="botton-primary" value="שמור שינויים">
				</p>
			</form>
		</div>
	
	<?php
	}
	
	
	public function register_setting_and_fields(){
		register_setting('ye_plugin_options','ye_plugin_options');//3rd=optional bd
		//add_settings_section( $id, $title, $callback, $page );
		add_settings_section('ye_main_section','הגדרות MINDCET',array($this,'ye_main_section_cb'),__FILE__);
		// add_settings_field( $id, $title, $callback, $page, $section, $args );
		add_settings_field('ye_face','לינק פייסבוק :',array($this,'ye_down_pace'),__FILE__,'ye_main_section');
		add_settings_field('ye_linkin','לינק לינקין :',array($this,'ye_down_linkin'),__FILE__,'ye_main_section');
		add_settings_field('ye_twitter','לינק טוויטר :',array($this,'ye_down_twitter'),__FILE__,'ye_main_section');
		
	}
	
	
	public function ye_main_section_cb(){
	
	}
	//inputs----------------------------------------*/
	
	public function ye_down_pace(){
		echo "<input type='text' name='ye_plugin_options[ye_face]' value='".$this->options['ye_face']."'/>";	
		}
	
	public function ye_down_linkin(){
		echo "<input type='text' name='ye_plugin_options[ye_linkin]' value='".$this->options['ye_linkin']."'/>";	
		}
	
	public function ye_down_twitter(){
		echo "<input type='text' name='ye_plugin_options[ye_twitter]' value='".$this->options['ye_twitter']."'/>";	
		}

	
}

add_action('admin_menu',function(){
	MindCet_Option::add_menu_page();
});

add_action('admin_init',function(){
	new MindCet_Option();
});




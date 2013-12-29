<?php
//error_reporting(E_ALL);
/*Plugin Name: Mindcet setting
Plugin URI:cambium.co.il
Descriotion: home setting and more...
Author: yanai edri
Author URI:cambium.co.il
Version:1.0*/

//more extentions
require_once('email2post.php');

///
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
		add_settings_field('ye_tech','לינק ליד לוגו מינדסט :',array($this,'ye_down_tech'),__FILE__,'ye_main_section');
		
		add_settings_field('ye_voteDays','כמה ימים למנוע הצבעה נוספת :',array($this,'ye_vDays'),__FILE__,'ye_main_section');
		add_settings_field('ye_voteErorr','טקסט עבור הצבעה שנכשלה :',array($this,'ye_vError'),__FILE__,'ye_main_section');
		add_settings_field('ye_voteGood','טקסט עבור הצבעה שנוספה :',array($this,'ye_vGood'),__FILE__,'ye_main_section');
		
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
	
	public function ye_down_tech(){
			echo "<input type='text' name='ye_plugin_options[ye_tech]' value='".$this->options['ye_tech']."'/>";	
			}
	
	public function ye_vDays(){
			echo "<input type='number' name='ye_plugin_options[ye_voteDays]' value='".$this->options['ye_voteDays']."'/>";	
			}
	public function ye_vError(){
			echo "<input type='text' name='ye_plugin_options[ye_voteErorr]' value='".$this->options['ye_voteErorr']."'/>";	
			}		
	public function ye_vGood(){
			echo "<input type='text' name='ye_plugin_options[ye_voteGood]' value='".$this->options['ye_voteGood']."'/>";	
			}
}

add_action('admin_menu',function(){
	MindCet_Option::add_menu_page();
});

add_action('admin_init',function(){
	new MindCet_Option();
});




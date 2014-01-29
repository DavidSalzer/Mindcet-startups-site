<?php 
class Mind_Widget extends WP_Widget  {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'date_widget', // Base ID
			'dateCont', // Name
			array( 'description' => 'Date conter', ) // Args
		);
	}


	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		

		// outputs the content of the widget
		$title = apply_filters( 'widget_title', $instance['title'] );
		$time  = $instance['time'];
		$over  = $instance['over'];
		
		$day=$time;
		$day= strtotime($day);
	 	$today=date("Y-m-d");
		$today= strtotime($today);
		$remin=$day-$today;
		$numberDays = $remin/86400;
		
		echo $args['before_widget'];
		if ( $numberDays>=0 ){
			echo '<span class="daysRemind">'.$numberDays.'</span>';
			echo $args['before_title'] . $title . $args['after_title'];
			echo $args['after_widget'];
		}else{
			echo $args['before_title'] . $over. $args['after_title'];
			echo $args['after_widget'];
		}
	
	}

	/**
	 * Ouputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'טקסט להופעה', 'text_domain' );
		}
		if ( isset( $instance[ 'time' ] ) ) {
			$time = $instance[ 'time' ];
		}
		else {
			$time = __( 'New time', 'text_domain' );
		}
		if ( isset( $instance[ 'over' ] ) ) {
			$over = $instance[ 'over' ];
		}
		else {
			$over = __( 'טקסט להופעה כשהזמן נגמר', 'text_domain' );
		}
		?>
		<p>
       
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        <label for="<?php echo $this->get_field_id( 'over' ); ?>"><?php _e( 'כותרת ביעד:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'over' ); ?>" name="<?php echo $this->get_field_name( 'over' ); ?>" type="text" value="<?php echo esc_attr( $over ); ?>">
        <label for="<?php echo $this->get_field_id( 'time' ); ?>"><?php _e( 'תאריך:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'time' ); ?>" name="<?php echo $this->get_field_name( 'time' ); ?>" type="date" value="<?php echo esc_attr( $time ); ?>">
		</p>
		<?php 
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['over'] = ( ! empty( $new_instance['over'] ) ) ? strip_tags( $new_instance['over'] ) : '';
		$instance['time'] = ( ! empty( $new_instance['time'] ) ) ? strip_tags( $new_instance['time'] ) : '';
		
		return $instance;
	}
}


add_action( 'widgets_init', function(){
     register_widget( 'Mind_Widget' );
});
?>
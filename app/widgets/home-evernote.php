<?php 

/**
 * Adds Foo_Widget widget.
 */
class Palette_Home_Evernote_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'palette_home_evernote_widget',
			__('Palette Home Evernote', 'palette'),
			array( 'description' => __('Recent notes', 'palette')
			));
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$count = ( ! empty( $instance['count'] ) ) ? absint( $instance['count'] ) : 5;
		$evernoteSvg = '<svg width="16px" height="16px" viewBox="63 -31 34 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    		<!-- Generator: Sketch 3.8.3 (29802) - http://www.bohemiancoding.com/sketch -->
    		<desc>Created with Sketch.</desc>
    		<defs></defs>
    		<g id="Evernote-logo" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" transform="translate(63.000000, -31.000000)">
        	<path d="M3.4,8.7 L7.2,8.7 C7.4,8.7 7.6,8.5 7.6,8.3 L7.6,4.2 C7.6,3.5 7.8,2.8 8,2.3 L8.1,2 L0.7,9.3 C0.9,9.2 1.1,9.1 1.1,9.1 C1.7,8.8 2.5,8.7 3.4,8.7 L3.4,8.7 Z M32.6,8 C32.3,6.4 31.4,5.7 30.5,5.4 C29.6,5.1 28.7,4.7 26.3,4.4 C24.4,4.2 22.4,4.1 21,4.1 C20.6,3 20,1.8 17.7,1.2 C16.1,0.8 13.2,0.9 12.3,1 C10.9,1.2 10.4,1.8 10,2.2 C9.6,2.6 9.3,3.7 9.3,4.4 L9.3,6.6 L9.3,8.3 C9.3,9.5 8.5,10.4 7.1,10.4 L3.7,10.4 C2.9,10.4 2.3,10.5 1.8,10.7 C1.4,11 1,11.4 0.8,11.7 C0.3,12.4 0.2,13.2 0.2,14.1 C0.2,14.1 0.2,14.8 0.4,16.1 C0.5,17.1 1.6,23.7 2.6,25.9 C3,26.8 3.3,27.1 4.1,27.5 C5.9,28.3 10,29.1 12,29.4 C13.9,29.6 15.2,30.2 15.9,28.7 C15.9,28.7 16,28.3 16.2,27.8 C16.8,25.9 16.9,24.2 16.9,23 C16.9,22.9 17.1,22.9 17.1,23 C17.1,23.9 16.9,26.9 19.2,27.7 C20.1,28 22,28.3 23.9,28.5 C25.6,28.7 26.9,29.4 26.9,33.8 C26.9,36.5 26.3,36.9 23.4,36.9 C21,36.9 20.1,37 20.1,35 C20.1,33.5 21.6,33.6 22.8,33.6 C23.3,33.6 22.9,33.2 22.9,32.3 C22.9,31.3 23.5,30.8 22.9,30.8 C19,30.7 16.7,30.8 16.7,35.7 C16.7,40.2 18.4,41 24,41 C28.4,41 29.9,40.9 31.7,35.3 C32.1,34.2 32.9,30.8 33.4,25.2 C33.8,21.5 33.1,10.7 32.6,8 L32.6,8 Z M25,19.9 C24.5,19.9 24.2,19.9 23.7,20 L23.5,20 C23.5,20 23.4,20 23.4,19.9 L23.4,19.8 C23.6,18.8 24.1,17.6 25.6,17.6 C27.2,17.7 27.6,19.1 27.6,20.2 L27.6,20.3 C27.6,20.4 27.5,20.4 27.5,20.4 C27.4,20.4 27.4,20.4 27.4,20.3 C26.7,20.1 25.9,20 25,19.9 L25,19.9 Z" id="Shape" fill="#666666"></path>
    		</g>
		</svg>';



		echo '<div class="palette-evernote">';
		$output = '';
		if ( ! empty( $instance['title'] ) ) {
			$output .= $args['before_title'];
			$output .= '<a href="#"><span class="evernote-icon">'.$evernoteSvg.'</span> <span class="evernote-title-text">';
			$output .= apply_filters( 'widget_title', $instance['title'] );
			$output .= '</span></a><span class="fullscreen-component"></span>';
			$output .= $args['after_title'];
			echo $output;
		}
		


		?>
		<ul class="evernote">
			<?php 

				echo '<section class="loading-anim clearfix">';
					echo '<img src="'.get_template_directory_uri().'/img/spinner.gif'.'" alt="Loading">';
				echo '</section>';
				//try{}
				wp_enqueue_script( 'evernote_ajax', get_template_directory_uri().'/js/widgets/evernoteAjax.js',[],false,true);

				wp_localize_script('evernote_ajax', 'EVERNOTE_AJAX_SETTINGS', array(
					'home_url' => home_url(),
					'count'=> $count,
					// 'time_ago' => array(
					// 	'just_now'=>__('just now', 'palette'),
					// 	'min_ago'=>__(' minutes ago', 'palette'),
					// 	'h_a_ago'=>__('half an hour ago', 'palette'),
					// 	'h_ago'=>__(' hours ago', 'palette'),
					// 	'yes'=>__('yesterday', 'palette'),
					// 	'days_ago'=>__(' days ago', 'palette'),
					// )
				));
			

			?>
		</ul>
		<?php



		
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'text_domain' );
		$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 5;
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( esc_attr( 'Title:' ) ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'count' ); ?> "><?php __('Number of comments to view', 'palette') ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="count" step="1" min="1" value="<?php echo $count; ?>" size="3" />
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['count'] = absint( $new_instance['count'] );
		return $instance;
	}

} // class Foo_Widget


 ?>

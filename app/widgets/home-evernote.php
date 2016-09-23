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
		echo '<div class="home-component">';
		echo '<div class="palette-home-evernote">';

        echo '<div class="component-identifier">No<span class="inner">4</span></div>';
		$output = '';
		if ( ! empty( $instance['title'] ) ) {
			$output .= $args['before_title'];
			$output .= '<a href="#"><span class="evernote-title-text">';
			$output .= apply_filters( 'widget_title', $instance['title'] );
			$output .= '</span></a><span class="fullscreen-component"></span>';
			$output .= $args['after_title'];
			echo $output;
		}
		


		?>
		<ul class="home-evernote">
			<?php 
					echo '<section class="loading-anim center clearfix">';
					echo '<img src="'.get_template_directory_uri().'/img/spinner.gif'.'" alt="Loading">';
				echo '</section>';
				//try{}
				wp_enqueue_script( 'evernote_ajax', get_template_directory_uri().'/js/widgets/evernoteAjax.js',[],false,true);

				wp_localize_script('evernote_ajax', 'EVERNOTE_AJAX_SETTINGS', array(
					'home_url' => home_url(),
					'count'=> $count,
				));
		

			?>
		</ul>
		<?php
		echo "</div>";


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

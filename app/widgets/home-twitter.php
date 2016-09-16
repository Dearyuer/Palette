<?php 

class Palette_Home_Twitter_Widget extends WP_Widget{
	function __construct(){
		parent::__construct(
			'palette_home_twitter_widget',
			__( 'Palette Home Twitter', 'palette'),
			array( 'description' => __('Recent tweets', 'palette'))
		);
	}

	public function widget( $args, $instance ){
		$output = "";
		$count = ( ! empty( $instance['count'] ) ) ? absint( $instance['count'] ) : 5;
		//http://codrips.com/wp-content/themes/palette/libs/tmhOAuth/tweets_json.php
		// echo get_template_directory_uri();
		// require get_template_directory().'/libs/tmhOAuth/tmhOAuth.php';
        echo $args['before_widget'];
        echo '<div class="component-identifier">No<span class="inner">3</span></div>';
		echo '<div class="palette-twitter content">';

		if ( ! empty( $instance['title'] ) ) {
			$output .= $args['before_title'];
            $output .= __('Twitter','palette');
			$output .= $args['after_title'];
			echo $output;
		}
		echo '<ul class="tweets">';
			echo '<li class="loading-anim clearfix">';
				echo '<img src="'.get_template_directory_uri().'/img/spinner.gif'.'" alt="Loading">';
			echo '</li>';


            /*
             *
             * Test Case
             *
             */

		echo '</ul>';
		echo '</div>';
        echo $args['after_widget'];
		wp_enqueue_script('home_twitter_ajax',get_template_directory_uri().'/js/widgets/home-twitterAjax.js',[],false,true);

		wp_localize_script('home_twitter_ajax', 'HOME_TWITTER_AJAX_SETTINGS', array(
			'home_url' => home_url(),
			'count'=> $count,
			'lan'=> strtolower(get_locale()),
			'time_ago' => array(
				'just_now'=>__('just now', 'palette'),
				'min_ago'=>__(' minutes ago', 'palette'),
				'h_a_ago'=>__('half an hour ago', 'palette'),
				'h_ago'=>__(' hours ago', 'palette'),
				'yes'=>__('yesterday', 'palette'),
				'days_ago'=>__(' days ago', 'palette'),
			)
		));
		?>
		<?php

		// $output = "";
		// echo $output;
	}
	public function form( $instance ){
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : "";
		$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 5;
	?>
	<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'count' ); ?> "><?php __('Number of comments to view', 'palette') ?></label>
	<input class="tiny-text" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="count" step="1" min="1" value="<?php echo $count; ?>" size="3" />
	</p>

	<?php
	}

	public function update($new_instance, $old_instance){
		$instance = $old_instance ? $old_instance : array();
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['count'] = absint( $new_instance['count'] );
		return $instance;
	}

}

 ?>

<?php 

class Palette_Twitter_Widget extends WP_Widget{
	function __construct(){
		parent::__construct(
			'palette_twitter_widget',
			__( 'Palette Twitter', 'palette'),
			array( 'description' => __('Recent tweets', 'palette'))
		);
	}

	public function widget( $args, $instance ){
		$output = "";
		$count = ( ! empty( $instance['count'] ) ) ? absint( $instance['count'] ) : 5;
		//http://codrips.com/wp-content/themes/palette/libs/tmhOAuth/tweets_json.php
		// echo get_template_directory_uri();
		// require get_template_directory().'/libs/tmhOAuth/tmhOAuth.php';
		echo '<div class="palette-twitter">';

		if ( ! empty( $instance['title'] ) ) {
			$output .= $args['before_title'];
			$output .= '<a href="#"><span><i class="fa fa-twitter" aria-hidden="true"></i></span> ';
			$output .= apply_filters( 'widget_title', $instance['title'] );
			$output .= '</a><span class="fullscreen-component"></span>';
			$output .= $args['after_title'];
			echo $output;
		}
		echo '<ul class="tweets">';
		// for($i = 0; $i < $count; $i++){
			echo '<li class="loading-anim clearfix">';
				echo '<img src="'.get_template_directory_uri().'/img/spinner.gif'.'" alt="Loading">';
			echo '</li>';
			// $dt = new DateTime($tweets[$i]->created_at);
			// $dateTime = strtotime($tweets[$i]->created_at);

			//<span class="tweet-time"><i class="fa fa-twitter-square" aria-hidden="true"></i></span>
			
			// echo '<p class="tweet-via">'.__('via', 'palette').' '.$tweets[$i]->source.'</p>';
			
		// }
		echo '</ul>';
		echo '</div>';
		if(! (home_url() == "http://localhost:8888") ){
			wp_enqueue_script('twitter_ajax',get_template_directory_uri().'/js/widgets/twitterAjax.js',[],false,true);

			wp_localize_script('twitter_ajax', 'TWITTER_AJAX_SETTINGS', array(
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
		}
		?>
		<?php

		// $output = "";
		// echo $output;
	}
	public function form( $instance ){
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : "";
		$api_key = isset( $instance['api_key'] ) ? esc_attr( $instance['api_key']) : "";
		$api_secret = isset( $instance['api_secret'] ) ? esc_attr( $instance['api_secret']) : "";
		$access_token = isset( $instance['access_token'] ) ? esc_attr( $instance['access_token']) : "";
		$access_secret = isset( $instance['access_secret'] ) ? esc_attr( $instance['access_secret']) : "";
		$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 5;
	?>
	<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'api_key' ); ?>"><?php _e( 'API Key:' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'api_key' ); ?>" name="<?php echo $this->get_field_name( 'api_key' ); ?>" type="text" value="<?php echo $api_key; ?>" />
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'api_secret' ); ?>"><?php _e( 'API Secret:' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'api_secret' ); ?>" name="<?php echo $this->get_field_name( 'api_secret' ); ?>" type="text" value="<?php echo $api_secret; ?>" />
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'access_token' ); ?>"><?php _e( 'Access Token:' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'access_token' ); ?>" name="<?php echo $this->get_field_name( 'access_token' ); ?>" type="text" value="<?php echo $access_token; ?>" />
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'access_secret' ); ?>"><?php _e( 'Token Secret:' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'access_secret' ); ?>" name="<?php echo $this->get_field_name( 'access_secret' ); ?>" type="text" value="<?php echo $access_secret; ?>" />
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
		$instance['api_key'] = sanitize_text_field( $new_instance['api_key'] );
		$instance['api_secret'] = sanitize_text_field( $new_instance['api_secret'] );
		$instance['access_token'] = sanitize_text_field( $new_instance['access_token'] );
		$instance['access_secret'] = sanitize_text_field( $new_instance['access_secret'] );
		$instance['count'] = absint( $new_instance['count'] );
		return $instance;
	}

}

 ?>
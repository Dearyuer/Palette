<?php 

class Palette_Profile_Widget extends WP_Widget{
	function __construct(){
		parent::__construct(
			'palette_profile_widget',
			__( 'Palette Profile', 'palette'),
			array( 'description' => __('Your profile', 'palette'))
		);
	}
	public function widget( $args, $instance ){

		$output = "";

		echo '<div class="palette-sidebar-profile">';

		if ( ! empty( $instance['title'] ) ) {
			$output .= $args['before_title'];
			$output .= '<a href="#"><span><i class="fa fa-user" aria-hidden="true"></i></span> ';
			$output .= apply_filters( 'widget_title', $instance['title'] );
			$output .= '</a><span class="fullscreen-component"></span>';
			$output .= $args['after_title'];
			echo $output;
		}
		?>
		<ul class="palette-profile clearfix">
			<li class="palette-profile-avatar">
				<?php echo get_avatar(1,300); ?>
			</li>
			<li class="palette-profile-name">
				<a href="#"><p><?php echo get_userdata(1)->display_name; ?></p></a>
			</li>
			<li class="palette-profile-email">
				<a href="mailto:<?php echo get_userdata(1)->user_email;?>"><p><i class="fa fa-envelope-o" aria-hidden="true"></i><?php echo " ".get_userdata(1)->user_email; ?></p>
				</a>
			</li>
			
			<li class="palette-profile-social-parent">
				<ul class="palette-profile-social clearfix">
					<?php if($instance['github_url'] != "#" && !empty($instance['github_url']) ) { ?>
					<li>
						<a href="<?php echo $instance['github_url'] ?>">
							<i class="fa fa-github" aria-hidden="true"></i>
						</a>
					</li>
					<?php } ?>
					<?php if($instance['facebook_url'] != "#" && !empty($instance['facebook_url'])) { ?>
					<li>
						<a href="<?php echo $instance['facebook_url'] ?>">
							<i class="fa fa-facebook-official" aria-hidden="true"></i>
						</a>
					</li>
					<?php } ?>
					<?php if($instance['twitter_url'] != "#" && !empty($instance['twitter_url'])) { ?>
					<li>
						<a href="<?php echo $instance['twitter_url'] ?>">
							<i class="fa fa-twitter" aria-hidden="true"></i>
						</a>
					</li>
					<?php } ?>
					<?php if($instance['dribbble_url'] != "#" && !empty($instance['dribbble_url']) ) { ?>
					<li>
						<a href="<?php echo $instance['dribbble_url'] ?>">
							<i class="fa fa-dribbble" aria-hidden="true"></i>
						</a>
					</li>
					<?php } ?>
					<?php if($instance['tumblr_url'] != "#" && !empty($instance['tumblr_url'])) { ?>
					<li>
						<a href="<?php echo $instance['tumblr_url'] ?>">
							<i class="fa fa-tumblr" aria-hidden="true"></i>
						</a>
					</li>
					<?php } ?>
				</ul>
			</li>
		</ul>





		<?php
		$output = "";
		$output .= '<a href="#"><span><i class="fa fa-minus" aria-hidden="true"></i></span></a>';
		echo $output;
		echo $args['after_widget'];
	}
	public function form($instance){
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : "";
		$avatar_src  = isset( $instance['avatar_src'] ) ? esc_attr( $instance['avatar_src'] ) : "#";
		$display_mode    = isset( $instance['display_mode'] ) ? absint( $instance['display_mode'] ) : "Round square";
		$show_email = isset( $instance['show_email'] ) ? (bool) $instance['show_email'] : false;


		$github_url  = isset( $instance['github_url'] ) ? esc_attr( $instance['github_url'] ) : "#";
		$facebook_url  = isset( $instance['facebook_url'] ) ? esc_attr( $instance['facebook_url'] ) : "#";
		$twitter_url  = isset( $instance['twitter_url'] ) ? esc_attr( $instance['twitter_url'] ) : "#";
		$dribbble_url  = isset( $instance['dribbble_url'] ) ? esc_attr( $instance['dribbble_url'] ) : "#";
		$tumblr_url  = isset( $instance['tumblr_url'] ) ? esc_attr( $instance['tumblr_url'] ) : "#";


		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p><label for="<?php echo $this->get_field_name( 'avatar_src' ); ?>"><?php _e( 'Profile URL' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_name( 'avatar_src' ); ?>" name="<?php echo $this->get_field_name( 'avatar_src' ); ?>" type="text" value="<?php echo $avatar_src;  ?>" /></p>

		<p><input class="checkbox" type="checkbox"<?php checked( $show_email ); ?> id="<?php echo $this->get_field_id( 'show_email' ); ?>" name="<?php echo $this->get_field_name( 'show_email' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_email' ); ?>"><?php _e( 'Show email?' ); ?></label></p>

		<p><label for="<?php echo $this->get_field_name( 'github_url' ); ?>"><?php _e( 'Github URL' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_name( 'github_url' ); ?>" name="<?php echo $this->get_field_name( 'github_url' ); ?>" type="text" value="<?php echo $github_url;  ?>" /></p>

		<p><label for="<?php echo $this->get_field_name( 'facebook_url' ); ?>"><?php _e( 'Facebook URL' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_name( 'facebook_url' ); ?>" name="<?php echo $this->get_field_name( 'facebook_url' ); ?>" type="text" value="<?php echo $facebook_url;  ?>" /></p>

		<p><label for="<?php echo $this->get_field_name( 'twitter_url' ); ?>"><?php _e( 'Twitter URL' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_name( 'twitter_url' ); ?>" name="<?php echo $this->get_field_name( 'twitter_url' ); ?>" type="text" value="<?php echo $twitter_url;  ?>" /></p>

		<p><label for="<?php echo $this->get_field_name( 'dribbble_url' ); ?>"><?php _e( 'Dribbble URL' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_name( 'dribbble_url' ); ?>" name="<?php echo $this->get_field_name( 'dribbble_url' ); ?>" type="text" value="<?php echo $dribbble_url;  ?>" /></p>

		<p><label for="<?php echo $this->get_field_name( 'tumblr_url' ); ?>"><?php _e( 'Tumblr URL' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_name( 'tumblr_url' ); ?>" name="<?php echo $this->get_field_name( 'tumblr_url' ); ?>" type="text" value="<?php echo $tumblr_url;  ?>" /></p>


		<?php 
	}
	public function update($new_instance, $old_instance){
		$instance = $old_instance ? $old_instance : array();
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['avatar_src'] = $new_instance['avatar_src'];
		$instance['display_mode'] = $new_instance['display_mode'];
		$instance['show_email'] = isset( $new_instance['show_email'] ) ? (bool) $new_instance['show_email'] : false;



		$instance['github_url'] = $new_instance['github_url'];
		$instance['facebook_url'] = $new_instance['facebook_url'];
		$instance['twitter_url'] = $new_instance['twitter_url'];
		$instance['dribbble_url'] = $new_instance['dribbble_url'];
		$instance['tumblr_url'] = $new_instance['tumblr_url'];


		return $instance;
	}
}
 ?>
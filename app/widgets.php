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
			$output .= '</a><a href="#"><span><i class="fa fa-bars right" aria-hidden="true"></i></span></a>';
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
			$output .= '</a><a href="#"><span><i class="fa fa-bars right" aria-hidden="true"></i></span></a>';
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




////////////////////////////////////////////////////////////////////////////






function handleProfileUploadFn(){
	$profile_img_upload_name = 'palette_profile_image_upload';
	$profile_img_upload_nonce = $profile_img_upload_name.'_nonce';
	$profile_img_upload_src = "#";
	if( isset($_POST['profile_image_upload_submit'])  &&  check_admin_referer($profile_img_upload_name, $profile_img_upload_nonce) ){
		if ( 
			isset( $_POST[$profile_img_upload_nonce], $_POST['profile_img_post_id'] ) 
			&& current_user_can( 'manage_options' )
		) {
			require_once( ABSPATH . 'wp-admin/includes/image.php' );
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
			require_once( ABSPATH . 'wp-admin/includes/media.php' );
			$profile_image_id = media_handle_upload( $profile_img_upload_name, $_POST['profile_img_post_id']);
			if ( is_wp_error( $profile_image_id ) ) { ?>
				<div class="notice notice-error">
					
					<p><?php _e("There's an error while uploading","palette"); ?></p>
				</div>
			<?php
			} else {
				$profile_img_upload_src = wp_get_attachment_image_src($profile_image_id)[0];
				?>
				<div class="notice notice-success">
					<p><strong><?php _e('Uploaded.', 'palette' ); ?></strong></p>
				</div>
				<?php
			} 
		}
	}

}
////////////////////////////////////////////////////////////////////////////
// add_action('widgets_init','handleProfileUploadFn');





class Palette_Recent_Posts_Widget extends WP_Widget {
	function __construct(){
		parent::__construct(
			'palette_recent_posts_widget',
			__( 'Palette Recent Posts' , 'palette'),
			array( 'description' => __('Display recent posts', 'palette') )
		);
	}
	public function widget( $args, $instance ) {
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) ) );

		if ($r->have_posts()) {
		echo $args['before_widget'];
		
		?>
		<ul class="palette-recent-posts">
		<?php 
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . '<a href="#"><span><i class="fa fa-file-text" aria-hidden="true"></i></span> '.apply_filters( 'widget_title', $instance['title'] ) .'</a><a href="#"><span><i class="fa fa-bars right" aria-hidden="true"></i></span></a>'. $args['after_title'];
		}
		?>
		<?php while ( $r->have_posts() ) { $r->the_post(); ?>
			<li>
				<a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
			<?php if ( $show_date ) { ?>
				<span class="post-date"><?php echo get_the_date(); ?></span>
			<?php } ?>
			</li>
		<?php } ?>
		<?php 
		$output = "";
		$output .= '<li class="minus-sign"><a href="#"><span><i class="fa fa-minus" aria-hidden="true"></i></span></a></li>';
		echo $output;
		?>
		</ul>
		<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		}
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : __("Recent posts",'palette');
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label></p>
	<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		return $instance;
	}
}


class Palette_Comments_Widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'palette_comments_widget', // Base ID
			__( 'Palette Comments Widget' ), // Name
			array( 'description' => __('Display recent comments', 'palette') ) // Args
		);
	}
	function widget( $args, $instance ) {
		$output = "";
		$temp = "";
		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		$limit = ( ! empty( $instance['limit'] ) ) ? absint( $instance['limit'] ) : 33;
		if ( ! $number ) $number = 5;
		if ( ! $limit ) $limit = 33;
		echo $args['before_widget'];
		
		$comments = get_comments( apply_filters( 'widget_comments_args', array(
			'number'      => $number,
			'status'      => 'approve',
			'post_status' => 'publish'
		) ) );
		$output .= '<ul class="palette-sidebar-comments">';
		if ( ! empty( $instance['title'] ) ) {
			$output .= $args['before_title'] .'<a href="#"><span><i class="fa fa-comments" aria-hidden="true"></i></span> '. apply_filters( 'widget_title', $instance['title'] ) .'</a><a href="#"><span><i class="fa fa-bars right" aria-hidden="true"></i></span></a>'. $args['after_title'];
		}
		if (is_array($comments) && $comments){
			foreach((array)$comments as $comment){
				$output .= '<li class="sidebar-comment">';
				// $output .= '<div class="sidebar-avatar"><a href="'.$comment->comment_author_url.'">'.get_avatar($comment,40).'</a></div>';
				$output .= '<span class="comment-date">'.get_comment_date('M',$comment->comment_ID).'<span>'.get_comment_date('j',$comment->comment_ID).'</span></span>';
				if(mb_strlen($comment->comment_content,'utf8') > $limit){
					$temp = mb_substr($comment->comment_content,0,$limit,'utf8');
					$output .= '<p class="each-comment"><a href="'.esc_url( get_comment_link( $comment) ).'">'.$temp."..."."</a>";
				}else{
					$temp = $comment->comment_content;
					$output .= '<p class="each-comment"><a href="'.esc_url( get_comment_link( $comment) ).'">'.$temp."</a>";
				}
				$output .= '<span class="comment-meta">'.timeAgo(time(),get_comment_date('U',$comment)).'</span>';
				$output .= '</li>';
				// var_dump($comment);
			}
		}
		$output .= '<li class="minus-sign"><a href="#"><span><i class="fa fa-minus" aria-hidden="true"></i></span></a></li>';
		$output .= '</ul>';
		echo $output;
		echo $args['after_widget'];
	}
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __('Recent Comments', 'palette');
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$limit = isset( $instance['limit'] ) ? absint( $instance['limit'] ) : 33;
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( esc_attr( 'Title:' ) ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'number' ); ?> "><?php __('Number of comments to view', 'palette') ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php  __('Text limits', 'palette') ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" type="number" step="1" min="1" value="<?php echo $limit; ?>" size="3" />
		</p>
		<?php 
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['number'] = absint( $new_instance['number'] );
		$instance['limit'] = absint( $new_instance['limit']);
		return $instance;
	}
} 

add_action( 'widgets_init', function(){
	register_widget( 'Palette_Profile_Widget' );
	register_widget( 'Palette_Twitter_Widget' );
	register_widget( 'Palette_Recent_Posts_Widget' );
	register_widget( 'Palette_Comments_Widget' );
	register_sidebar([
		'name'          => __( 'Sidebar'),
		'id'            => 'sidebar',
		'before_widget' => '<div class="sidebar-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>'
	]);
});


 ?>
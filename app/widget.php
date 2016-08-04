<?php 

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
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		?>
		<ul class="palette-recent-posts">
		<?php while ( $r->have_posts() ) { $r->the_post(); ?>
			<li>
				<a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
			<?php if ( $show_date ) { ?>
				<span class="post-date"><?php echo get_the_date(); ?></span>
			<?php } ?>
			</li>
		<?php } ?>
		</ul>
		<?php echo $args['after_widget']; ?>
		<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		}
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
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
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		$comments = get_comments( apply_filters( 'widget_comments_args', array(
			'number'      => $number,
			'status'      => 'approve',
			'post_status' => 'publish'
		) ) );
		$output .= '<ul class="palette-sidebar-comments">';
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
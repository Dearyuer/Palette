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
		
		?>
		<ul class="palette-recent-posts">
		<?php 
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . '<a href="#"><span><i class="fa fa-file-text" aria-hidden="true"></i></span> '.apply_filters( 'widget_title', $instance['title'] ) .'</a><span class="fullscreen-component"></span>'. $args['after_title'];
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

 ?>
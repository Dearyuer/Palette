<?php 


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
			$output .= $args['before_title'] .'<a href="#"><span><i class="fa fa-comments" aria-hidden="true"></i></span> '. apply_filters( 'widget_title', $instance['title'] ) .'</a><span class="fullscreen-component"></span>'. $args['after_title'];
		}
		if (is_array($comments) && $comments){
			foreach((array)$comments as $comment){
				$output .= '<li class="sidebar-comment">';
				// $output .= '<div class="sidebar-avatar"><a href="'.$comment->comment_author_url.'">'.get_avatar($comment,40).'</a></div>';
				$output .= '<span class="comment-date">'.get_comment_date('M',$comment->comment_ID).'<span>'.get_comment_date('j',$comment->comment_ID).'</span></span>';
				if(mb_strlen($comment->comment_content,'utf8') > $limit){
					$temp = mb_substr($comment->comment_content,0,$limit,'utf8');
					$output .= '<p class="each-comment">'.$temp."...";
				}else{
					$temp = $comment->comment_content;
					$output .= '<p class="each-comment">'.$temp;
				}
				$output .= '<span class="comment-meta">'.timeAgo(time(),get_comment_date('U',$comment)).'</span></p>';
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
 ?>
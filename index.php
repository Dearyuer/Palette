<?php get_header(); ?>
<div class="container clearfix">
	<div class="page-home">
		<div class="blog-info">
			<h2 class="title"><?php bloginfo('name'); ?></h2>
			<p class="description"><?php bloginfo('description'); ?></p>
			<a href="<?php echo get_home_url().'/blog' ?>"><button class="btn">Go to blog</button></a>
        </div>
        <div class="latest-content">
			<div class="row">
				<div class="pallete-col-2 content">
                    <div class="component-title"><p>Latest post</p></div>
					<div>
						<?php 
						$home_latest_post = new WP_Query('posts_per_page=1');
						$home_latest_post_title = '';
						if($home_latest_post->have_posts()){
							while($home_latest_post->have_posts()){
								$home_latest_post->the_post();
								$home_latest_post_title = get_the_title();
								?>
								<p><?php the_excerpt(); ?></p>
								<?php
							}
						}
						wp_reset_postdata();
						?>
					</div>
				</div>
				<div class="pallete-col-2 content">
                    <div class="component-title"><p>Lastest comments</p></div>
                    <div class="home-comments">
                        <ul>
						<?php 
						$comments = get_comments(array(
							'number'      => 3,
							'status'      => 'approve',
							'post_status' => 'publish'
						));
						foreach((array)$comments as $comment){
                            echo '<li>';
                            echo '<div class="comment-avatar right"><a href="'.$comment->comment_author_url.'">'.get_avatar($comment,40).'</a></div>';
							echo '<p>'.$comment->comment_content.'</p><br/>';
                            echo '</li>';
						}
						
						?>
                        </ul>
					</div>
				</div>
			</div>
		</div>
        <div class="footer-info ">
			<button class="btn"><i class="fa fa-angle-up" aria-hidden="true"></i></button>
		</div>	


	</div>
</div>
<?php get_footer(); ?>

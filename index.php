<?php get_header(); ?>
<div class="container clearfix">
	<div class="page-home">
		<div class="blog-info">
			<h2 class="title"><?php bloginfo('name'); ?></h2>
			<p class="description"><?php bloginfo('description'); ?></p>
			<a href="<?php echo get_home_url().'/blog' ?>"><button class="btn">Go to blog</button></a>
		</div>	
		<div class="latest-post">
			<div class="component-title"><p><i class="fa fa-sticky-note" aria-hidden="true"></i> Latest post</p></div>
			<div class="row">
				<div class="pallete-col-2 content">
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
				<div class="pallete-col-2">
					<div class="inner">
						<div class="sticky-note"><i class="fa fa-sticky-note-o" aria-hidden="true"></i></div>
						<div class="title"><?php echo $home_latest_post_title; ?></div>
					</div>

				</div>
			</div>
		</div>

		<div class="latest-post latest-comment">
			<div class="component-title"><p><i class="fa fa-comment" aria-hidden="true"></i> Latest comment</p></div>
			<div class="row">
				<div class="pallete-col-2">
					<div class="inner">
						<div class="sticky-note"><i class="fa fa-comment-o" aria-hidden="true"></i></div>
						<!-- <div class="title"><?php //echo $home_latest_post_title; ?></div> -->
					</div>
				</div>
				<div class="pallete-col-2 content right">
					<div>
						<?php 
						$comments = get_comments(array(
							'number'      => 1,
							'status'      => 'approve',
							'post_status' => 'publish'
						));
						foreach((array)$comments as $comment){
							echo '<p>'.$comment->comment_content.'</p><br/>';
						}
						
						?>
					</div>
				</div>
				
			</div>
		</div>
		<div class="latest-post">
			<div class="component-title"><p><i class="fa fa-code" aria-hidden="true"></i> Contribution</p></div>
			<div class="row">
				
				<div class="pallete-col-2 content">
					<div>
						Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
					</div>
				</div>
				<div class="pallete-col-2">
					<div class="inner">
						<div class="sticky-note"><i class="fa fa-code" aria-hidden="true"></i></div>
						<!-- <div class="title"><?php //echo $home_latest_post_title; ?></div> -->
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

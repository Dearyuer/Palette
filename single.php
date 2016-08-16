<section class="main-content">
	<div class="scroll-wrap">
		<div class="prev-post-left-arrow">
			<img src="" alt="" />
		</div>
		<div class="next-post-right-arrow">
			<img src="" alt="" />
		</div>

		<article class="content-item container">
			<div class="post-content">
				<div class="title"><a href="#"><span><i class="fa fa-sticky-note" aria-hidden="true"></i></span> 博文</a><span class="fullscreen-component"><i class="fa fa-times" aria-hidden="true"></i></span></div>
				<div class="content-text">
					<div class="content-author">
						<!-- <img src="" /> -->
						<?php echo get_avatar($post->post_author,300); ?>
					</div>
					<div class="content-author-name">
						<span><?php echo get_userdata($post->post_author)->display_name; ?></span>
					</div>
					<h1 class="content-title"><?php echo $post->post_title; ?></h1>
					<div class="post-meta">
						<i class="fa fa-clock-o" aria-hidden="true"></i> <span class="post--time--ago"><?php echo timeAgo(time(),get_the_time("U")); ?></span>
					</div>
					<div class="content-divider">
						<div class="content-divider-line"></div>
					</div>
					<p>
						<?php echo $post->post_content; ?>
					</p>
				</div>
				<div class="elem-hidden">{{</div>
					<div class="comments-template-area"><?php comments_template(); ?></div>
				<div class="elem-hidden">}}</div>
			</div>
		</article>
	</div>
</section>

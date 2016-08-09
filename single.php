<?php get_header(); ?>
<div class="container clearfix">

	<div class="single-page">

	<?php	
		if(have_posts()) {
				while(have_posts()){
					the_post();?>
						<?php var_dump($post); ?>
						<?php ?>
						<div class="author-avatar">
							<a href="<?php echo get_author_posts_url(get_the_author_meta("ID")); ?>"><?php echo get_avatar($post->post_author,40) ?></a>
						</div>
						<article class="post single-post <?php if ( has_post_thumbnail() ) { ?>has-thumbnail <?php } ?>">
					 		<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('small-thumbnail'); ?></a>
							</div>
							
							<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

							<div class="content">
								<?php 
									the_content();
								?>
							</div>
							<div class="post-meta">
								<?php echo timeAgo(time(),get_the_time("U")); ?>
									-
								<?php $escapePercentSign = "%";comments_number(__("No comments", "palette"), __("1 comments", "palette"), sprintf(__("%s comments", "palette"), $escapePercentSign)); ?>
							</div>
						</article>
		<?php	}
		}else{
				echo "<p> No posts </p>";
		}
	?>

	<?php comments_template(); ?>
	
	</div>
</div>

<?php get_footer(); ?>
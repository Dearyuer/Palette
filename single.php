<?php get_header(); ?>
<div class="container clearfix">
	<div class="main-area">
		<?php	
			if(have_posts()) {
					while(have_posts()){
						the_post();?>
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
	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
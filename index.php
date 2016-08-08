<?php get_header(); ?>
<div class="container clearfix">
	<?php get_sidebar(); ?>
	<div class="main-area">
		<div class="posts-title"><a href="#"><span><i class="fa fa-sticky-note posts-title-icon" aria-hidden="true"></i></span> 博文</a><a href="#"><span><i class="fa fa-bars right" aria-hidden="true"></i></i></span></div>
		<?php 
			if(have_posts()) {
				while(have_posts()){
					the_post();
					get_template_part('main','area');
				}
			}else{
					echo "<p> No posts </p>";
			}
		?>
	</div>
</div>
<?php get_footer(); ?>
<?php get_header(); ?>
<div class="container clearfix">
	<?php get_sidebar(); ?>
	<div class="main-area">
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
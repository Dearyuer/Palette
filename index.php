<?php get_header(); ?>
<?php $particle_enable_state_hd = get_option("palette_particle_toggle"); ?>
<?php if($particle_enable_state_hd) { ?>
	<div id="particles-js"></div>
<?php } ?>
<div class="container clearfix">
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
	<a class="timeline" ></a>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
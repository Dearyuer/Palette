<?php get_header(); ?>
<div class="container main-container clearfix">
	<?php get_sidebar(); ?>
	<div class="main-area">
		<!-- scrape -->
		<div class="contri">
			<div class="contri-title"><a href="#"><span><i class="fa fa-github-alt" aria-hidden="true"></i></span> 动态</a><span class="fullscreen-component"><i class="fa fa-bars right" aria-hidden="true"></i></span></div>
			<?php 
			echo '<div class="git-contri-loading-anim">';
				echo '<img src="'.get_template_directory_uri().'/img/spinner.gif'.'" alt="Loading">';
			echo '</div>';
			if(! (home_url() == "http://localhost:8888") ){
				wp_enqueue_script( 'github_contri_ajax', get_template_directory_uri().'/js/widgets/githubContriAjax.js',[],false,true);
				wp_localize_script( 'github_contri_ajax', 'GIT_HUB_CON_AJAX', array(
					'home_url' => home_url(),
				));
			}
			?>
		</div>
		<div class="posts-area">
			<div class="posts-title"><a href="#"><span><i class="fa fa-sticky-note posts-title-icon" aria-hidden="true"></i></span> 博文</a><span class="fullscreen-component"><i class="fa fa-bars right" aria-hidden="true"></i></span></div>
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
</div>
<?php get_footer(); ?>
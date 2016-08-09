<?php get_header(); ?>
<div class="container clearfix">
	<?php get_sidebar(); ?>
	<div class="main-area">
		<!-- scrape -->
		<div class="contri">
			<div class="contri-title"><a href="#"><span><i class="fa fa-github-alt" aria-hidden="true"></i></span> 动态</a><a href="#"><span><i class="fa fa-bars right" aria-hidden="true"></i></span></a></div>
			<?php 
			if(! (home_url() == "http://localhost:8888") ){
				// wp_enqueue_script( 'github_contri_ajax', get_template_directory_uri().'/js/widgets/githubContriAjax.js',[],false,true);
				$githubUsername = "Dearyuer";
				$githubContri = file_get_contents("https://github.com/users/".$githubUsername."/contributions"); 
				$githubContri = preg_replace('/class="js-calendar-graph-svg"/','viewBox="0 -7 796 126"',$githubContri);
				$githubContri = preg_replace('/#1e6823/','#1d9af6',$githubContri);
				$githubContri = preg_replace('/#8cc665/','#00a8f2',$githubContri);
				$githubContri = preg_replace('/#44a340/','#00bfff',$githubContri);
				echo $githubContri;
			}
			?>
		</div>
		<div class="posts-title"><a href="#"><span><i class="fa fa-sticky-note posts-title-icon" aria-hidden="true"></i></span> 博文</a><a href="#"><span><i class="fa fa-bars right" aria-hidden="true"></i></span></a></div>
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
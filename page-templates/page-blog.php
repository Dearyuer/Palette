<?php 
/*
* Template Name: Blog Page
*/
 get_header(); ?>
<div class="container main-container clearfix">

    <?php get_info(); ?>
 	<?php get_sidebar(); ?>
 	<div class="main-area">
 		<!-- scrape -->
 		<div class="contri">
 			<div class="contri-title"><a href="#"><span><i class="fa fa-github-alt" aria-hidden="true"></i></span> <?php echo __("Contribution","palette");?></a><span class="fullscreen-component"></span></div>
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
 			<div class="posts-title"><a href="#"><span><i class="fa fa-sticky-note posts-title-icon" aria-hidden="true"></i></span> <?php echo __("Posts","palette") ?></a><span class="fullscreen-component"></span></div>
 			<?php 
 				$blog_posts = new WP_Query('posts_per_page=-1');
 				if($blog_posts->have_posts()) {
 					while($blog_posts->have_posts()){$blog_posts->the_post();
 			?>
 			<article class="post<?php if ( has_post_thumbnail() ) { ?> has-thumbnail<?php } ?>">
 				<a class="post-item" url="<?php the_permalink(); ?>" post-id="<?php echo get_the_ID(); ?>">
 					<div class="main-post">
 				 		<div class="post-thumbnail">
 							<?php the_post_thumbnail('small-thumbnail'); ?>
 						</div>
 						<h2 class="post-title"><?php the_title(); ?></h2>
 						<div class="post-meta">
 							<i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo sprintf("%s %s-%s-%s",__("Posted on","palette"),get_the_time('Y'),get_the_time('m'),get_the_time('d')) ?>
 							&nbsp;
 							<?php $categories = get_the_category(); 
 							// var_dump($categories);
 							$outputCategories = "";
 							if($categories){
 								foreach ($categories as $category) {
 									$outputCategories .= $category->cat_name .",";
 								}
 							}
 							$outputCategories = trim($outputCategories, ",");
 							?>
 							<i class="fa fa-bookmark-o" aria-hidden="true"></i>
 							<?php echo sprintf("%s %s",__("in Category","palette"),$outputCategories); ?>
 							&nbsp;
 							<i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo timeAgo(time(),get_the_time("U")); ?>
 							&nbsp;	
 							<i class="fa fa-comments-o" aria-hidden="true"></i> <?php $escapePercentSign = "%";comments_number(__("No comments", "palette"), __("1 comments", "palette"), sprintf(__("%s comments", "palette"), $escapePercentSign)); ?>
 						</div>

 						<div class="excerpt-content content">
 							<?php 
 							the_excerpt();
 							?>
 						</div>
 						<div class="loader"></div>
 					</div>
 				</a>
 			</article>
 			<?php
 					}
 				}else{
 						echo "<p> No posts </p>";
 				}
 			?>
 			<div class="posts-footer"><a href="#"><span><i class="fa fa-minus" aria-hidden="true"></i></span></a></span></div>
 		</div>
 	</div>
 </div>
 <?php get_footer(); ?>

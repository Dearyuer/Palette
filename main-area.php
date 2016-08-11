<article class="post<?php if ( has_post_thumbnail() ) { ?> has-thumbnail<?php } ?>">
	<!-- <span class="post-date"><?php the_time('M') ?><span><?php the_time('j') ?></span></span> -->
	<a class="post-item" url="<?php the_permalink(); ?>" post-id="<?php echo get_the_ID(); ?>">
		<div class="main-post">

	 		<div class="post-thumbnail">
				<?php the_post_thumbnail('small-thumbnail'); ?>
			</div>

			<h2 class="post-title"><?php the_title(); ?></h2>
	 		
			<div class="post-meta">

				<i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo sprintf("%s %s%s,%s",__("Posted on","palette"),get_the_time('M'),get_the_time('d'),get_the_time('Y')) ?>
				-
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
				-
				<i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo timeAgo(time(),get_the_time("U")); ?>
				-	
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


	// wp_localize_script( "content_service", "CONTENT_SERVICE_URL", array(



	// ));
//global $wp;
//$current_url = home_url(add_query_arg(array(),$wp->request));
 

 ?>
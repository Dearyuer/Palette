<article class="post <?php if ( has_post_thumbnail() ) { ?>has-thumbnail <?php } ?>">
	<span class="post-date"><?php the_time('M') ?><span><?php the_time('j') ?></span></span>
	<div class="main-post">
		
		<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

		<div class="post-meta">

			<?php echo sprintf("%s %s%s,%s",__("Posted on","palette"),get_the_time('M'),get_the_time('d'),get_the_time('Y')) ?>
			-
			<?php $categories = get_the_category(); 
			// var_dump($categories);
			$outputCategories = "";
			if($categories){
				foreach ($categories as $category) {
					$outputCategories .= '<a href="'.get_category_link($category->term_id).'">'.$category->cat_name ."</a>". ",";
				}
			}
			$outputCategories = trim($outputCategories, ",");
			?>
			<?php echo sprintf("%s %s",__("in Category","palette"),$outputCategories); ?>
			-
			<?php echo timeAgo(time(),get_the_time("U")); ?>
			-	
			<?php $escapePercentSign = "%";comments_number(__("No comments", "palette"), __("1 comments", "palette"), sprintf(__("%s comments", "palette"), $escapePercentSign)); ?>
		</div>
 		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('small-thumbnail'); ?></a>
		</div>
		<div class="content">
			<?php 
			// $wordCount = 50;
			// $subContent = mb_substr(get_the_content(),0,$wordCount,'utf8'). "...";
			// echo $subContent;
			the_excerpt();
			?>
		</div>
		<span class="post-indicator"></span>
	</div>
</article>
<article class="post<?php if ( has_post_thumbnail() ) { ?> has-thumbnail<?php } ?>">
	<!-- <span class="post-date"><?php the_time('M') ?><span><?php the_time('j') ?></span></span> -->
	<a class="post-item" href="#">
		<div class="main-post">
			<h2 class="post-title"><?php the_title(); ?></h2>
	 		
			<div class="excerpt-content">
				<?php 
				the_excerpt();
				?>
			</div>
			<div class="loader"></div>
		</div>
	</a>
</article>

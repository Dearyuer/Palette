<article class="post<?php if ( has_post_thumbnail() ) { ?> has-thumbnail<?php } ?>">
	<!-- <span class="post-date"><?php the_time('M') ?><span><?php the_time('j') ?></span></span> -->
	<a class="post-item" url="<?php the_permalink(); ?>">
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
<?php 


	// wp_localize_script( "content_service", "CONTENT_SERVICE_URL", array(



	// ));
//global $wp;
//$current_url = home_url(add_query_arg(array(),$wp->request));
 

 ?>
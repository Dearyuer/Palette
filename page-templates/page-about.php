<?php 

/*
Template Name: Page About Template
*/

get_header();

?>
<div class="container">
	<div class="main-area">
		<?php 
			if(have_posts()) {
				while(have_posts()){
					the_post();
					the_content();
					//__("You can edit this area in page menu (template page About)","palette")
				}
			}
		?>
	</div>
</div>
<?php

get_footer();
 ?>
<?php 

/*
Template Name: Page Activity
*/

?>
<?php get_header(); ?>
<div class="container clearfix">
    <div class="page-activity">
	    <?php get_info(); ?>
		<div class="activity-area row">
		    <div class="palette-col-2-3">

		   	<?php dynamic_sidebar('activity_page'); ?>	
		    	
		    </div>
		    <div class="palette-col-1-3">

		    	
		    </div>
	    </div>
    </div>
</div>
<?php get_footer();?>


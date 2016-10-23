<?php 

/*
Template Name: Page Msg Board
*/

?>
<?php get_header(); ?>
<div class="container clearfix">
	<div class="page-msg-board">
		<?php get_info(); ?>
		<?php comments_template() ?>
	</div>
</div>
<?php get_footer(); ?>
<?php 
/* 
 *
 * Template Name: Reading Page 
 *
 */
?>
<?php get_header(); ?>
<div class="container clearfix">
	<div class="page-home">
        <div class="row page-info">
            <div class="palette-col-8-100">
                <div class="info-icon"><?php echo substr(get_the_title(),0,1); ?></div>
            </div>
            <div class="palette-col-92-100">
                <div class="info-text">
                    <h2 class="title"><?php the_title(); ?></h2>
                    <p class="description"><?php bloginfo('description'); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>


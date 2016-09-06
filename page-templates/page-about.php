<?php 
/* 
 *
 * Template Name: About Page 
 *
 */
?>
<?php get_header(); ?>
<div class="container">
    <div class="row page-info">
        <div class="pallete-col-8-100">
            <div class="info-icon"><?php echo substr(get_the_title(),0,1); ?></div>
        </div>
        <div class="pallete-col-92-100">
            <div class="info-text">
                <h2 class="title"><?php the_title(); ?></h2>
                <p class="description"><?php bloginfo('description'); ?></p>
            </div>
        </div>
    </div>

    <div class="about">
        <div class="row about-component">
            <div class="info-card">
            <?php 
                echo $post->post_content;
             ?>
            </div>
        </div>
        <div class="row about-component">
            awards
        </div>
    </div>
</div>
<?php get_footer(); ?>

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

    <div class="about">
        <div class="row about-component">
            <div class="palette-col-2">
            <?php $avatar_image_src = get_option('palette_about_avatar_image_src'); ?>
            <img class="about-page-profile-img" src="<?php echo $avatar_image_src ? $avatar_image_src : '#';?>" />
            </div>
            <div class="palette-col-2">
                <div class="info-card">
                <?php 
                    echo $post->post_content;
                 ?>
                </div>
            </div>
        </div>
        <div class="row about-component">
            awards
        </div>
    </div>
</div>
<?php get_footer(); ?>

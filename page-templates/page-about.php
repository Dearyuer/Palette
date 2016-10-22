<?php 
/* 
 *
 * Template Name: About Page 
 *
 */
?>
<?php get_header(); ?>
<div class="container">
    <?php get_info(); ?>

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
            <!-- awards -->
        </div>
    </div>
</div>
<?php get_footer(); ?>

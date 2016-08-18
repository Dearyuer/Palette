<?php 

/*
Template Name: Page Archives
*/

?>

<?php get_header(); ?>
<div class="archi-nav">
    <?php after_header(); ?>
</div>
<div class="container clearfix">
    <div class="page-archive">
        <div class="archi-header">
            <h1>Title</h1>
            <p>Except content</p>
            <div class="meta">
                Date author
            </div>
        </div>
        <div class="archi-content">
            <?php 	
                $month = '';
                $prevmonth = '';
                $year = '';
                $prevyear = ''; ?>

            <?php // Cycle through all the posts to display the archive ?>
            <?php query_posts('showposts=-1'); ?>
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <?php // Find the month/year of the current post ?>
            <?php $year = mysql2date('Y', $post->post_date); ?>
            <?php $month = mysql2date('F', $post->post_date); ?>
            <div class="archive-post">
            <?php // Compare the current month with the $prevmonth ?>
            <?php if ($month != $prevmonth) { ?>
                <?php // If it is different, display the new month and reset $prevmonth ?>
                <h4><?php echo $month . ' ' . $year; ?></h4>
                <?php $prevmonth = $month; ?>

            <?php // In case the previous post was a year ago in the same month ?>
            <?php } elseif ($year != $prevyear) { ?>
                <h4><?php // echo $month . ' ' . $year; ?></h4>
                <?php $prevmonth = $month; ?>
                <?php $prevyear = $year; ?>
            <?php } ?>

            <?php // Display the post in this month ?>
            
                <p><a href="<?php the_permalink(); ?>"><?php echo mysql2date('d.m.y', $post->post_date); ?> - <?php the_title(); ?></a></p>
               
            </div>
            <?php endwhile; endif; ?>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        </div>
        <div class="archi-footer">
            footer
        </div>
    </div>
</div>
<div class="archi-footer-nav">
    <?php before_footer(); ?>
</div>
<?php get_footer(); ?>

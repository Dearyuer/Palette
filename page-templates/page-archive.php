<?php 

/*
Template Name: Page Archives
*/

?>

<?php get_header(); ?>
<?php after_header(); ?>
<div class="container clearfix">
    <div class="page-archive">
        <div class="archi-content-before">
            <div class="category">
                <div class="title">分类</div>
                <ul class="category-list clearfix">
                    <?php 
                    $categories = get_categories(); 
                    if($categories){
                        foreach ($categories as $category) {
                            echo '<li>'.$category->cat_name ."</li>";
                        }
                    }
                     ?>
                </ul>
            </div>
        </div>
        <div class="archi-content">
        <div class="title">归档</div>
        <?php 
        $month = '';
        $prev_month = '';
        $year = '';
        $prev_year = '';
        $archi_posts = new WP_Query('posts_per_page=-1');

        if($archi_posts->have_posts()){
            while($archi_posts->have_posts()){
                $archi_posts->the_post();

                $year = mysql2date('Y', $post->post_date); 
                $month = mysql2date('F', $post->post_date);

                if($year != $prev_year){
                    if($prev_year != ""){
                        ?>
                        </div>
                        <?php
                    }
                    $prev_year = $year;

                    ?>
                    <div class="archi-year-wrapper">
                    <h2 class="archi-year"><?php echo $year; ?></h2>

                    <?php
                }

                if($month != $prev_month){
                    if($prev_month != ""){
                        ?>
                        </div>
                        <?php
                    }
                    $prev_month = $month;
                    ?>
                    <div class="archi-month-wrapper">
                    <h4 class="archi-month"><?php echo $month; ?></h4>
                    <?php
                }

                ?>
                <p class="archi-title"><?php echo the_title(); ?></p>
                <?php
            }
            // Close year & month wrapper once if have_posts() is true
            ?>
                </div>
            </div>
            <?php 
        }
        wp_reset_postdata();
        ?> 
        </div>
    </div>
</div>
<?php before_footer(); ?>
<?php get_footer(); ?>

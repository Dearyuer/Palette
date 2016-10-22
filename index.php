<?php get_header(); ?>
<div class="container clearfix">
	<div class="page-home">
        <div class="row page-info">
            <div class="palette-col-8-100">
                <div class="info-icon"><?php echo mb_substr(get_bloginfo('name'),0,1); ?></div>
            </div>
            <div class="palette-col-92-100">
                <div class="info-text">
                    <h2 class="title"><?php bloginfo('name') ?></h2>
                    <p class="description"><?php bloginfo('description'); ?></p>
                </div>
            </div>
        </div>

        <div class="row">
                <div class="home-component">
                <div class="component-identifier"><span class="home-posts-icon"><i class="fa fa-file-text" aria-hidden="true"></i></span></div>
                <div class="content">
                    <div class="component-title"><p>Latest post</p></div>
                    <div class="component-content">
                    <?php 
                    $home_latest_post = new WP_Query('posts_per_page=1');
                    $home_latest_post_title = '';
                    if($home_latest_post->have_posts()){
                        while($home_latest_post->have_posts()){
                            $home_latest_post->the_post();
                            $home_latest_post_title = get_the_title();
                            ?>
                            <p><?php the_excerpt(); ?></p>
                            <?php
                        }
                    }
                    wp_reset_postdata();
                    ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
                <div class="home-component">
                    <div class="component-identifier"><i class="fa fa-comments" aria-hidden="true"></i></div>
                    <div class="content">
                        <div class="component-title"><p>Lastest comments</p></div>
                        <ul class="home-recent-comments">
                        <?php 
                        $comments = get_comments(array(
                            'number'      => 3,
                            'status'      => 'approve',
                            'post_status' => 'publish'
                        ));
                        foreach((array)$comments as $comment){
                            echo '<li>';
                            // echo '<div class="comment-avatar float-left clearfix"><a href="'.$comment->comment_author_url.'">'.get_avatar($comment,40).'</a></div>';
                            echo '<div class="comment-author float-left clearfix">'.substr($comment->comment_author,0,1).'</div>';
                                echo '<p class="home-comments">'.$comment->comment_content.'</p>';
                            echo '</li>';
                        }
                        
                        ?>
                        </ul>
                    </div>
                </div>
        </div>


        <?php dynamic_sidebar('home_page'); ?>
        <div class="footer-info ">
			<button class="btn"><i class="fa fa-angle-up" aria-hidden="true"></i></button>
		</div>	


	</div>
</div>
<?php get_footer(); ?>

<?php get_header(); ?>
<div class="page-home-bg">
    <div class="container clearfix">
    	<div class="page-home">
            <div class="row page-info">
                <div class="palette-col-8-100 info-left">
                    <div class="info-icon"><?php echo mb_substr(get_bloginfo('name'),0,1); ?></div>
                </div>
                <div class="palette-col-92-100 info-right">
                    <div class="info-text">
                        <h2 class="title"><?php bloginfo('name') ?></h2>
                        <p class="description"><?php bloginfo('description'); ?></p>
                    </div>
                </div>
            </div>
            <div class="header-info">
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <button class="btn"><a href="<?php echo home_url().'/blog'; ?>"><p class="info-title"><?php _e("Blog","palette"); ?></p></a></button>
            <br>
            
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            
                <!-- <div class="indicator"></div> -->
            </div>
            <div class="row home-gallery">
                <?php 
                $home_latest_post = new WP_Query('posts_per_page=1');
                $home_latest_post_title = '';
                $home_latest_post_info = '';
                $home_latest_post_excerpt = '';
                $home_latest_post_time_ago = '';
                if($home_latest_post->have_posts()){
                    while($home_latest_post->have_posts()){
                        $home_latest_post->the_post();
                        $home_latest_post_title = get_the_title();
                        $home_latest_post_cat= get_the_category();
                        $home_latest_post_info = $home_latest_post_cat[0]->name;
                        $home_latest_post_excerpt = get_the_excerpt();
                        $home_latest_post_time_ago = timeAgo(time(),get_the_time("U"));
                        // var_dump(get_the_category());
                        // var_dump($home_latest_post);

                    }
                }
                wp_reset_postdata();
                ?>
                <div class="home-grid">
                    <p class="grid-title"><?php echo $home_latest_post_title; ?></p>
                    <p class="grid-content">
                        <?php //echo preg_replace('/(<pre>|<\/pre>|\s)/ig','',mb_substr($home_latest_post_info,0,250)).'...'; ?>
                        <?php echo $home_latest_post_excerpt; ?>
                        
                    </p>
                    <div class="grid-meta row">
                        <p class="palette-col-1-2">
                            <i class="fa fa-bookmark-o" aria-hidden="true"></i>&nbsp;<?php echo sprintf("%s %s",__("in Category","palette"),$home_latest_post_info); ?>
                        </p>
                        <p class="palette-col-1-2">
                            
                            <i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;<?php echo $home_latest_post_time_ago; ?>
                        </p>
                    </div>
                </div>
                <div class="home-grid">
                    <?php 
                    $home_latest_post = new WP_Query([
                        'posts_per_page' => 1,
                        'offset' => 1
                        ]);
                    if($home_latest_post->have_posts()){
                        while($home_latest_post->have_posts()){
                            $home_latest_post->the_post();
                            $home_latest_post_title = get_the_title();
                            $home_latest_post_cat= get_the_category();
                            $home_latest_post_info = $home_latest_post_cat[0]->name;
                            $home_latest_post_excerpt = get_the_excerpt();
                            $home_latest_post_time_ago = timeAgo(time(),get_the_time("U"));
                        }
                    }
                    wp_reset_postdata();
                    ?>
                    <p class="grid-title"><?php echo $home_latest_post_title; ?></p>
                    <p class="grid-content">
                        <?php //echo preg_replace('/(<pre>|<\/pre>|\s)/ig','',mb_substr($home_latest_post_info,0,250)).'...'; ?>
                        <?php echo $home_latest_post_excerpt; ?>
                        
                    </p>
                    <div class="grid-meta row">
                        <p class="palette-col-1-2">
                            <i class="fa fa-bookmark-o" aria-hidden="true"></i>&nbsp;<?php echo sprintf("%s %s",__("in Category","palette"),$home_latest_post_info); ?>
                        </p>
                        <p class="palette-col-1-2">
                            
                            <i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;<?php echo $home_latest_post_time_ago; ?>
                        </p>
                    </div>
                </div>
                <div class="home-grid">
                    <?php 
                    $home_latest_post = new WP_Query([
                        'posts_per_page' => 1,
                        'offset' => 2
                        ]);
                    if($home_latest_post->have_posts()){
                        while($home_latest_post->have_posts()){
                            $home_latest_post->the_post();
                            $home_latest_post_title = get_the_title();
                            $home_latest_post_cat= get_the_category();
                            $home_latest_post_info = $home_latest_post_cat[0]->name;
                            $home_latest_post_excerpt = get_the_excerpt();
                            $home_latest_post_time_ago = timeAgo(time(),get_the_time("U"));
                        }
                    }
                    wp_reset_postdata();
                    ?>
                    <p class="grid-title"><?php echo $home_latest_post_title; ?></p>
                    <p class="grid-content">
                        <?php //echo preg_replace('/(<pre>|<\/pre>|\s)/ig','',mb_substr($home_latest_post_info,0,250)).'...'; ?>
                        <?php echo $home_latest_post_excerpt; ?>
                        
                    </p>
                    <div class="grid-meta row">
                        <p class="palette-col-1-2">
                            <i class="fa fa-bookmark-o" aria-hidden="true"></i>&nbsp;<?php echo sprintf("%s %s",__("in Category","palette"),$home_latest_post_info); ?>
                        </p>
                        <p class="palette-col-1-2">
                            
                            <i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;<?php echo $home_latest_post_time_ago; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="footer-info ">
    			<button class="btn"><i class="fa fa-angle-up" aria-hidden="true"></i></button>
    		</div>	
        	</div>
        </div>
    </div>
</div>
<?php get_footer(); ?>

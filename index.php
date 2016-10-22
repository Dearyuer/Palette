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
        <div class="row home-gallery">
            <div class="home-grid">1</div>
            <div class="home-grid">2</div>
            <div class="home-grid">3</div>
            <div class="home-grid">4</div>
            <div class="home-grid">5</div>

        </div>


        <div class="footer-info ">
			<button class="btn"><i class="fa fa-angle-up" aria-hidden="true"></i></button>
		</div>	


	</div>
</div>
<?php get_footer(); ?>

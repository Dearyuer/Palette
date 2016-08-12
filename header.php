<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title><?php bloginfo('name'); ?></title>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<!-- happy coding have fun! o((◕ฺ∀ ◕ฺ))o -->
		<div class="header">
			<header class="container">
				<nav class="navigation">
					<?php    
						$logo_img_src = get_option("palette_logo_image_src");
						$optimize_logo_img_src = !empty($logo_img_src) ? $logo_img_src : get_bloginfo('template_directory')."/img/logo.png";
						$args = array(
							'theme_location'  => 'nav',
							'menu' 			  => '',
							'container' 	  => '',
							'container_class' => '',
							'container_id'    => '',
							'menu_class'      => 'menu',
							'menu_id'  		  => '',
							'echo'			  => true,
							'fallback_cb' 	  => 'wp_page_menu',
							'before' 		  => '',
							'after' 		  => '',
							'link_before'     => '',
							'link_after'      => '',
							'items_wrap'      => '<ul id = "%1$s" class = "%2$s"><li class="site-logo"><a href="'.home_url().'"><img src="'.$optimize_logo_img_src.'"/></a></li>%3$s</ul>',
							'depth' 		  => 0,
							'walker' 		  => ''
						);
						wp_nav_menu( $args ); ?>
				</nav>
			</header>
		</div>
		<div id="header-shadow"></div>

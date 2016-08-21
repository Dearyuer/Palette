<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title><?php bloginfo('name'); ?></title>
		<?php wp_head(); ?>
	</head>
	<!--[if lte IE 8]>
	<body <?php body_class(); ?> >
	<div><p><?php echo __("You should update your browser!", "palette") ?></p></div>
	<div style="display:none;">
	<![endif]-->
	<!--[if gte IE 8]>
	<body <?php body_class(); ?>>
		<div>
	<![endif]-->
		<!-- happy coding have fun! o((◕ฺ∀ ◕ฺ))o -->
		<div class="header">
			<?php $logo_img_src = get_option("palette_logo_image_src");
				$optimize_logo_img_src = !empty($logo_img_src) ? $logo_img_src : get_bloginfo('template_directory')."/img/logo.png";
			?>
			<!-- <span class="site-logo"><a href="<?php echo home_url(); ?>"><img src="<?php // echo $optimize_logo_img_src; ?>"/></a></span> -->
			<header class="container">
				<nav class="navigation">
					<?php    
						 
						// global $wp;
						// $current_url = trailingslashit(trailingslashit(home_url()).add_query_arg([],$wp->request));
						// $current_url = str_replace("%","%%",$current_url);
						// function detect_lan(){
						// 	$locale = sanitize_key( get_locale() );;
						// 	if( $locale == 'zh_cn' ){
						// 		return 'en';
						// 	}
						// 	return 'cn';
						// }
						$args = array(
							'theme_location'  => 'nav',
							'menu'            => '',
							'container'       => '',
							'container_class' => '',
							'container_id'    => '',
							'menu_class'      => 'menu',
							'menu_id'         => '',
							'echo'            => true,
							'fallback_cb'     => 'wp_page_menu',
							'before'          => '',
							'after'           => '',
							'link_before'     => '',
							'link_after'      => '',
							'items_wrap'      => '<ul id = "%1$s" class = "%2$s"><li class="site-logo menu-item"><a href="'.home_url().'"><img src="'.$optimize_logo_img_src.'"/></a></li>%3$s<li class="search-bar">'.get_search_form( $echo=false ).'</li></ul>',
							'depth'           => 0,
							'walker'          => ''
						);
						//<li class="site-language menu-item"><a class="palette-lan"href="'.$current_url.'?lan='.detect_lan().'">'.__("Chinese","palette").'</a></li>
						//'items_wrap'      => '<ul id = "%1$s" class = "%2$s"><li class="site-logo"><a href="'.home_url().'"><img src="'.$optimize_logo_img_src.'"/></a></li>%3$s</ul>',
						wp_nav_menu( $args ); 
					?>
				</nav>
			</header>
			
		</div>
		<div id="header-shadow"></div>
<?php 

function timeAgo( $now , $time){
    $timeAgo  = $now - $time;
    $temp = 0;
	if(isset($timeAgo)){
		if($timeAgo < 60){
			return __('just now', 'palette');
		}elseif($timeAgo < 1800){
			$temp = floor($timeAgo/60);
			return  sprintf(__('%d minutes ago', 'palette'), $temp);
		}elseif($timeAgo < 3600){
			return __('half an hour ago', 'palette');
		}elseif($timeAgo < 3600*24){
			$temp = floor($timeAgo/3600);
			return sprintf( __('%d hours ago', 'palette'), $temp);
		}elseif($timeAgo < 3600*24*2){
			return __('yesterday', 'palette');
		}else{
			$temp = floor($timeAgo/(3600*24));
			return sprintf( __('%d days ago', 'palette'), $temp);
		}
	}
	else{
		return null;
	}
}

class Palette_Settings_Cache{
	var $palette_settings = [];

	function __construct(){
	}

	function registerSetting($setting){
		// $this->palette_settings = $setting;
		array_push($this->palette_settings, $setting);
	}

	function removeSetting($setting){
	}

	function removeAllSettings(){
		// foreach($this->palette_settings as $setting){
		// 	delete_option($setting);
		// }
	}

}

$palette_settings_cache = new Palette_Settings_Cache;

function after_header(){
	?>
	<div class="header">
		<?php $logo_img_src = get_option("palette_logo_image_src");
			$optimize_logo_img_src = !empty($logo_img_src) ? $logo_img_src : get_bloginfo('template_directory')."/img/logo.png";
		?>
		<!-- <span class="site-logo"><a href="<?php echo home_url(); ?>"><img src="<?php echo $optimize_logo_img_src; ?>"/></a></span> -->
		<header class="container">
			<nav class="navigation">
				<?php    
					 
					global $wp;
					$current_url = trailingslashit(trailingslashit(home_url()).add_query_arg([],$wp->request));
					$current_url = str_replace("%","%%",$current_url);
					function detect_lan(){
						$locale = sanitize_key( get_locale() );;
						if( $locale == 'zh_cn' ){
							return 'en';
						}
						return 'cn';
					}
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
						'items_wrap'      => '<ul id = "%1$s" class = "%2$s"><li class="site-logo menu-item"><a href="'.home_url().'"><img src="'.$optimize_logo_img_src.'"/></a></li>%3$s<li class="site-language menu-item"><a class="palette-lan"href="'.$current_url.'?lan='.detect_lan().'">'.__("Chinese","palette").'</a></li><li class="search-bar">'.get_search_form( $echo=false ).'</li></ul>',
						'depth'           => 0,
						'walker'          => ''
					);
					//'items_wrap'      => '<ul id = "%1$s" class = "%2$s"><li class="site-logo"><a href="'.home_url().'"><img src="'.$optimize_logo_img_src.'"/></a></li>%3$s</ul>',
					wp_nav_menu( $args ); 
				?>
			</nav>
		</header>
		
	</div>
	<div id="header-shadow"></div>
	<?php
}

function before_footer(){
	?>
	<div class="footer">
		<footer class="container">
			<ul class="footer-links right">
				<li><p><a href="//codrips.com"><?php _e("Activity","palette"); ?></a></p></li>
				<li><p><a href="//codrips.com"><?php _e("Archive","palette"); ?></a></p></li>
				<li><p><a href="//codrips.com"><?php _e("About","palette"); ?></a></p></li>
			</ul>
			<a href="<?php echo home_url(); ?>" class="footer-heart">
				<i class="fa fa-heart" aria-hidden="true"></i>
			</a>
			<ul class="footer-links">
				<li><p class="footer-inner"><?php bloginfo('name'); ?> - <i class="fa fa-copyright" aria-hidden="true"></i> <?php echo date('Y') ?></p></li>
				<li><p><a href="//codrips.com"><?php _e("Theme","palette"); ?></a></p></li>
				<li>
					<!-- <i class="fa fa-creative-commons" aria-hidden="true"></i> -->
					<p><?php _e("License","palette"); ?></a></p>
				</li>
			</ul>
		</footer>
	</div>
	<?php
}

 ?>
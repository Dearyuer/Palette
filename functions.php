<?php
/*
* Establish util functionality
*/
require_once get_template_directory().'/app/utils.php';

/*
* Enqueue front-end based scripts
*/
require_once get_template_directory().'/app/views/scripts.php';

/*
* Language setup
*/
add_action('after_setup_theme', function(){
	load_theme_textdomain( 'palette', get_template_directory().'/languages' );
});

/*
* Post Support
*/
add_action('after_setup_theme', function(){
	add_theme_support('post-thumbnails');
});

/*
* Nav menu setup
*/
register_nav_menus([
	'nav' => __('Nav Menu', 'palette'),
]);

/*
* Widgets setup
*/
require_once(get_template_directory().'/app/widgets.php');

/*
* Palette main menu page
*/
add_action( 'admin_menu', function(){
	$sortIndex = 61;
	add_menu_page(
			'palette',
			__('Palette Theme','palette'),
			'manage_options',
			'palette',
			'palette_add_menu_page_fn',
			'dashicons-art',
			$sortIndex
	);
});
/* palette_add_menu_page_fn */
require_once get_template_directory().'/app/functions/main-menu.php';
/* /palette_add_menu_page_fn */

/*
* Palette sub menu page
*/
add_action( 'admin_menu', function(){
	add_submenu_page(
		'palette',
		'Palette',
		'Particle effect settings',
		'manage_options',
		'settings',
		'palette_add_submenu_fn'
	);
});
/* palette_add_submenu_fn */
require_once get_template_directory().'/app/functions/sub-menu.php';
/* /palette_add_submenu_fn */

/*
* Comments section setup
*/
require_once get_template_directory().'/app/functions/comments-section.php';

/*
* Comment form setup
* @usage palette_comment_form();
*/
require_once get_template_directory().'/app/functions/comment-form.php';

/*
* Logout redirection
*/
add_action('wp_logout', function(){
	wp_redirect( home_url() );
	exit();
});

/*
* Change local language
*/
function palette_localized_factory(){
	wp_enqueue_script( 'palette_localization', get_template_directory_uri().'/js/libs/l10n/palette.l10n.js',[],false,true);
}
add_filter( 'locale', 'palette_localized');
function palette_localized( $locale ){
	if( isset( $_GET['lan'] ) ){
		add_action( 'wp_enqueue_scripts', 'palette_localized_factory' );
		return sanitize_key( $_GET['lan'] );
	}
	return $locale;
}
?>
<?php 

require_once(get_template_directory().'/app/utl.php');

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

add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_style( 'normalize', get_template_directory_uri().'/css/normalize.css');
	wp_enqueue_style( 'style', get_stylesheet_uri());

	$particle_enable_state = get_option("palette_particle_toggle");
	if($particle_enable_state && is_home()){
		wp_enqueue_script( 'particles',get_template_directory_uri().'/js/particles.min.js', [], false, true);
		wp_enqueue_script( 'app',get_template_directory_uri().'/js/app.js', [], false, true);
		require_once(get_template_directory().'/app/appData.php');
		require_once(get_template_directory().'/app/appL10n.php');
		wp_enqueue_style( 'particles_style',get_template_directory_uri().'/css/particle.css');
	}

	$transparence_enable_state = get_option("palette_transparence_toggle");
	if($transparence_enable_state){
		wp_enqueue_style( 'transparence', get_template_directory_uri().'/css/transparence.css');
	}
});

function admin_custom_scripts( $hook_suffix ){
	wp_enqueue_style( 'admin_style', get_template_directory_uri().'/css/admin.css');
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'my-script-handle', get_template_directory_uri(). '/js/color-picker.js', array( 'wp-color-picker' ), false, true );
}
add_action( 'admin_enqueue_scripts' , 'admin_custom_scripts');

add_action('after_setup_theme', function(){
	load_theme_textdomain( "palette", get_template_directory()."/languages" );
	add_theme_support('post-thumbnails');
	// add_theme_support('post-formats', array('aside', 'gallery', 'link'));
});

register_nav_menus(['nav' => __("Nav Menu", 'palette')]);

require_once(get_template_directory().'/app/widget.php');

add_action( 'admin_menu', 'palette_add_menu_page' );

function palette_add_menu_page() {
    add_menu_page(
        'palette',
        __('Palette Theme','palette'),
        'manage_options',
        'palette',
        'palette_add_menu_page_fn',
        'dashicons-art',
        61
    );
}

add_action( 'admin_menu', 'palette_add_submenu');

function palette_add_submenu(){
	add_submenu_page(
		'palette',
		'Palette',
		'Particle effect settings',
		'manage_options',
		'settings',
		'palette_add_submenu_fn'
	);
}

function palette_add_menu_page_fn() {
    if (!current_user_can('manage_options')){
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }
    $noChangesSaved = 0;
    $paletteOptionLogoImgSrc = "palette_logo_image_src";
    $paletteOptionLogoId = "palette_logo_id";
    $paletteOptionParticle = "palette_particle_toggle";
    $paletteOptionTransparence = "palette_transparence_toggle";

    //state
    $particle_effect_state;
    $transparent_effect_state;

    //register
    global $palette_settings_cache;
    $palette_settings_cache->registerSetting($paletteOptionLogoImgSrc);
    $palette_settings_cache->registerSetting($paletteOptionLogoId);
    $palette_settings_cache->registerSetting($paletteOptionParticle);
    $palette_settings_cache->registerSetting($paletteOptionTransparence);

   //&& wp_verify_nonce( $_POST['logo_image_upload_nonce'], 'logo_image_upload' )
    if( isset($_POST['logo_image_upload_submit'])  &&  check_admin_referer('logo_image_upload', 'logo_image_upload_nonce') ){
    	if ( 
    		isset( $_POST['logo_image_upload_nonce'], $_POST['post_id'] ) 
    		&& current_user_can( 'manage_options' )
    	) {
    		require_once( ABSPATH . 'wp-admin/includes/image.php' );
    		require_once( ABSPATH . 'wp-admin/includes/file.php' );
    		require_once( ABSPATH . 'wp-admin/includes/media.php' );
    		
    		// Let WordPress handle the upload.
    		// Remember, 'logo_image_upload' is the name of our file input in our form above.
    		$logo_attachment_id = media_handle_upload( 'logo_image_upload', $_POST['post_id'] );
    		if ( is_wp_error( $logo_attachment_id ) ) { ?>
    			<div class="notice notice-error">
    				<p><?php _e("There's an error while uploading","palette") ?></p>
    			</div>
    		<?php
    		} else {
    			if(isset($logo_attachment_id)){
    				update_option($paletteOptionLogoId,$logo_attachment_id);
    				update_option($paletteOptionLogoImgSrc, wp_get_attachment_image_src($logo_attachment_id)[0]);
    			}
    			// echo wp_get_attachment_image($logo_attachment_id);
    			?>

    			<div class="notice notice-success">
    				<p><strong><?php _e('Uploaded.', 'palette' ); ?></strong></p>
    			</div>
    			<?php
    		} 
    	}

    }

    if( isset($_POST['palette_settings_submit']) && check_admin_referer('palette_settings_submit', 'palette_settings_submit_nonce') ){
    	if( isset($_POST['particle_effect_checkbox']) && $_POST['particle_effect_checkbox']  == 'particle'){
    		$particle_effect_state = get_option($paletteOptionParticle);
    		if( empty($particle_effect_state) ) {
    			update_option( $paletteOptionParticle, 1 );
    			echo "<p>updated to true </p>";
    			$noChangesSaved++;
    		}
    	}else{
    		$particle_effect_state = get_option($paletteOptionParticle);
    		if( !empty($particle_effect_state) ){
    			update_option( $paletteOptionParticle, 0 );
    			echo "<p>updated to false</p>";
    			$noChangesSaved++;
    		}
    	}
    	if( isset($_POST['panel_transparence_checkbox']) && $_POST['panel_transparence_checkbox'] == 'transparence'  ){
    		$transparent_effect_state = get_option($paletteOptionTransparence);
    		if ( empty($transparent_effect_state) ){
    			update_option( $paletteOptionTransparence, 1 );
    			echo "<p>updated transparence to true </p>";
    			$noChangesSaved++;
    		}
    	}else{
    		
    		$transparent_effect_state = get_option($paletteOptionTransparence);
    		if( !empty($transparent_effect_state)){
    			update_option( $paletteOptionTransparence, 0);
    			echo "<p>updated transparence to false</p>";
    			$noChangesSaved++;
    		}
    	}

    	if($noChangesSaved == 0){
    		echo '<div class="update-nag"> No changes saved. </div>';
    	} else{
		echo '<div class="notice notice-success">'.__("Updated settings").'</div>';
		}

    }
	require_once(get_template_directory()."/app/appWrapMain.php");
}

function palette_add_submenu_fn(){
	if (!current_user_can('manage_options')){
	  wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	$noChangesSaved = 0;
	require_once( get_template_directory()."/app/appData.php");
	if( isset($_POST['particle_image_submit']) && check_admin_referer( "particle_image" , "particle_image_nonce") ) {
		if ( 
			isset( $_POST['particle_image_nonce'], $_POST['post_id'] ) 
			&& wp_verify_nonce( $_POST['particle_image_nonce'], 'particle_image' )
			&& current_user_can( 'manage_options' )
		) {
			require_once( ABSPATH . 'wp-admin/includes/image.php' );
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
			require_once( ABSPATH . 'wp-admin/includes/media.php' );
			
			// Let WordPress handle the upload.
			// Remember, 'particle_image' is the name of our file input in our form above.
			$particle_image_attachment_id = media_handle_upload( 'particle_image', $_POST['post_id'] );
			if ( is_wp_error( $particle_image_attachment_id ) ) { ?>
				<div class="notice notice-error">
					<p><?php _e("There's an error while uploading","palette") ?></p>
				</div>
			<?php
			} else {
				if(isset($particle_image_attachment_id)){
					update_option($particle_settings["image_id"],$particle_image_attachment_id);
					update_option($particle_settings["image_src"], wp_get_attachment_image_src($particle_image_attachment_id)[0]);
				}
				// echo wp_get_attachment_image($particle_image_attachment_id);
				?>

				<div class="notice notice-success">
					<p><strong><?php _e('Uploaded.', 'palette' ); ?></strong></p>
				</div>
				<?php
			} 
		}

	}//( 'palette_particle_effect_submit', 'palette_particle_effect_submit_nonce')
	if( 
	isset($_POST['palette_particle_effect_submit']) && check_admin_referer( 'palette_particle_effect_submit', 'palette_particle_effect_submit_nonce') 
	){

		require_once(get_template_directory()."/app/appException.php");
		
		require_once(get_template_directory()."/app/appLoop.php");
		
		
		if($noChangesSaved == 0){
			echo '<div class="update-nag"> No changes saved. </div>';
		} elseif($noChangesSaved == -1){
			// do nothing
		}else{
			echo '<div class="notice notice-success">'.__("Updated settings").'</div>';
		}
	}

	require_once(get_template_directory()."/app/appWrapSideOne.php");
}
?>
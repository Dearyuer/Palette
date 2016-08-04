<?php 
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


function palette_custom_scripts(){
	
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
}
add_action( 'wp_enqueue_scripts', 'palette_custom_scripts');

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

class Palette_Comments_Widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'palette_comments_widget', // Base ID
			__( 'Palette Comments Widget' ), // Name
			array( 'description' => __('Display recent comments', 'palette') ) // Args
		);
	}
	public function widget( $args, $instance ) {
		$output = "";
		$temp = "";
		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		$limit = ( ! empty( $instance['limit'] ) ) ? absint( $instance['limit'] ) : 33;
		if ( ! $number ) $number = 5;
		if ( ! $limit ) $limit = 33;
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		$comments = get_comments( apply_filters( 'widget_comments_args', array(
			'number'      => $number,
			'status'      => 'approve',
			'post_status' => 'publish'
		) ) );
		$output .= '<ul class="sidebar-comments">';
		if (is_array($comments) && $comments){
			foreach((array)$comments as $comment){
				$output .= '<li class="sidebar-comment">';
				// $output .= '<div class="sidebar-avatar"><a href="'.$comment->comment_author_url.'">'.get_avatar($comment,40).'</a></div>';
				$output .= '<span class="comment-date">'.get_comment_date('M',$comment->comment_ID).'<span>'.get_comment_date('j',$comment->comment_ID).'</span></span>';
				if(mb_strlen($comment->comment_content,'utf8') > $limit){
					$temp = mb_substr($comment->comment_content,0,$limit,'utf8');
					$output .= '<p class="each-comment"><a href="'.esc_url( get_comment_link( $comment) ).'">'.$temp."..."."</a>";
				}else{
					$temp = $comment->comment_content;
					$output .= '<p class="each-comment"><a href="'.esc_url( get_comment_link( $comment) ).'">'.$temp."</a>";
				}
				$output .= '<span class="comment-meta">'.timeAgo(time(),get_comment_date('U',$comment)).'</span>';
				$output .= '</li>';
				// var_dump($comment);
			}
		}
		$output .= '</ul>';
		echo $output;
		echo $args['after_widget'];
	}
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __('Recent Comments', 'palette');
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$limit = isset( $instance['limit'] ) ? absint( $instance['limit'] ) : 33;
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( esc_attr( 'Title:' ) ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'number' ); ?> "><?php __('Number of comments to view', 'palette') ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php  __('Text limits', 'palette') ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" type="number" step="1" min="1" value="<?php echo $limit; ?>" size="3" />
		</p>
		<?php 
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['number'] = absint( $new_instance['number'] );
		$instance['limit'] = absint( $new_instance['limit']);
		return $instance;
	}
} 

add_action( 'widgets_init', function(){
	register_widget( 'Palette_Comments_Widget' );
	register_sidebar([
		'name'          => __( 'Sidebar'),
		'id'            => 'sidebar',
		'before_widget' => '<div class="sidebar-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>'
	]);
});



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

function  handleParticleLoopArr($particle_settings, $particle_default,$prop, $min = null, $max = null,$step = null, $isColor = null,$hasPreFactor = null,$preFactor = null){
	$_min = "";$_max = "";$_step = "";$disableState = "";$exception="";$notice="";
	if(!is_null($min) ){$_min = sprintf('min="%d"',$min);}
	if(!is_null($max) ){$_max = sprintf('max="%d"',$max);}
	if(!is_null($step) ){$_step= sprintf('step="%s"',(string)$step);}
	if($preFactor){
		$preFactorToString = $preFactor;//*
	}
	if($hasPreFactor){
		$retrieve_palette_pre_factor = get_option($particle_settings[$preFactor]);
		if($retrieve_palette_pre_factor != 1){
			$disableState = "disabled";
			$notice = '<p>'.__(sprintf("You must enable %s above",$preFactorToString)).'</p>';
		}
	}
	$retrieve_palette_prop = get_option($particle_settings[$prop]);
	$value = !empty($retrieve_palette_prop) ? $retrieve_palette_prop : $particle_default[$particle_settings[$prop]]; 
	if($isColor){
		$exception = sprintf('class="custom-color-field" data-default-color="%s"',$particle_default[$particle_settings[$prop]]);//*
	}
	
	$type = sprintf('type="%s"',($isColor ? "text" : "number" ));
	$result = '<input '.$type.' value="'.$value.'" '.$_min.' '.$_max.' '.$_step.' name="'.$particle_settings[$prop].'" '.$disableState.' '.$exception.' />';
	
	return $result.$notice; 
}


function handleParticleLoopArr2($particle_settings,$prop){
	$retrieve_palette_prop = get_option($particle_settings[$prop]);
	$checkedOrNot = "";
	if(empty($retrieve_palette_prop)){
		$checkedOrNot = "checked";
	}elseif(!empty($retrieve_palette_prop) && $retrieve_palette_prop == 1){
		$checkedOrNot = "checked";
	}
	return '<input type="checkbox" name="'.$particle_settings[$prop].'" value="'.$particle_settings[$prop].'" '.$checkedOrNot.' />';
}


function handleParticleLoopArr3($particle_settings,$prop){
	$retrieve_palette_prop = get_option($particle_settings[$prop]);
	$checkedOrNot = "";
	if($retrieve_palette_prop){
		$checkedOrNot = "checked";
	}
	return '<input type="checkbox" name="'.$particle_settings[$prop].'" value="'.$particle_settings[$prop].'" '.$checkedOrNot.' />';
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
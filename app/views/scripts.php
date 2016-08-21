<?php 
add_action( 'wp_enqueue_scripts', function(){
  wp_enqueue_style( 'normalize', get_template_directory_uri().'/css/normalize.css');
	wp_enqueue_script( 'modernizr-custom', get_template_directory_uri().'/js/modernizr-custom.js',[],false,false);
  wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.css');
	wp_enqueue_style( 'animate', get_template_directory_uri().'/css/animate.css');
  wp_enqueue_style( 'style', get_stylesheet_uri());
  wp_enqueue_script( 'jquery', false ,['json2'],false,false);
  // wp_enqueue_script( 'jquery-ui-draggable', false ,[],false,false);
  // wp_enqueue_script( 'jquery-ui-droppable', false ,[],false,false);
    // wp_enqueue_script( 'jquery_fullscreen_viewer', get_template_directory_uri().'/js/libs/fullscreen-viewer/jquery.fullscreen.viewer.js',[],false,true);
  wp_enqueue_script( 'jquery_postpage_fv', get_template_directory_uri().'/js/libs/fullscreen-viewer/jquery.postpage.fv.js',[],false,true);
  wp_localize_script('jquery_postpage_fv','COMMENT_SUBMIT_AJAX', array(
    'ajaxurl' => site_url( '/wp-comments-post.php' ),
    // 'security' => wp_create_nonce('palette_comment_submit'),
  ));
  wp_enqueue_script( 'comment-reply', false,[],false,true);
  //wp_enqueue_script('comment_submit_ajax',get_template_directory_uri().'/js/widgets/commentSubmitAjax.js',[],false,true);
  wp_enqueue_script( 'feature-detection', get_template_directory_uri().'/js/feature-detection.js',[],false,true);
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

 ?>
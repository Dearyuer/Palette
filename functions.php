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

add_action( 'wp_enqueue_scripts', function(){
  wp_enqueue_style( 'normalize', get_template_directory_uri().'/css/normalize.css');
	wp_enqueue_script( 'modernizr-custom', get_template_directory_uri().'/js/modernizr-custom.js',[],false,false);
  wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.css');
	wp_enqueue_style( 'animate', get_template_directory_uri().'/css/animate.css');
  wp_enqueue_style( 'style', get_stylesheet_uri());
  wp_enqueue_script( 'jquery', false ,['json2'],false,false);
  wp_enqueue_script( 'jquery-ui-draggable', false ,[],false,false);
  wp_enqueue_script( 'jquery-ui-droppable', false ,[],false,false);
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

add_action('after_setup_theme', function(){
	load_theme_textdomain( "palette", get_template_directory()."/languages" );
	add_theme_support('post-thumbnails');
	// add_theme_support('post-formats', array('aside', 'gallery', 'link'));
});

register_nav_menus(['nav' => __("Nav Menu", 'palette')]);

require_once(get_template_directory().'/app/widgets.php');

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
    $paletteOptionTransparence = "palette_transparence_toggle";

    //state

    $transparent_effect_state;

    //register
    global $palette_settings_cache;
    $palette_settings_cache->registerSetting($paletteOptionLogoImgSrc);
    $palette_settings_cache->registerSetting($paletteOptionLogoId);
    // $palette_settings_cache->registerSetting($paletteOptionParticle);
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
	
}

function mytheme_comment($comment, $args, $depth) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    <div class="comment-author vcard">
        <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
        <?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ); ?>
    </div>
    <?php if ( $comment->comment_approved == '0' ) : ?>
         <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
          <br />
    <?php endif; ?>

    <div class="comment-meta commentmetadata">
        <span>
        <?php
        /* translators: 1: date, 2: time */
        printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time() ); 
        ?>
        </span>

        <?php edit_comment_link( __( '(Edit)' ), '  ', '' );
        ?>
    </div>

    <?php comment_text(); ?>

    <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div>
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
    <?php
}



function palette_comment_form( $args = array(), $post_id = null ) {
    if ( null === $post_id )
        $post_id = get_the_ID();

    $commenter = wp_get_current_commenter();
    $user = wp_get_current_user();
    $user_identity = $user->exists() ? $user->display_name : '';

    $args = wp_parse_args( $args );
    if ( ! isset( $args['format'] ) )
        $args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html_req = ( $req ? " required='required'" : '' );
    $html5    = 'html5' === $args['format'];
    $fields   =  array(
        'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' /></p>',
        'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></p>',
        'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label> ' .
                    '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" /></p>',
    );

    $required_text = sprintf( ' ' . __('Required fields are marked %s'), '<span class="required">*</span>' );

    /**
     * Filter the default comment form fields.
     *
     * @since 3.0.0
     *
     * @param array $fields The default comment fields.
     */
    $fields = apply_filters( 'comment_form_default_fields', $fields );
    $defaults = array(
        'fields'               => $fields,
        'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" aria-required="true" required="required"></textarea></p>',
        /** This filter is documented in wp-includes/link-template.php */
        'must_log_in'          => '<p class="must-log-in">' . sprintf(
                                      /* translators: %s: login URL */
                                      __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
                                      wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) )
                                  ) . '</p>',
        /** This filter is documented in wp-includes/link-template.php */
        'logged_in_as'         => '<p class="logged-in-as">' . sprintf(
                                      /* translators: 1: edit user link, 2: accessibility text, 3: user name, 4: logout URL */
                                      __( '<a href="%1$s" aria-label="%2$s">Logged in as %3$s</a>. <a href="%4$s">Log out?</a>' ),
                                      get_edit_user_link(),
                                      /* translators: %s: user name */
                                      esc_attr( sprintf( __( 'Logged in as %s. Edit your profile.' ), $user_identity ) ),
                                      $user_identity,
                                      wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) )
                                  ) . '</p>',
        'comment_notes_before' => '<p class="comment-notes"><span id="email-notes">' . __( 'Your email address will not be published.' ) . '</span>'. ( $req ? $required_text : '' ) . '</p>',
        'comment_notes_after'  => '',
        'id_form'              => 'commentform',
        'id_submit'            => 'submit',
        'class_form'           => 'comment-form',
        'class_submit'         => 'submit',
        'name_submit'          => 'submit',
        'title_reply'          => __( 'Leave a Reply' ),
        'title_reply_to'       => __( 'Leave a Reply to %s' ),
        'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
        'title_reply_after'    => '</h3>',
        'cancel_reply_before'  => ' <small>',
        'cancel_reply_after'   => '</small>',
        'cancel_reply_link'    => __( 'Cancel reply' ),
        'label_submit'         => __( 'Post Comment' ),
        'submit_button'        => '<button id="submit">Submit</button>',//'<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
        'submit_field'         => '<p class="form-submit">%1$s %2$s</p>',
        'format'               => 'xhtml',
    );

    /**
     * Filter the comment form default arguments.
     *
     * Use 'comment_form_default_fields' to filter the comment fields.
     *
     * @since 3.0.0
     *
     * @param array $defaults The default comment form arguments.
     */
    $args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

    // Ensure that the filtered args contain all required default values.
    $args = array_merge( $defaults, $args );

    if ( comments_open( $post_id ) ) : ?>
        <?php
        /**
         * Fires before the comment form.
         *
         * @since 3.0.0
         */
        do_action( 'comment_form_before' );
        ?>
        <div id="respond" class="comment-respond">
            <?php
            echo $args['title_reply_before'];

            comment_form_title( $args['title_reply'], $args['title_reply_to'] );

            echo $args['cancel_reply_before'];

            cancel_comment_reply_link( $args['cancel_reply_link'] );

            echo $args['cancel_reply_after'];

            echo $args['title_reply_after'];

            if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) :
                echo $args['must_log_in'];
                /**
                 * Fires after the HTML-formatted 'must log in after' message in the comment form.
                 *
                 * @since 3.0.0
                 */
                do_action( 'comment_form_must_log_in_after' );
            else : ?>
                <form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" class="<?php echo esc_attr( $args['class_form'] ); ?>"<?php echo $html5 ? ' novalidate' : ''; ?>>
                    <?php
                    /**
                     * Fires at the top of the comment form, inside the form tag.
                     *
                     * @since 3.0.0
                     */
                    do_action( 'comment_form_top' );

                    if ( is_user_logged_in() ) :
                        /**
                         * Filter the 'logged in' message for the comment form for display.
                         *
                         * @since 3.0.0
                         *
                         * @param string $args_logged_in The logged-in-as HTML-formatted message.
                         * @param array  $commenter      An array containing the comment author's
                         *                               username, email, and URL.
                         * @param string $user_identity  If the commenter is a registered user,
                         *                               the display name, blank otherwise.
                         */
                        echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity );

                        /**
                         * Fires after the is_user_logged_in() check in the comment form.
                         *
                         * @since 3.0.0
                         *
                         * @param array  $commenter     An array containing the comment author's
                         *                              username, email, and URL.
                         * @param string $user_identity If the commenter is a registered user,
                         *                              the display name, blank otherwise.
                         */
                        do_action( 'comment_form_logged_in_after', $commenter, $user_identity );

                    else :

                        echo $args['comment_notes_before'];

                    endif;

                    // Prepare an array of all fields, including the textarea
                    $comment_fields = array( 'comment' => $args['comment_field'] ) + (array) $args['fields'];

                    /**
                     * Filter the comment form fields, including the textarea.
                     *
                     * @since 4.4.0
                     *
                     * @param array $comment_fields The comment fields.
                     */
                    $comment_fields = apply_filters( 'comment_form_fields', $comment_fields );

                    // Get an array of field names, excluding the textarea
                    $comment_field_keys = array_diff( array_keys( $comment_fields ), array( 'comment' ) );

                    // Get the first and the last field name, excluding the textarea
                    $first_field = reset( $comment_field_keys );
                    $last_field  = end( $comment_field_keys );

                    foreach ( $comment_fields as $name => $field ) {

                        if ( 'comment' === $name ) {

                            /**
                             * Filter the content of the comment textarea field for display.
                             *
                             * @since 3.0.0
                             *
                             * @param string $args_comment_field The content of the comment textarea field.
                             */
                            echo apply_filters( 'comment_form_field_comment', $field );

                            echo $args['comment_notes_after'];

                        } elseif ( ! is_user_logged_in() ) {

                            if ( $first_field === $name ) {
                                /**
                                 * Fires before the comment fields in the comment form, excluding the textarea.
                                 *
                                 * @since 3.0.0
                                 */
                                do_action( 'comment_form_before_fields' );
                            }

                            /**
                             * Filter a comment form field for display.
                             *
                             * The dynamic portion of the filter hook, `$name`, refers to the name
                             * of the comment form field. Such as 'author', 'email', or 'url'.
                             *
                             * @since 3.0.0
                             *
                             * @param string $field The HTML-formatted output of the comment form field.
                             */
                            echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";

                            if ( $last_field === $name ) {
                                /**
                                 * Fires after the comment fields in the comment form, excluding the textarea.
                                 *
                                 * @since 3.0.0
                                 */
                                do_action( 'comment_form_after_fields' );
                            }
                        }
                    }

                    $submit_button = $args['submit_button'];
                    // sprintf(
                    //     $args['submit_button'],
                    //     esc_attr( $args['name_submit'] ),
                    //     esc_attr( $args['id_submit'] ),
                    //     esc_attr( $args['class_submit'] ),
                    //     esc_attr( $args['label_submit'] )
                    // );

                    /**
                     * Filter the submit button for the comment form to display.
                     *
                     * @since 4.2.0
                     *
                     * @param string $submit_button HTML markup for the submit button.
                     * @param array  $args          Arguments passed to `comment_form()`.
                     */
                    $submit_button = apply_filters( 'comment_form_submit_button', $submit_button, $args );

                    $submit_field = sprintf(
                        $args['submit_field'],
                        $submit_button,
                        get_comment_id_fields( $post_id )
                    );

                    /**
                     * Filter the submit field for the comment form to display.
                     *
                     * The submit field includes the submit button, hidden fields for the
                     * comment form, and any wrapper markup.
                     *
                     * @since 4.2.0
                     *
                     * @param string $submit_field HTML markup for the submit field.
                     * @param array  $args         Arguments passed to comment_form().
                     */
                    echo apply_filters( 'comment_form_submit_field', $submit_field, $args );

                    /**
                     * Fires at the bottom of the comment form, inside the closing </form> tag.
                     *
                     * @since 1.5.0
                     *
                     * @param int $post_id The post ID.
                     */
                    do_action( 'comment_form', $post_id );
                    ?>
                </form>
            <?php endif; ?>
        </div><!-- #respond -->
        <?php
        /**
         * Fires after the comment form.
         *
         * @since 3.0.0
         */
        do_action( 'comment_form_after' );
    else :
        /**
         * Fires after the comment form if comments are closed.
         *
         * @since 3.0.0
         */
        do_action( 'comment_form_comments_closed' );
    endif;
}





add_action('wp_logout','go_home');
function go_home(){
  wp_redirect( home_url() );
  exit();
}









?>
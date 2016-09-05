<?php 

function handle_img_upload($name,$post_id,$option_id,$option_src){

    $submit = $name."_submit";
    $nonce = $name."_nonce";

    if( isset($_POST[$submit])  &&  check_admin_referer($name, $nonce) ){
        if (
            isset( $_POST[$nonce], $_POST[$post_id] )
            && current_user_can( 'manage_options' )
        ) {
            require_once( ABSPATH . 'wp-admin/includes/image.php' );
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
            require_once( ABSPATH . 'wp-admin/includes/media.php' );

            // Let WordPress handle the upload.
            // Remember, 'logo_image_upload' is the name of our file input in our form above.
            $attachment_id = media_handle_upload( $name, $_POST[$post_id] );
            if ( is_wp_error( $attachment_id ) ) { ?>
                <div class="notice notice-error">
                    <p><?php _e("There's an error while uploading","palette") ?></p>
                </div>
            <?php
            } else {
                if(isset($attachment_id)){
                    update_option($option_id,$attachment_id);
                    update_option($option_src, wp_get_attachment_image_src($attachment_id)[0]);
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
}



function palette_add_menu_page_fn() {
    if (!current_user_can('manage_options')){
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }
    $noChangesSaved = 0;
    $paletteOptionTransparence = "palette_transparence_toggle";

    $paletteOptionPrefix = 'palette_';
    $paletteOptionLogoImgSrc = $paletteOptionPrefix.'logo_image_src';
    $paletteOptionLogoId = $paletteOptionPrefix.'logo_id';
    $paletteOptionHomeLogoImgSrc = $paletteOptionPrefix.'home_logo_image_src';
    $paletteOptionHomeLogoId = $paletteOptionPrefix.'home_logo_id';
    //state

    $transparent_effect_state;

    //register
    global $palette_settings_cache;
    $palette_settings_cache->registerSetting($paletteOptionLogoImgSrc);
    $palette_settings_cache->registerSetting($paletteOptionLogoId);
    // $palette_settings_cache->registerSetting($paletteOptionParticle);
    $palette_settings_cache->registerSetting($paletteOptionTransparence);

    handle_img_upload('logo_image_upload','post_id',$paletteOptionLogoId,$paletteOptionLogoImgSrc);
    handle_img_upload('home_logo_image_upload', 'post_id', $paletteOptionHomeLogoId, $paletteOptionHomeLogoImgSrc);
   //&& wp_verify_nonce( $_POST['logo_image_upload_nonce'], 'logo_image_upload' )
    
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
        $pelettePrefix = "palette_";
        $api_data = [
            'twitter_api_key',
            'twitter_api_secret',
            'twitter_user_token',
            'twitter_user_secret',
            'github_username',
            'evernote_auth_token',
            //udemy
        ];
        for($i = 0;$i < count($api_data); $i++){
            if(isset($_POST[$api_data[$i]]) && !empty($_POST[$api_data[$i]])){
                update_option($pelettePrefix.$api_data[$i], $_POST[$api_data[$i]]);
                $noChangesSaved++;
            }
        }
        if($noChangesSaved == 0){
            echo '<div class="update-nag"> No changes saved. </div>';
        } else{
        echo '<div class="notice notice-success">'.__("Updated settings").'</div>';
        }

    }
    require_once(get_template_directory()."/app/wrapper/wrapper-main.php");
}
 ?>

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




function handle_img_form($name){
?>
    <input type="file" name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="inputfile" multiple="false" />
    <label for="<?php echo $name; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span><?php _e("Choose a file...", "palette") ?></span></label>
    <input type="hidden" name="post_id" value="0" />
    <?php wp_nonce_field( $name, $name.'_nonce'); ?>
    <input class="button button-primary" name="<?php echo $name.'_submit';?>" type="submit" value="Upload" />
<?php
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
    $paletteOptionAboutImgSrc = $paletteOptionPrefix.'about_avatar_image_src';
    $paletteOptionAboutImgId = $paletteOptionPrefix.'about_avatar_id';
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
    handle_img_upload('about_avatar_image_upload', 'post_id', $paletteOptionAboutImgId, $paletteOptionAboutImgSrc);
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

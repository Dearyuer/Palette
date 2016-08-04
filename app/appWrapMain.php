<div class="wrap">
	<h1><?php _e("Palette Theme Settings") ?></h1><hr/>
	<form method="post" action="" enctype="multipart/form-data">
		<table class="form-table">
		<tbody>
			<tr>
				<th><?php _e("Image for navigation bar logo.", "palette") ?></th>
				<th>
					<?php
					$retrieve_logo_attachment_id = get_option($paletteOptionLogoId);
					if(!empty($retrieve_logo_attachment_id)){
						echo "The current logo image is:".wp_get_attachment_image($retrieve_logo_attachment_id);
					}else{
						echo __("There's no Logo image uploaded. size 100*30 is recommended","palette");
					}
					 ?>
				</th>
				<td>
					<input type="file" name="logo_image_upload" id="logo_image_upload" class="inputfile" multiple="false" />
					<label for="logo_image_upload"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span><?php _e("Choose a file...", "palette") ?></span></label>
					<input type="hidden" name="post_id" value="0" />
					<?php wp_nonce_field( 'logo_image_upload', 'logo_image_upload_nonce'); ?>
					<input class="button button-primary" name="logo_image_upload_submit" type="submit" value="Upload" />
				</td>
			</tr>
			<tr>
				<th><?php _e("Enable particle effect","palette") ?></th>
				<th><?php _e("May end up with poor performance.","palette") ?></th>
				<td>

					<?php
					$retrieve_palette_particle_toggle = get_option($paletteOptionParticle);
					 ?>
					<input type="checkbox" id="particle_checkbox" name="particle_effect_checkbox"  value="particle" <?php if(!empty($retrieve_palette_particle_toggle)){ echo "checked"; }  ?>  />
					<label for="particle_checkbox"><?php _e("Enable/Disable particle effect.") ?></label>
				</td>
			</tr>
			<tr>
				<th><?php _e("Transparent panel", "palette"); ?></th>
				<th><?php _e("Brings high contrast while using background image", "palette"); ?></th>
				<td>
					<?php
					$retrieve_palette_transparence_toggle = get_option($paletteOptionTransparence);
					 ?>
					<input type="checkbox" id="panel_transparence" name="panel_transparence_checkbox" value="transparence" <?php if(!empty($retrieve_palette_transparence_toggle)){echo "checked"; }  ?> />
					<label for="panel_transparence"><?php _e("Enable/Disable transparent panel") ?></label>
				</td>
			</tr>


		</tbody>
		</table>
		<?php wp_nonce_field( 'palette_settings_submit', 'palette_settings_submit_nonce'); ?>
		<input class="button button-primary" type="submit" name="palette_settings_submit" value="Submit" />
	<form>
</div>
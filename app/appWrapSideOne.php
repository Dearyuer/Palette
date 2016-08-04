<div class="wrap">
	<h1><?php _e("Palette particles effect settings") ?></h1><hr/>
	<form method="post" action="" enctype="multipart/form-data">
		<table class="form-table">
			<tbody>
				<?php //Particles ?>
				<tr>
					<th><?php _e("Number of particles") ?></th>
					<td>
						<?php echo handleParticleLoopArr($particle_settings,$particle_default,"number",0,null,1,null,null,null); ?>
					</td>
				</tr>
				<tr>
					<th><?php _e("Enable density") ?></th>
					<td>
						<?php echo handleParticleLoopArr2($particle_settings,"density"); ?>
					</td>
				</tr>
				<tr>
					<th><?php 
					// enable only when density is enabled
					_e("Density area");

					?></th>
					<td>
						<?php echo handleParticleLoopArr($particle_settings,$particle_default,"density_area",0,null,100,null,true,"density"); ?>
					</td>
				</tr>

				<?php //Color ?>


				<tr>
					<th><?php _e("Particles color") ?></th>
					<td>
						<?php echo handleParticleLoopArr($particle_settings,$particle_default,"color",null,null,null,true,null,null); ?>
					</td>
				</tr>


				<?php //Shape ?>


				<tr>
					<th><?php _e("Shape of particles") ?></th>
					<td>

						<fieldset>
						 	<?php //at least one option ?>
						 	<?php $retrieve_palette_shape_var = get_option($particle_settings["shape"]);
						 		$retrieve_palette_shape = !empty($retrieve_palette_shape_var) ? $retrieve_palette_shape_var : array("circle");?>
							<input type="checkbox" id="palette-circle" name="particle_shape[]" value="circle" <?php if(!is_bool(array_search('circle', $retrieve_palette_shape))){echo "checked";} ?> >
							<label for="palette-circle">Circle</label>

							<input type="checkbox" id="palette-edge" name="particle_shape[]" value="edge" <?php if(!is_bool(array_search('edge', $retrieve_palette_shape))){echo "checked";} ?>>
							<label for="palette-edge">Edge</label>

							<input type="checkbox" id="palette-tri" name="particle_shape[]" value="triangle" <?php if(!is_bool(array_search('triangle', $retrieve_palette_shape))){echo "checked";} ?>>
							<label for="palette-tri">Triangle</label>

							<input type="checkbox" id="palette-pol" name="particle_shape[]" value="polygon" <?php if(!is_bool(array_search('polygon', $retrieve_palette_shape))){echo "checked";} ?>>
							<label for="palette-pol">Polygon</label>

							<input type="checkbox" id="palette-star" name="particle_shape[]" value="star" <?php if(!is_bool(array_search('star', $retrieve_palette_shape))){echo "checked";} ?>>
							<label for="palette-star">Star</label>

							<input type="checkbox" id="palette-img" name="particle_shape[]" value="image" <?php if(!is_bool(array_search('image', $retrieve_palette_shape))){echo "checked";} ?>>
							<label for="palette-img">Image</label>
						</fieldset>
					</td>
				<tr>
				<tr>
					<th><?php _e("Shape stroke width") ?></th>
					<td>
						<?php echo handleParticleLoopArr($particle_settings,$particle_default,"stroke_width",0,null,1,null,null,null); ?>
					</td>
				</tr>
				<tr>
					<th><?php _e("Shape stroke color") ?></th>
					<td>
						<?php echo handleParticleLoopArr($particle_settings,$particle_default,"stroke_color",null,null,null,true,null,null); ?>
					</td>
				</tr>
				<tr>
					<th><?php _e("Number of sides of polygon") ?></th>
					<td>
						<?php echo handleParticleLoopArr($particle_settings,$particle_default,"polygon_sides",1,null,1,null,null,null); ?>
					</td>
				</tr>
				<tr>
					<th><?php _e("Particle image") ?></th>
					<td>
						<input type="file"  name="particle_image" id="particle_image_upload" class="inputfile" multiple="false" />
						<label for="particle_image_upload"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span><?php _e("Choose a file...", "palette") ?></span></label>
						<input type="hidden" name="post_id" value="0" />
						<?php wp_nonce_field( 'particle_image', 'particle_image_nonce'); ?>
						<input class="button button-primary " name="particle_image_submit" type="submit" value="Upload" />
					</td>
				</tr>
				<tr>
					<th><?php _e("Width of the image") ?></th>
					<td>
						<?php echo handleParticleLoopArr($particle_settings,$particle_default,"image_width",0,null,50,null,null,null); ?>
					</td>
				</tr>
				<tr>
					<th><?php _e("Height of the image") ?></th>
					<td>
						<?php echo handleParticleLoopArr($particle_settings,$particle_default,"image_height",0,null,50,null,null,null); ?>
					</td>
				</tr>



				<?php //Opacity ?>



				<tr>
					<th><?php _e("Opacity value") ?></th>
					<td>
						
						<?php echo handleParticleLoopArr($particle_settings,$particle_default,"opacity_value",0,1,0.1,null,null,null); ?>
					</td>
				</tr>
				<tr>
					<th><?php _e("Random opacity") ?></th>
					<td>
						<?php echo handleParticleLoopArr2($particle_settings,"random_opacity"); ?>
					</td>
				</tr>
				<tr>
					<th><?php _e("Opacity animation") ?></th>
					<td>
						<?php echo handleParticleLoopArr3($particle_settings,"opacity_animation"); ?>
					</td>
				</tr>

				<tr>
					<th><?php _e("Opacity animation speed") ?></th>
					<td>
						
						<?php echo handleParticleLoopArr($particle_settings,$particle_default,"opacity_animation_speed",0,null,1,null,null,null); ?>
					</td>
				</tr>
				<tr>
					<th><?php _e("Minimum animation opacity") ?></th>
					<td>
						
					<?php echo handleParticleLoopArr($particle_settings,$particle_default,"minimum_animation_opacity",0,1,0.1,null,null,null); ?>
					</td>
				</tr>
				<tr>
					<th><?php _e("Synchronized opacity animation") ?></th>
					<td>
						<?php echo handleParticleLoopArr3($particle_settings,"sync_opacity_anim"); ?>
					</td>
				</tr>



				<?php //Size ?>


				<tr>
					<th><?php _e("Size value") ?></th>
					<td>
						
						<?php echo handleParticleLoopArr($particle_settings,$particle_default,"size_value",0,null,1,null,null,null); ?>
					</td>
				</tr>
				<tr>
					<th><?php _e("Random size") ?></th>
					<td>
						<?php echo handleParticleLoopArr2($particle_settings,"random_size"); ?>
					</td>
				</tr>
				<tr>
					<th><?php _e("Size animation") ?></th>
					<td>
						<?php echo handleParticleLoopArr3($particle_settings,"size_animation"); ?>
					</td>
				</tr>

				<tr>
					<th><?php _e("Size animation speed") ?></th>
					<td>
						<?php echo handleParticleLoopArr($particle_settings,$particle_default,"size_animation_speed",0,null,1,null,null,null); ?>
					</td>
				</tr>
				<tr>
					<th><?php _e("Minimum animation size") ?></th>
					<td>
						<?php echo handleParticleLoopArr($particle_settings,$particle_default,"minimum_animation_size",0,1,0.1,null,null,null); ?>
					</td>
				</tr>
				<tr>
					<th><?php _e("Synchronized size animation") ?></th>
					<td>
						<?php echo handleParticleLoopArr3($particle_settings,"sync_size_anim"); ?>
					</td>
				</tr>


				<?php //Line linked ?>

				<tr>
					<th><?php _e("Enable/Disable line-linked") ?></th>
					<td>
						<?php echo handleParticleLoopArr2($particle_settings,"line_linked"); ?>
					</td>
				</tr>
				<tr>
					<th><?php _e("Distance of linked line") ?></th>
					<td>
						<?php echo handleParticleLoopArr($particle_settings,$particle_default,"linked_line_distance",0,null,50,null,null,null); ?>
					</td>
				</tr>
				<tr>
					<th><?php _e("Color of linked line") ?></th>
					<td>
						<?php echo handleParticleLoopArr($particle_settings,$particle_default,"linked_line_color",null,null,null,true,null,null); ?>
					</td>
				</tr>
				<tr>
					<th><?php _e("Opacity of linked line") ?></th>
					<td>
						<?php echo handleParticleLoopArr($particle_settings,$particle_default,"linked_line_opacity",0,null,0.1,null,null,null); ?>
					</td>
				</tr>
				<tr>
					<th><?php _e("Width of linked line") ?></th>
					<td>
						<?php echo handleParticleLoopArr($particle_settings,$particle_default,"linked_line_width",0,null,1,null,null,null); ?>
					</td>
				</tr>

				<?php //Move ?>
				<tr>
					<th><?php _e("Enable/Disable Move") ?></th>
					<td>
						<?php echo handleParticleLoopArr2($particle_settings,"move"); ?>
					</td>
				</tr>
				<tr>
					<th><?php _e("Move speed") ?></th>
					<td>
						<?php echo handleParticleLoopArr($particle_settings,$particle_default,"move_speed",0,null,1,null,null,null); ?>
					</td>
				</tr>
				<tr>
					<th><?php _e("Move direction") ?></th>
					<td>
						<?php 
							$retrieve_palette_move_direction = get_option($particle_settings["move_direction"]);

						?>
						<select name="palette_move_direction">
							<option value="none" <?php if($retrieve_palette_move_direction){if($retrieve_palette_move_direction == "none"){echo "selected";}} ?>><?php _e("No precise direction")?></option>
							<option value="top" <?php if($retrieve_palette_move_direction){if($retrieve_palette_move_direction == "top"){echo "selected";}} ?>><?php _e("Towards top")?></option>
							<option value="top-right" <?php if($retrieve_palette_move_direction){if($retrieve_palette_move_direction == "top-right"){echo "selected";}} ?>><?php _e("Towards top right")?></option>
							<option value="right" <?php if($retrieve_palette_move_direction){if($retrieve_palette_move_direction == "right"){echo "selected";}} ?>><?php _e("Towards right")?></option>
							<option value="bottom-right" <?php if($retrieve_palette_move_direction){if($retrieve_palette_move_direction == "bottom-right"){echo "selected";}} ?>><?php _e("Towards bottom right")?></option>
							<option value="bottom" <?php if($retrieve_palette_move_direction){if($retrieve_palette_move_direction == "bottom"){echo "selected";}} ?>><?php _e("Towards bottom")?></option>
							<option value="bottom-left" <?php if($retrieve_palette_move_direction){if($retrieve_palette_move_direction == "bottom-left"){echo "selected";}} ?>><?php _e("Towards bottom left")?></option>
							<option value="left" <?php if($retrieve_palette_move_direction){if($retrieve_palette_move_direction == "left"){echo "selected";}} ?>><?php _e("Towards left")?></option>
							<option value="top-left" <?php if($retrieve_palette_move_direction){if($retrieve_palette_move_direction == "top-left"){echo "selected";}} ?>><?php _e("Towards top left")?></option>
						</select>
					</td>
				</tr>
				<tr>
					<th><?php _e("Random move") ?></th>
					<td>
						<?php echo handleParticleLoopArr3($particle_settings,"random_move"); ?>
					</td>
				</tr>
				<tr>
					<th><?php _e("Straight move") ?></th>
					<td>
						<?php echo handleParticleLoopArr3($particle_settings,"straight_move"); ?>
					</td>
				</tr>
				<tr>
					<th><?php _e("Out mode") ?></th>
					<td>
						<?php
							$retrieve_palette_out_mode = get_option($particle_settings["out_mode"]);
						?>
						<fieldset>
							<input name="palette_out_mode" type="radio" id="out-mode-out" value="out"  <?php if($retrieve_palette_out_mode){if($retrieve_palette_out_mode == "out"){echo "checked";}}else{ echo "checked";} ?>>
							<label for="out-mode-out"><?php _e("Out") ?></label>
							<input name="palette_out_mode" type="radio" id="out-mode-bounce" value="bounce" <?php if($retrieve_palette_out_mode){if($retrieve_palette_out_mode == "bounce"){echo "checked";}} ?>>
							<label for="out-mode-bounce"><?php _e("Bounce") ?></label>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th><?php _e("Attract adjacent particles") ?></th>
					<td>
						<?php echo handleParticleLoopArr3($particle_settings,"attract_adjacent"); ?>
					</td>
				</tr>
				<tr>
					<th><?php _e("Attraction influence offset rotateX") ?></th>
					<td>
						<?php echo handleParticleLoopArr($particle_settings,$particle_default,"offset_rotate_x",0,null,100,null,null,null); ?>
					</td>
				</tr>
				<tr>
					<th><?php _e("Attraction influence offset rotateY") ?></th>
					<td>
						<?php echo handleParticleLoopArr($particle_settings,$particle_default,"offset_rotate_y",0,null,100,null,null,null); ?>
					</td>
				</tr>


				<?php // interactivity ?>

				<tr>
					<th><?php _e("Detect on which context") ?></th>
					<td>
						<?php
							$retrieve_palette_detect_context = get_option($particle_settings["detect_context"]);
						?>
						<fieldset>
							<input type="radio" value="canvas" name="palette_detect_context" <?php if($retrieve_palette_detect_context){if($retrieve_palette_detect_context == "canvas"){echo "checked";}}else{ echo "checked";} ?>/>
							<label for="particle-detect-context">Canvas</label>
							<input type="radio" value="window" name="palette_detect_context" <?php if($retrieve_palette_detect_context){if($retrieve_palette_detect_context == "window"){echo "checked";}} ?>/>
							<label for="particle-detect-context">Window</label>
						</fieldset>
						<p><?php _e("Be sure never selecting Window option only when you are using a single page layout") ?></p>
					</td>
				</tr>

				<tr>
					<th><?php _e("Enable/Disable hover effect") ?></th>
					<td>
						<?php echo handleParticleLoopArr3($particle_settings,"hover_effect"); ?>
					</td>
				</tr>
				<tr>
					<th><?php _e("Hover effect mode") ?></th>
					<td>
						<fieldset>
							<?php $retrieve_palette_hover_mode_var = get_option($particle_settings["hover_effect_mode"]);
							$retrieve_palette_hover_mode = !empty($retrieve_palette_hover_mode_var) ? $retrieve_palette_hover_mode_var : array("grab");?>
							<input type="checkbox" name="palette_hover_effect[]" id="particle-hover-effect1" value="grab" <?php if(!is_bool(array_search('grab', $retrieve_palette_hover_mode))){echo "checked";} ?>/>
							<label for="particle-hover-effect1">Link</label>
							<input type="checkbox" name="palette_hover_effect[]" id="particle-hover-effect2" value="repulse" <?php if(!is_bool(array_search('repulse', $retrieve_palette_hover_mode))){echo "checked";} ?>/>
							<label for="particle-hover-effect2">Repulse</label>
						</fieldset>
					</td>
				</tr>

				<tr>
					<th><?php _e("Enable/Disable click effect") ?></th>
					<td>
						<?php echo handleParticleLoopArr3($particle_settings,"click_effect"); ?>
					</td>
				</tr>
				<tr>
					<th><?php _e("Click effect mode") ?></th>
					<td>
						<fieldset>
							<?php $retrieve_palette_click_mode = get_option($particle_settings["click_effect_mode"]);
							?>
							<input type="radio" name="palette_click_effect" id="particle-click-effect1" value="push" <?php if($retrieve_palette_click_mode){if($retrieve_palette_click_mode == "push"){echo "checked";}}else{ echo "checked";} ?> />
							<label for="particle-click-effect1">Push</label>
							<input type="radio" name="palette_click_effect" id="particle-click-effect2" value="remove" <?php if($retrieve_palette_click_mode){if($retrieve_palette_click_mode == "remove"){echo "checked";}} ?> />
							<label for="particle-click-effect2">Remove</label>
							<input type="radio" name="palette_click_effect" id="particle-click-effect3" value="repulse" <?php if($retrieve_palette_click_mode){if($retrieve_palette_click_mode == "repulse"){echo "checked";}} ?> />
							<label for="particle-click-effect3">Repulse</label>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th>Modes</th>
				</tr>
				<tr>
					<th>[Link]  Link distance</th>
					<td>
					
						<?php echo handleParticleLoopArr($particle_settings,$particle_default,"linked_line_dis_inter",0,null,50,null,null,null); ?>
					</td>
				</tr>
				<tr>
					<th>[Link]  Linked line opacity</th>
					<td>
						
						<?php echo handleParticleLoopArr($particle_settings,$particle_default,"linked_line_opacity_inter",0,null,0.1,null,null,null); ?>
					</td>
				</tr>
				<tr>
					<th>[Push]  Number of particles to push</th>
					<td>
					
						<?php echo handleParticleLoopArr($particle_settings,$particle_default,"push_number",0,null,1,null,null,null); ?>
					</td>
				</tr>
				<tr>
					<th>[Remove]  Number of particles to remove</th>
					<td>
				
						<?php echo handleParticleLoopArr($particle_settings,$particle_default,"remove_number",0,null,1,null,null,null); ?>
					</td>
				</tr>
				<tr>
					<th>[Repulse]  Repulse distance</th>
					<td>
						<?php echo handleParticleLoopArr($particle_settings,$particle_default,"repulse_number",0,null,50,null,null,null); ?>
					</td>
				</tr>
			</tbody>
		</table>
		<?php wp_nonce_field( 'palette_particle_effect_submit', 'palette_particle_effect_submit_nonce'); ?>
		<input type="submit" class="button button-primary" name="palette_particle_effect_submit" value="Submit" />
	</form>
</div>
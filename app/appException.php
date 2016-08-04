<?php

if( isset($_POST["particle_shape"])){
	$getParticleShape = get_option($particle_settings["shape"]);
	
	if($getParticleShape != $_POST["particle_shape"] ){
		update_option($particle_settings["shape"], $_POST["particle_shape"]);
		$noChangesSaved++;
	}
}else{
	echo '<p class="update-nag">'.__('Select at least one option in order to make sense').'</p>';
	$noChangesSaved = -1;
}

if( isset($_POST["palette_hover_effect"])){
	$getParticleHoverEffect = get_option($particle_settings["hover_effect_mode"]);
	
	if($getParticleHoverEffect != $_POST["palette_hover_effect"] ){
		update_option($particle_settings["hover_effect_mode"], $_POST["palette_hover_effect"]);
		$noChangesSaved++;
	}
}else{
	echo '<p class="update-nag">'.__('Select at least one option in order to make sense').'</p>';
	$noChangesSaved = -1;
}

if( isset($_POST["palette_click_effect"])){
	$getParticleClickEffect = get_option($particle_settings["click_effect_mode"]);

	if(empty($getParticleClickEffect) || $getParticleClickEffect != $_POST["palette_click_effect"] ){
		update_option($particle_settings["click_effect_mode"],$_POST["palette_click_effect"]);
		$noChangesSaved++;
	}
}


if( isset($_POST["palette_move_direction"])){
	$getParticleMoveDirection = get_option($particle_settings["move_direction"]);

	if(empty($getParticleMoveDirection) || $getParticleMoveDirection != $_POST["palette_move_direction"] ){
		update_option($particle_settings["move_direction"],$_POST["palette_move_direction"]);
		$noChangesSaved++;
	}
}

if( isset($_POST["palette_out_mode"])){
	$getParticleOutMode = get_option($particle_settings["out_mode"]);

	if(empty($getParticleOutMode) || $getParticleOutMode != $_POST["palette_out_mode"] ){
		update_option($particle_settings["out_mode"],$_POST["palette_out_mode"]);
		$noChangesSaved++;
	}
}

if( isset($_POST["palette_detect_context"])){
	$getParticleDetectContext = get_option($particle_settings["detect_context"]);

	if(empty($getParticleDetectContext) || $getParticleDetectContext != $_POST["palette_detect_context"] ){
		update_option($particle_settings["detect_context"],$_POST["palette_detect_context"]);
		$noChangesSaved++;
	}
}

?>
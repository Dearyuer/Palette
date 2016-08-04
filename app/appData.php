<?php 
	$sPrefix = "palette_particle_";
	$particle_settings = array(
		//exception		
		"image_id" 					=> $sPrefix . "image_id",
		"image_src" 				=> $sPrefix . "image_src",

		//Arr1
		"number" 					=> $sPrefix . "number",
		"color" 					=> $sPrefix . "color",
		"density_area" 				=> $sPrefix . "density_area",
		// --
		"stroke_width"				=> $sPrefix . "stroke_width",
		"stroke_color" 				=> $sPrefix . "stroke_color",
		"polygon_sides" 			=> $sPrefix . "polygon_sides",
		// --
		"image_width" 				=> $sPrefix . "image_width",
		"image_height"				=> $sPrefix . "image_height",
		"opacity_value" 			=> $sPrefix . "opacity_value",
		"opacity_animation_speed"   => $sPrefix . "opacity_animation_speed",
		"minimum_animation_opacity" => $sPrefix . "minimum_animation_opacity",
		"size_value" 				=> $sPrefix . "size_value",
		"size_animation_speed"   	=> $sPrefix . "size_animation_speed",
		"minimum_animation_size" 	=> $sPrefix . "minimum_animation_size",
		"linked_line_distance" 		=> $sPrefix . "linked_line_distance",
		// --
		"linked_line_color"			=> $sPrefix . "linked_line_color",
		"linked_line_opacity"		=> $sPrefix . "linked_line_opacity",
		"linked_line_width"			=> $sPrefix . "linked_line_width",
		"move_speed"				=> $sPrefix . "move_speed",
		"offset_rotate_x"			=> $sPrefix . "offset_rotate_x",
		"offset_rotate_y"			=> $sPrefix . "offset_rotate_y",
		"linked_line_dis_inter"		=> $sPrefix . "linked_line_dis_inter",
		"linked_line_opacity_inter"	=> $sPrefix . "linked_line_opacity_inter",
		"push_number"				=> $sPrefix . "push_number",
		"remove_number"				=> $sPrefix . "remove_number",
		"repulse_number"			=> $sPrefix . "repulse_number",
		// --

		//Arr2

		"density" 					=> $sPrefix . "density",
		"random_opacity"			=> $sPrefix . "random_opacity",
		"random_size"				=> $sPrefix . "random_size",
		"line_linked"				=> $sPrefix . "line_linked",
		"move"						=> $sPrefix . "move",

		//Arr 3

		"opacity_animation"			=> $sPrefix . "opacity_animation",
		"sync_opacity_anim"			=> $sPrefix . "sync_opacity_anim",
		"size_animation"			=> $sPrefix . "size_animation",
		"sync_size_anim"			=> $sPrefix . "sync_size_anim",
		"random_move"				=> $sPrefix . "random_move",
		"straight_move"				=> $sPrefix . "straight_move",
		"attract_adjacent"			=> $sPrefix . "attract_adjacent",
		"hover_effect"				=> $sPrefix . "hover_effect",
		"click_effect"				=> $sPrefix . "click_effect",

		//Exception
		"shape" 					=> $sPrefix . "shape",
		"hover_effect_mode" 		=> $sPrefix . "hover_effect_mode",
		"click_effect_mode" 		=> $sPrefix . "click_effect_mode",

		"move_direction" 			=> $sPrefix . "move_direction",
		"out_mode" 					=> $sPrefix . "out_mode",
		"detect_context" 			=> $sPrefix . "detect_context",


	);
	$particleLoopArr = array(

		$particle_settings["number"],
		$particle_settings["density_area"],
		$particle_settings["color"],
		// --
		$particle_settings["stroke_width"],
		$particle_settings["stroke_color"],
		$particle_settings["polygon_sides"],
		// --
		$particle_settings["image_width"],
		$particle_settings["image_height"],
		$particle_settings["opacity_value"],
		$particle_settings["opacity_animation_speed"],
		$particle_settings["minimum_animation_opacity"],
		$particle_settings["size_value"],
		$particle_settings["size_animation_speed"],
		$particle_settings["minimum_animation_size"],
		$particle_settings["linked_line_distance"],
		// --
		$particle_settings["linked_line_color"],
		$particle_settings["linked_line_opacity"],
		$particle_settings["linked_line_width"],
		$particle_settings["move_speed"],
		$particle_settings["offset_rotate_x"],
		$particle_settings["offset_rotate_y"],
		$particle_settings["linked_line_dis_inter"],
		$particle_settings["linked_line_opacity_inter"],
		$particle_settings["push_number"],
		$particle_settings["remove_number"],
		$particle_settings["repulse_number"],


	);
	$particleLoopArr2 = array(

		$particle_settings['density'],
		$particle_settings['random_opacity'],
		$particle_settings['random_size'],
		$particle_settings['line_linked'],
		$particle_settings['move'],

	);
	$particleLoopArr3 = array(
		$particle_settings['opacity_animation'],
		$particle_settings['sync_opacity_anim'],
		$particle_settings['size_animation'],
		$particle_settings['sync_size_anim'],
		$particle_settings['random_move'],
		$particle_settings['straight_move'],
		$particle_settings['attract_adjacent'],
		$particle_settings['hover_effect'],
		$particle_settings['click_effect'],
	);
	$particle_default = array(
		$particle_settings["number"] 						=> 13,
		$particle_settings["density"] 						=> 1,
		$particle_settings["density_area"]   				=> 800,
		$particle_settings["color"] 						=> "#666666",
		$particle_settings["shape"] 						=> array("circle"),
		$particle_settings["stroke_width"]   				=> 0,
		$particle_settings["stroke_color"]   				=> "#000000",
		$particle_settings["polygon_sides"]  				=> 5,

		$particle_settings["image_id"] 						=> null,//*
		$particle_settings["image_src"] 					=> null,//*

		$particle_settings["image_width"]    				=> 100,
		$particle_settings["image_height"]   				=> 100,
		$particle_settings["opacity_value"]	 				=> 0.5,
		$particle_settings['random_opacity']				=> 1,
		$particle_settings['opacity_animation']				=> 0,
		$particle_settings["opacity_animation_speed"] 		=> 1,
		$particle_settings["minimum_animation_opacity"] 	=> 0.1,
		$particle_settings['sync_opacity_anim']				=> 0,
		$particle_settings["size_value"] 					=> 5,
		$particle_settings['random_size']					=> 1,
		$particle_settings['size_animation']				=> 0,
		$particle_settings["size_animation_speed"] 			=> 40,
		$particle_settings["minimum_animation_size"] 		=> 0.1,
		$particle_settings['sync_size_anim']				=> 0,
		$particle_settings['line_linked']					=> 1,
		$particle_settings["linked_line_distance"] 			=> 150,

		$particle_settings["linked_line_color"]				=> "#666666",
		$particle_settings["linked_line_opacity"]			=> 0.4,
		$particle_settings["linked_line_width"]				=> 1,
		$particle_settings['move']							=> 1,
		$particle_settings["move_speed"]					=> 6,
		$particle_settings["move_direction"]				=> "none",
		$particle_settings['random_move']					=> 0,
		$particle_settings['straight_move']					=> 0,
		$particle_settings['out_mode']						=> "out",
		$particle_settings['attract_adjacent']				=> 0,
		$particle_settings["offset_rotate_x"]				=> 600,
		$particle_settings["offset_rotate_y"]				=> 1200,
		$particle_settings["detect_context"]				=> "canvas",
		$particle_settings['hover_effect']					=> 0,
		$particle_settings['hover_effect_mode']				=> array("grab"),
		$particle_settings['click_effect']					=> 0,
		$particle_settings['click_effect_mode']				=> array("push"),
		$particle_settings["linked_line_dis_inter"]			=> 200,
		$particle_settings["linked_line_opacity_inter"]		=> 0.5,
		$particle_settings["push_number"]					=> 40,
		$particle_settings["remove_number"]					=> 2,
		$particle_settings["repulse_number"]				=> 200,
	);
 ?>
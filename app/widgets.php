<?php 
require_once get_template_directory().'/app/widgets/evernote.php';
require_once get_template_directory().'/app/widgets/profile.php';
require_once get_template_directory().'/app/widgets/twitter.php';
require_once get_template_directory().'/app/widgets/recent-posts.php';
require_once get_template_directory().'/app/widgets/recent-comments.php';

add_action( 'widgets_init', function(){
	register_widget( 'Palette_Evernote_Widget' );
	register_widget( 'Palette_Profile_Widget' );
	register_widget( 'Palette_Twitter_Widget' );
	register_widget( 'Palette_Recent_Posts_Widget' );
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
 ?>
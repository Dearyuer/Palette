<?php 
require_once get_template_directory().'/app/widgets/evernote.php';
require_once get_template_directory().'/app/widgets/profile.php';
require_once get_template_directory().'/app/widgets/twitter.php';
require_once get_template_directory().'/app/widgets/recent-posts.php';
require_once get_template_directory().'/app/widgets/recent-comments.php';
// Home page
// require_once get_template_directory().'/app/widgets/home-evernote.php';
// require_once get_template_directory().'/app/widgets/home-twitter.php';

// Activity page
require_once get_template_directory().'/app/widgets/activity-codewars.php';
require_once get_template_directory().'/app/widgets/activity-udemy.php';
require_once get_template_directory().'/app/widgets/activity-steam.php';




add_action( 'widgets_init', function(){
	register_widget( 'Palette_Evernote_Widget' );
	register_widget( 'Palette_Profile_Widget' );
	register_widget( 'Palette_Twitter_Widget' );
	register_widget( 'Palette_Recent_Posts_Widget' );
	register_widget( 'Palette_Comments_Widget' );

    // register_widget( 'Palette_Home_Evernote_Widget' );
    // register_widget( 'Palette_Home_Twitter_Widget' );

    register_widget( 'Palette_Activity_Codewars_Widget');
    /*
     * Register Blog sidebar
     */
	register_sidebar([
		'name'          => __( 'Sidebar'),
		'id'            => 'sidebar',
		'before_widget' => '<div class="sidebar-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>'
	]);
    /*
     * Register Home component
     */
    // register_sidebar([
    //     'id' => 'home_page',
    //     'name' => __('Home Page'),
    //     'description' => 'Add widget to home page',
    //     'before_widget' => '<div class="home-component">',
    //     'after_widget' => '</div>',
    //     'before_title' => '<div class="component-title"><p>',
    //     'after_title' => '</p></div>',
    // ]);

    /*
     *
     */
    register_sidebar([
        'id' => 'activity_page',
        'name' => __('Activity Page'),
        'description' => 'Add widget to activity page',
        'before_widget' => '<div class="activity-component">',
        'after_widget' => '</div>',
        'before_title' => '<div class="component-title"><p>',
        'after_title' => '</p></div>',
    ]);


});
//add_action( 'widgets_init', create_function( '', "register_widget( 'Palette_Activity_Codewars_Widget' );" ) );
 ?>
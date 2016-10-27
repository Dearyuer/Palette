<?php 
/**
 * new WordPress Widget format
 * Wordpress 2.8 and above
 * @see http://codex.wordpress.org/Widgets_API#Developing_Widgets
 */
class Palette_Activity_Codewars_Widget extends WP_Widget {

    /**
     * Constructor
     *
     * @return void
     **/
    // function Palette_Activity_Codewars_Widget() {
    //     $widget_ops = array( 'classname' => 'CSS class name', 'description' => 'Description' );
    //     $this->WP_Widget( 'CSS class name', 'Title', $widget_ops );
    // }

    function __construct() {
    	parent::__construct(
    		'palette_activity_codewars_widget',
    		__('Palette Activity Codewars', 'palette'),
    		array( 'description' => __('Codewars activity', 'palette')
    		));
    }
    /**
     * Outputs the HTML for this widget.
     *
     * @param array  An array of standard parameters for widgets in this theme
     * @param array  An array of settings for this widget instance
     * @return void Echoes it's output
     **/
    function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );
        echo $before_widget;
        echo $before_title;
        echo 'Title'; // Can set this with a widget option, or omit altogether
                echo '<div class="activity-component">
                        <div class="activity-title">
                        </div>
                        <div class="activity-content">
                                
                        </div>
                    </div>';
        echo $after_title;


    //
    // Widget display logic goes here
    //

    echo $after_widget;
    }

    /**
     * Deals with the settings when they are saved by the admin. Here is
     * where any validation should be dealt with.
     *
     * @param array  An array of new settings as submitted by the admin
     * @param array  An array of the previous settings
     * @return array The validated and (if necessary) amended settings
     **/
    function update( $new_instance, $old_instance ) {

        // update logic goes here
        $updated_instance = $new_instance;
        return $updated_instance;
    }

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array  An array of the current settings for this widget
     * @return void Echoes it's output
     **/
    function form( $instance ) {
        // $instance = wp_parse_args( (array) $instance, array( array of option_name => value pairs ) );

        // display field names here using:
        // $this->get_field_id( 'option_name' ) - the CSS ID
        // $this->get_field_name( 'option_name' ) - the HTML name
        // $instance['option_name'] - the option value
    }
}


 ?>
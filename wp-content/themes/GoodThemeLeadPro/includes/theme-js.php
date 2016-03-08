<?php
if (!is_admin()) add_action( 'wp_print_scripts', 'woothemes_add_javascript' );
function woothemes_add_javascript( ) {
wp_enqueue_script('jquery');
wp_enqueue_script('scripts', get_bloginfo('template_directory').'/includes/js/scripts.js', array( 'jquery' ) );
wp_enqueue_script('gtt_tabs', get_bloginfo('template_directory').'/includes/js/gtt_tabs.js', array( 'jquery' ) );
    if(is_home()){
        wp_enqueue_script('slider', get_bloginfo('template_directory').'/includes/js/slider.js', array( 'jquery' ) );
    }
}
?>
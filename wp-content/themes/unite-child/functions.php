<?php

/* Ninja Theme.
 *
 * v1.0.
 */


// include "includes/custom-post-type/event.php";
// include "includes/custom-meta-box/events-meta-box.php";

include "includes/custom-post-type/reservation.php";

function fisa_admin_styles_and_scripts($hook){
    /**
     * Add The script on post.php and post-new.php only.
     */
    if(('post-new.php' == $hook || 'post.php' == $hook )){
        wp_enqueue_style("eventlist-datetimepicker-css", get_stylesheet_directory_uri()."/library/datetimepicker/jquery.datetimepicker.css");
        wp_enqueue_script("eveentlist-datetimepicker-js", get_stylesheet_directory_uri()."/library/datetimepicker/jquery.datetimepicker.full.js", array("jquery"));
        wp_enqueue_script("eveentlist-datefrom-and-to-js", get_stylesheet_directory_uri()."/library/datetimepicker/datefrom-dateto.js", array("jquery"));
    }
}
add_action('admin_enqueue_scripts','fisa_admin_styles_and_scripts');


add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function theme_enqueue_styles()
{
    $parent_style = 'parent-style';

    wp_enqueue_style($parent_style, get_bloginfo('template_directory') . '/style.css');
    wp_enqueue_style('child-style', get_bloginfo('stylesheet_directory'). '/style.css', array($parent_style));
    echo '<link rel="shortcut icon" type="image/x-icon" href="'.get_bloginfo('stylesheet_directory').'/images/favicon.png" />';
    /*
       Bootstrap
   */
    wp_enqueue_style("bootstrap", get_stylesheet_directory_uri()."/library/bootstrap/css/bootstrap.css");
    wp_enqueue_script("bootstrap", get_stylesheet_directory_uri()."/library/bootstrap/js/bootstrap.js");

    /*
        Date time picker assets
    */
    wp_enqueue_style("ca-datetimepicker-css", get_stylesheet_directory_uri()."/library/datetimepicker/jquery.datetimepicker.css");
    // wp_enqueue_style("ca-datetimepicker-css", get_stylesheet_directory_uri()."/library/datetimepicker/bootstrap-datetimepicker.min.css");
    wp_enqueue_script("ca-datetimepicker-js", get_stylesheet_directory_uri()."/library/datetimepicker/jquery.datetimepicker.full.js", array("jquery"));
    wp_enqueue_script("ca-datefrom-and-to-js", get_stylesheet_directory_uri()."/library/datetimepicker/datefrom-dateto.js", array("jquery"));

    /*
        Multi select assets
    */
    wp_enqueue_style("ca-multiselect-css", get_stylesheet_directory_uri()."/library/multiselect/bootstrap-multiselect.css");
    wp_enqueue_script("ca-multiselect-js", get_stylesheet_directory_uri()."/library/multiselect/bootstrap-multiselect.js", array("jquery"));
    wp_enqueue_script("ca-multiselect-custom-js", get_stylesheet_directory_uri()."/library/multiselect/ca_multi-select-custom.js", array("jquery"));
}

//Display social links
function custom_addon_social(){
    $output = '<div id="social" class="social">';
    $output .= '<i class="fa fa-home">P-13 Hagkol, Valencia City  </i> ';
    $output .= '<i class="fa fa-phone-square"> +06064206228/+088 -3150357 </i> ';
    $output .= '<i class="fa fa-clock-o"> Daily 8:00AM-10PM |</i> ';
    $output .= 'Follow us ';
    $output .= unite_social_item(of_get_option('social_facebook'), 'Facebook', 'facebook');
    $output .= unite_social_item(of_get_option('social_twitter'), 'Twitter', 'twitter');
    $output .= unite_social_item(of_get_option('social_google'), 'Google Plus', 'google-plus');
    $output .= unite_social_item(of_get_option('social_youtube'), 'YouTube', 'youtube');
    $output .= unite_social_item(of_get_option('social_linkedin'), 'LinkedIn', 'linkedin');
    $output .= unite_social_item(of_get_option('social_pinterest'), 'Pinterest', 'pinterest');
    $output .= unite_social_item(of_get_option('social_feed'), 'Feed', 'rss');
    $output .= unite_social_item(of_get_option('social_tumblr'), 'Tumblr', 'tumblr');
    $output .= unite_social_item(of_get_option('social_flickr'), 'Flickr', 'flickr');
    $output .= unite_social_item(of_get_option('social_instagram'), 'Instagram', 'instagram');
    $output .= unite_social_item(of_get_option('social_dribbble'), 'Dribbble', 'dribbble');
    $output .= unite_social_item(of_get_option('social_skype'), 'Skype', 'skype');
    $output .= unite_social_item(of_get_option('social_vimeo'), 'Vimeo', 'vimeo-square');
    $output .= '</div>';
    echo $output;
}

function register_my_menus() {
    register_nav_menus(
        array(
            'header-menu' => __( 'Header Menu' ),
            'extra-menu' => __( 'Extra Menu' )
        )
    );
}
add_action( 'init', 'register_my_menus' );

function pdf_shortcode_handler($atts, $content = null){
    $uploads = wp_upload_dir();
    $upload_path = $uploads['baseurl'];
    $file_path= '/2016/02/Menu.pdf';
    $output = '<a href="'.$upload_path.$file_path.'" target="blank">'.$content.'</a>';

    return $output;
}

add_shortcode('pdf','pdf_shortcode_handler');

function reservation_init_func( $atts ) {
    require_once 'includes/reservation/ca-reservation-form.php';
   
}
add_shortcode( 'reservation_init', 'reservation_init_func' );

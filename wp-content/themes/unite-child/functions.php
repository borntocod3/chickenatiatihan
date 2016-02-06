<?php

/* Ninja Theme.
 *
 * v1.0.
 */

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function theme_enqueue_styles()
{
    $parent_style = 'parent-style';

    wp_enqueue_style($parent_style, get_bloginfo('template_directory') . '/style.css');
    wp_enqueue_style('child-style', get_bloginfo('stylesheet_directory'). '/style.css', array($parent_style));
    echo '<link rel="shortcut icon" type="image/x-icon" href="'.get_bloginfo('stylesheet_directory').'/images/favicon.png" />';
}

//Display social links
function custom_addon_social(){
    $output = '<div id="social" class="social">';
    $output .= '<i class="fa fa-home"> P-13 Hagkol, Valencia City </i> ';
    $output .= '<i class="fa fa-phone-square"> +06064206228/+088 -3150357 </i> ';
    $output .= '<i class="fa fa-clock-o"> Mon-Sat 8:00AM, Sun 9:00AM </i> ';
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
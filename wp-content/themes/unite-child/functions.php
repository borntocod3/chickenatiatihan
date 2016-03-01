<?php

/* Ninja Theme.
 *
 * v1.0.
 */


// include "includes/custom-post-type/event.php";
// include "includes/custom-meta-box/events-meta-box.php";
include_once "includes/custom-post-type/product.php";
include_once "includes/custom-meta-box/product-meta-box.php";
include_once "includes/custom-post-type/reservation.php";


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

/**
 * Register Menu
 */
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

    echo '<form method="post">';
    require_once 'includes/reservation/ca-reservation-form.php';
    echo '</form>';

}
add_shortcode( 'reservation_init', 'reservation_init_func' );

/**
 * function to save the reservation data
 * @param null
 */
function save_reservation_data(){
    global $wpdb;

    if(isset($_POST['ca_reservation_nonce'])){
        $nonce = $_POST['ca_reservation_nonce'];

        //format date like mysql datetime format
        $_POST['ca_date'] = date('Y-m-d h:i:s',strtotime($_POST['ca_date']));

        //check if nonce is verified
        if(wp_verify_nonce($nonce,'ca_reservation_data')){

                $reservation_args = array(
                    'post_title'    => $_POST['ca_event_name'],
                    'post_status'   => 'Pending',
                    'post_type'     => 'reservation',
                    'post_content'  => $_POST['ca_notes'],
                    'post_date'     => $_POST['ca_date'],
                );

                /**
                 * wp_insert_post returns the id of the inserted post else return value is 0
                 */
                $insert_id =  wp_insert_post($reservation_args);

                //Check if insert is successful
                if(0 != $insert_id){
                    /**
                     * Reservation Post Data array
                     */
                    $reservation_post_meta = array(
                            'num_heads'  => $_POST['ca_num_of_heads'],
                            'email'         => $_POST['ca_email'],
                            'ca_contact_no' => $_POST['ca_contact_no'],
                            'ca_venue'=> $_POST['ca_venue']
                    );

                    /**
                     * update_post_meta inserts data if its not available and
                     * update the data if it exists
                     */
                    update_post_meta($insert_id, 'ca_reservate_meta_data',$reservation_post_meta);

                    /**
                     * Set post category
                     * Reference http://codex.wordpress.org/Function_Reference/wp_set_object_terms
                     */
                    $cat_ids = array_map('intval',$_POST['ca_specialty']);
                    $cat_ids = array_unique($cat_ids);
                    wp_set_object_terms($insert_id, $cat_ids, 'reservation_category');

                }
        }
    }
}
add_action('wp','save_reservation_data');

/**
 * Modify default wordpress table list for reservation post type
 * @param null
 */
function set_reservation_custom_columns_filter( $columns ) {
    //Add custom columns
    $columns['no_of_heads']     = '# of Heads';
    $columns['email']           = 'Email';
    $columns['contact_no']      = 'Contact No';
    $columns['specialty']       = 'Specialty';
    $columns['title']           = 'Event Name';
    $columns['venue']           = 'Venue';
    $columns['content']         = 'Notes';
    $columns['ca_action']          = 'Action';

    //unset default columns like title and comments
    unset($columns['comments']);

    return $columns;
}
add_filter( 'manage_reservation_posts_columns', 'set_reservation_custom_columns_filter', 10, 1 );

/**
 * Show the data of a custom columns
 */
function show_custom_columns_data($column, $post_id){
    $reservation_meta_data = get_post_meta($post_id, 'ca_reservate_meta_data', true);

    switch ($column) {
        case 'no_of_heads':
                echo $reservation_meta_data['num_heads'];
            break;

        case 'email':
                echo  $reservation_meta_data['email'];
            break;
        case 'contact_no':
                echo $reservation_meta_data['ca_contact_no'];
            break;
        case 'specialty':

                $categories = get_the_terms($post_id,'reservation_category');
                if(!empty($categories)){
                    $category_names = array();

                    foreach ($categories as $category) {
                       $category_names[]  = $category->name;
                    }
                    echo join(',', $category_names);
                }

            break;

        case 'content':
                echo apply_filters('the_content',get_post_field('post_content', $post_id));
            break;
        case 'venue';
                echo $reservation_meta_data['ca_venue'];

            break;
        case 'ca_action':
            $status = get_post_status($post_id);
            if('publish' != $status){
                $nonce  = wp_create_nonce('ca_update_reservation');
                $link   = admin_url('admin-ajax.php?action=update_reservation_status_and_send_email&post_id='.$post_id.'&rca_nonce='.$nonce);
                echo '<a href="',$link,'"> Confirm</a>';
            }else {
                echo 'Confirmed';
            }

            break;

    }
}
add_action( 'manage_reservation_posts_custom_column' , 'show_custom_columns_data', 10, 2 );

/**
 * Remove edit, quick edit, trash and view
 */
function reservation_remove_action_rows( $actions, $post){
    global $current_screen;
    /**
     * If post screen is not reservation then just return $actions variable
     */
    if('reservation' != $current_screen->post_type) return $actions;

    unset( $actions['edit'] );
    unset( $actions['view'] );
    unset( $actions['trash'] );
    unset( $actions['inline hide-if-no-js'] );
    return $actions;
}
add_filter('post_row_actions','reservation_remove_action_rows',10, 2);

/**
 * Update the reservation to published and send email to the client
 */
function update_reservation_status_and_send_email(){

    if(!wp_verify_nonce($_REQUEST['rca_nonce'], 'ca_update_reservation')){
        //do not do anything if the nonce is not verified
        die();
    }

    if(!isset($_REQUEST['post_id'])){
        //do not do anything
        die();
    }
    //get the reference of the reservation
    $post_id = $_REQUEST["post_id"];

    /**
     * Update the status of the reservation details
     */
    $update_status = wp_update_post(array(
                        'ID'            => $post_id,
                        'post_status'   => 'publish'
                     ));
    if(0 != $update_status){

        $post_meta = get_post_meta($post_id, 'ca_reservate_meta_data', true);

        //get the email
        $email = $post_meta['email'];
        /**
         * Setup email then use wp_mail to send the email
         */
        //wp_mail()
        //After email is end rediret to the reservation list
         $reservation_admin_url = admin_url('edit.php?post_type=reservation');
         header("Location: ".$reservation_admin_url);
    }

    die();
}
add_action('wp_ajax_update_reservation_status_and_send_email','update_reservation_status_and_send_email');




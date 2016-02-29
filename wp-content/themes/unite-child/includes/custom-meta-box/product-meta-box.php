<?php
/**
 * Created by Jameshwart Lopez.
 * Date: 11/02/16
 * Time: 5:45 PM
 */
function ca_price_metaboxes(){
    add_meta_box('ca_price_meta_box', 'Price',  'ca_price_form', 'ca_product', 'side', 'high');
}

/**
 * Render Form for Events date
 */
function ca_price_form() {

    global $post;
    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'ca_product_nonce_name', 'ca_product_nonce' );

    //get the previously save meta data
    $product_price  = get_post_meta($post->ID,'ca_product_price', true);

    // Echo out the field
    echo '<input id="ca_product_price_field" type="text" value="', $product_price  ,'" name="ca_product_price_field" class="widefat" />';

}



/**
 * Meta key actual database insertion
 */
function ca_price_saving($post_id){

    /**
     * Check if nonce is not set
     */
    if (!isset($_POST['ca_product_nonce']))
        return $post_id;

    $nonce = $_POST['ca_product_nonce'];

    /**
    * Verify that the request came from our screen with the proper authorization
    */
    if(!wp_verify_nonce($nonce,'ca_product_nonce_name'))
        return $post_id;

    //Check the user's permission
    if(!current_user_can('edit_post',$post_id) )
        return $post_id;

    if(!isset( $_POST['ca_product_price_field']))
        return $post_id;

    update_post_meta($post_id, 'ca_product_price', sanitize_text_field($_POST['ca_product_price_field']));
}

add_action('save_post','ca_price_saving');

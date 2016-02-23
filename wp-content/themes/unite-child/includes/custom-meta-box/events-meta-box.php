<?php
/**
 * Created by Jameshwart Lopez.
 * Date: 11/02/16
 * Time: 5:45 PM
 */
function add_events_metaboxes(){
   //new eventsListMetaBox();
    add_meta_box('wpt_events_date', 'Events Date',  'fisa_events_date', 'events', 'side', 'high');
}

/**
 * Render Form for Events date
 */
function fisa_events_date() {

    global $post;
    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'events_date_fromto', 'events_datefromto_nonce' );

    //get the previously save meta data
    $date_event  = get_post_meta($post->ID,'_fisa_events_date');

    $date = date_create("now");

    //check if data is empty if date from is empty set to the current time
    $date_from = !empty($date_event[0][0]) ? $date_event[0][0] : date_format($date,"Y/m/d H:i");
    $date_to   = !empty($date_event[0][1]) ? $date_event[0][1] : $date_from;

    // Echo out the field
    echo '<label for="_fisa_date_from">Start Date</label>';
    echo '<input id="fisa-event-datefrom" type="text" value="', $date_from ,'" name="_fisa_date_from" class="widefat" />';
    echo '<br/><br/>';
    echo '<label for="_fisa_date_to">End Date</label>';
    echo '<input id="fisa-event-dateto" type="text" value="', $date_to ,'" name="_fisa_date_to" class="widefat" />';

}



/**
 * Meta key actual database insertion
 */
function fisa_events_date_save($post_id){

    /**
     * Check if nonce is not set
     */
    if (!isset($_POST['events_datefromto_nonce']))
        return $post_id;

    $nonce = $_POST['events_datefromto_nonce'];

    /**
    * Verify that the request came from our screen with the proper authorization
    */
    if(!wp_verify_nonce($nonce,'events_date_fromto'))
        return $post_id;

    //Check the user's permission
    if(!current_user_can('edit_post',$post_id) )
        return $post_id;

    if(!isset( $_POST['_fisa_date_from'], $_POST['_fisa_date_to']))
        return $post_id;

    //Prepare and sanitize the data before saving it
    $events_date =  array(
        sanitize_text_field( $_POST['_fisa_date_from']),
        sanitize_text_field( $_POST['_fisa_date_to'])
    );

    update_post_meta($post_id, '_fisa_events_date', $events_date);
}

add_action('save_post','fisa_events_date_save');

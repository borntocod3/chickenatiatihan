<?php
/**
 * Created by Jameshwart Lopez.
 * Date: 11/02/16
 * Time: 4:18 PM
 */


/**
 * Custom Post type reservation
 */
function ca_reservation_init(){

    $labels = array(
        'name'                  => _x( 'Reservation', 'post type general name' ),
        'singular_name'         => _x( 'Reservation', 'post type singular name' ),
        'menu_name'             => _x( 'Reservation List', 'admin menu' ),
        'name_admin_bar'        => _x( 'Reservation List', 'add new on admin bar' ),
        'edit_item'             => __( 'Edit Reservation' ),
        'view_item'             => __( 'View Reservation' ),
        'all_items'             => __( 'All Reservation' ),
        'search_items'          => __( 'Search Reservation' ),
        'not_found'             => __( 'No Reservation found.' ),
        'not_found_in_trash'    => __( 'No Reservation found in Trash.' )
    );

    $args   = array(
        'labels'                => $labels,
        'description'           => __( 'Create Reservation' ),
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'reservation' ),
        // 'capability_type'       => 'post',
        // 'capabilities'          => array('create_posts'=> false),
        'has_archive'           => true,
        'hierarchical'          => false,
        'menu_position'         => 6,
        'taxonomies'            => array('reservation_category','event'),
        'menu_icon'             => 'dashicons-editor-ul',
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' )
    );

    register_post_type('reservation',$args);

    $taxonomy_args = array(
        'labels'             => array(
                                'name'                  => _x( 'Specialty', 'post type general name' ),
                                'singular_name'         => _x( 'Specialty', 'post type singular name' ),
                                'menu_name'             => _x( 'Specialty', 'admin menu' ),
                                'name_admin_bar'        => _x( 'Reservation List', 'add new on admin bar' ),
                                'add_new_item'          => __( 'Add new Specialty name' ),
                                'edit_item'             => __( 'Edit Specialty' ),
                                'view_item'             => __( 'View Specialty' ),
                                'all_items'             => __( 'All Specialty' ),
                                'search_items'          => __( 'Search Specialty' ),
                                'not_found'             => __( 'No Specialty found.' ),
                                'not_found_in_trash'    => __( 'No Specialty found in Trash.' )
                            ),
        'public'            => true,
        'show_admin_menu'   => true,
        'hierarchical'      => true,
        'query_var'         => 'specialty'
    );

    register_taxonomy('reservation_category', 'reservation', $taxonomy_args);

    $taxonomy_event_args = array(
        'labels'             => array(
                                'name'                  => _x( 'Event', 'post type general name' ),
                                'singular_name'         => _x( 'Event', 'post type singular name' ),
                                'menu_name'             => _x( 'Event', 'admin menu' ),
                                'name_admin_bar'        => _x( 'Event List', 'add new on admin bar' ),
                                'add_new_item'          => __( 'Add new Event name' ),
                                'edit_item'             => __( 'Edit Event' ),
                                'view_item'             => __( 'View Event' ),
                                'all_items'             => __( 'All Event' ),
                                'search_items'          => __( 'Search Event' ),
                                'not_found'             => __( 'No Event found.' ),
                                'not_found_in_trash'    => __( 'No Event found in Trash.' )
                            ),
        'public'            => true,
        'show_admin_menu'   => true,
        'hierarchical'      => true,
        'query_var'         => 'event'
    );
    register_taxonomy('reservation_event', 'reservation', $taxonomy_event_args);
}

add_action('init','ca_reservation_init');

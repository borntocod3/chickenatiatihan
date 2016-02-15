<?php
/**
 * Created by Jameshwart Lopez.
 * Date: 11/02/16
 * Time: 4:18 PM
 */


/**
 * Custom Post type event list creation
 */
function event_list_init(){

    $labels = array(
        'name'                  => _x( 'Events', 'post type general name' ),
        'singular_name'         => _x( 'Event', 'post type singular name' ),
        'menu_name'             => _x( 'Events List', 'admin menu' ),
        'name_admin_bar'        => _x( 'Events List', 'add new on admin bar' ),
        'add_new_item'          => __( 'Add New Event' ),
        'new_item'              => __( 'New Event' ),
        'edit_item'             => __( 'Edit Event' ),
        'view_item'             => __( 'View Event' ),
        'all_items'             => __( 'All Events' ),
        'search_items'          => __( 'Search Events' ),
        'not_found'             => __( 'No Events found.' ),
        'not_found_in_trash'    => __( 'No Events found in Trash.' )
    );

    $args   = array(
        'labels'                => $labels,
        'description'           => __( 'Create Events' ),
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'event' ),
        'capability_type'       => 'post',
        'has_archive'           => true,
        'hierarchical'          => true,
        'menu_position'         => 6,
        'register_meta_box_cb'  => 'add_events_metaboxes',
        'menu_icon'             => 'dashicons-calendar-alt',
        'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
    );

    register_post_type('events',$args);

}

add_action('init','event_list_init');





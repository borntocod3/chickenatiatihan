<?php
/**
 * Created by Jameshwart Lopez.
 * Date: 11/02/16
 * Time: 4:18 PM
 */


/**
 * Custom Post type reservation
 */
function ca_products_init(){

    $labels = array(
        'name'                  => _x( 'Product', 'post type general name' ),
        'singular_name'         => _x( 'Product', 'post type singular name' ),
        'menu_name'             => _x( 'Product List', 'admin menu' ),
        'name_admin_bar'        => _x( 'Product List', 'add new on admin bar' ),
        'edit_item'             => __( 'Edit Product' ),
        'view_item'             => __( 'View Product' ),
        'all_items'             => __( 'All Products' ),
        'search_items'          => __( 'Search Products' ),
        'not_found'             => __( 'No Products found.' ),
        'not_found_in_trash'    => __( 'No Products found in Trash.' )
    );

    $args   = array(
        'labels'                => $labels,
        'description'           => __( 'Create Product' ),
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'has_archive'           => true,
        'hierarchical'          => true,
        'menu_position'         => 6,
        'taxonomies'            => array('products_category'),
        'register_meta_box_cb'  => 'ca_price_metaboxes',
        'menu_icon'             => 'dashicons-cart',
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' )
    );

    register_post_type('ca_product',$args);

    $taxonomy_args = array(
        'labels'             => array(
                                'name'                  => _x( 'Product Category', 'post type general name' ),
                                'singular_name'         => _x( 'Product Category', 'post type singular name' ),
                                'menu_name'             => _x( 'Category', 'admin menu' ),
                                'name_admin_bar'        => _x( 'Reservation List', 'add new on admin bar' ),
                                'add_new_item'          => __( 'Add new Product Category' ),
                                'edit_item'             => __( 'Edit Product Category' ),
                                'view_item'             => __( 'View Product Category' ),
                                'all_items'             => __( 'All Products Category' ),
                                'search_items'          => __( 'Search Product Category' ),
                                'not_found'             => __( 'No Product Category found.' ),
                                'not_found_in_trash'    => __( 'No Product Category found in Trash.' )
                            ),
        'public'            => true,
        'show_admin_menu'   => true,
        'hierarchical'      => false,
        'query_var'         => 'product_category'
    );

    register_taxonomy('products_category', 'ca_product', $taxonomy_args);

}

add_action('init','ca_products_init');

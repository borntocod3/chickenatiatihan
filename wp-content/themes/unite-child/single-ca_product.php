<?php /* Template Name: Product Custom Post */
get_header(); ?>
<?php

$args = array(
    'type'                     => 'ca_product',
    'taxonomy'                 => 'products_category',//the specialty category
    'hide_empty'               => true

);
/**
 * Get the category specialty
 */
$categories = get_categories( $args );

/**
 * Check if category is not empty
 * if its not empty then we will show it the the end user
 * else we should not let end user see it.
 */
if(!empty($categories)){
    foreach ($categories as $category) {

        $args = array(
            'post_type' => 'ca_product',
            'tax_query' => array(
                array(
                    'taxonomy'  => 'products_category',
                    'field'     => 'id',
                    'terms'     => $category->term_id

                )
            )
        );

        $products = new WP_Query( $args );
        $products = $products->posts;

        ?>
    <div class="col-md-12 product-category">
        <h2><?php echo $category->name;?></h2>
    </div>

                <?php
                foreach ($products as $product) { ?>
                    <div class="col-md-4">
                        <?php
                        $url = get_the_post_thumbnail_url($product->ID);
                        ?>
                        <div class="thumbnail">
                            <img src="<?php echo $url;?>">
                        </div>
                        <div class="caption">
                            <h3><?php echo $product->post_title; ?></h3>
                        </div>
                    </div>
                <?php }
    }
}
?>

<?php get_footer();?>
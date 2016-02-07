<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package unite
 */

get_header(); ?>


<?php
/*Carousel shortcode
*/
echo do_shortcode('[image-carousel twbs="3"]');?>

<div id="primary" class="content-area col-sm-12 col-md-8 <?php echo of_get_option( 'site_layout' ); ?>">
    <main id="main" class="site-main" role="main">

        <?php
        get_template_part('content');
        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

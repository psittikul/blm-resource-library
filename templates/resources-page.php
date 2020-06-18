<?php

/**
 *
 * Template Name: Resources Page Template
 * Template Post Type: post, page
 * 
 * Display all resources in a category
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage BLM_Resource_Library
 */

get_header();
?>

<main id="site-content" role="main">
    <!-- TO-DO: Sticky side nav for subcategories that highlights section person is currently viewing -->

    <?php
    $curr = get_post(get_the_ID());
    get_template_part('template-parts/sidenav'); ?>
</main><!-- #site-content -->


<?php
get_footer();

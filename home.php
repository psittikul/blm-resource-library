<?php

/**
 * /**
 * Template Name: Home Template
 * Template Post Type: page
 * Home page template file
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage BLM_Resource_Library
 */

get_header();
?>

<!-- <main id="site-content" role="main"> -->
<div class="container-fluid" id="mainContainer">
    <!-- Disclaimer/description of home page (id=30) (edited on the "Home" page in WordPress dashboard) -->
    <?php
    $home = get_page(30);
    echo $home->post_content;
    ?>
</div>
<!-- </main> -->


<?php
get_footer();

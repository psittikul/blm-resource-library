<?php

/**
 * The template for displaying single resources (that don't link to an external resource or file)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage BLM_Resource_library
 */

get_header();
?>

<div class="container-fluid" id="mainContainer">
    <?php
    $rid = get_the_ID();
    $resource = get_post($rid); ?>
    <h2 class="resource-post-title"><?php echo the_title(); ?></h2>
    <p class="author-source">Author/source: <?php echo get_field("author_source", $rid); ?></p>
    <?
    echo var_dump(get_post_type($resource));
    echo $resource->post_content;
    echo get_field("full_content", $rid);
    ?>
</div>
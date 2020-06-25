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
    <?php
    echo $resource->post_content;
    $categories = get_the_category($rid);
    /**
     * If this post is of the Infographics, Zines, & Memes category and has multiple images, 
     * display as a slideshow thing (with option to view all in a grid)
     */
    foreach ($categories as $category) {
        // echo var_dump($category);
        echo $category->slug;
        // echo $category["slug"];
        // if ($category["slug"] == "infographics-zines-memes") {
        //     echo "This is an infographic";
    ?>
            <!-- <div id="graphicCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">

                </div>
                <a class="carousel-control-prev" href="#graphicCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#graphicCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div> -->
    <?php
        // }
    }
    echo get_field("full_content", $rid);
    ?>
</div>
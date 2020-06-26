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

<div class="container-fluid single-resource" id="mainContainer">
    <?php
    $rid = get_the_ID();
    $resource = get_post($rid); ?>
    <h2 class="resource-post-title"><?php echo the_title(); ?></h2>
    <p class="author-source">Author/source: <?php echo get_field("author_source", $rid); ?></p>
    <?php
    echo $resource->post_content;
    $categories = get_the_category($rid);
    /**
     * If this post has slideshow images, set up that display
     * TO-DO: Offer a "view all slides"/grid view button thing
     */
    if (get_field("slide_image_1", $rid)) {
    ?>
        <div id="graphicCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
            <div class="carousel-inner">
                <?php
                // Go through each of the slideshow images
                for ($i = 1; $i < 17; $i++) {
                    $fieldname = "slide_image_$i";
                    if (get_field($fieldname, $rid)) {
                ?>
                        <div class='carousel-item <?php echo $i == 1 ? "active" : ""; ?>'>
                            <?php
                            $img = get_field($fieldname, $rid); ?>
                            <img src="<?php echo $img['url']; ?>" alt="<?php echo $img["alt"]; ?>" title="<?php echo $img["title"]; ?>" />
                        </div>
                <?php
                    } else {
                        break;
                    }
                }
                ?>
            </div>
            <ol class="carousel-indicators">
                <!-- TO-DO: Actually do these lol -->
                <?php
                for ($i = 1; $i < 17; $i++) {
                    $fieldname = "slide_image_$i";
                    if (get_field($fieldname, $rid)) {
                ?>
                        <li data-target="#graphicCarousel" data-slide-to="<?php echo $i - 1; ?>" class="<?php echo $i == 1 ? 'active' : '' ?>"></li>
                <?php
                    }
                }
                ?>

            </ol>
            <a class="carousel-control-prev" href="#graphicCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#graphicCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    <?php
    }
    ?>
    <?php
    echo get_field("full_content", $rid);
    ?>
</div>
<?php
get_footer(); ?>
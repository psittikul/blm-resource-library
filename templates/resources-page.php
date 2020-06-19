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
$curr = get_post(get_the_ID());
?>

<div class="container-fluid" id="mainContainer">
    <?php
    $allCategories = get_categories();
    $subcategories = array();
    $cid = -1;
    foreach ($allCategories as $category) {
        if ($category->slug == get_page(get_the_ID())->post_name) {
            $cid = $category->term_id;
        }
    }
    foreach ($allCategories as $subcategory) {
        if ($subcategory->parent == $cid) {
            // Push to an array we can reference later
            array_push($subcategories, $subcategory);
        } else {
            continue;
        }
    }
    ?>
    <div id="sideNav">

        <ul id="subcategoryMenu">
            <li class="subcategory" id="toggleSide">
                <button type="button" id="toggleSideNavBtn" data-toggle="tooltip" title="Minimize menu" data-mode="hide">
                    <i data-dir="left" class="fas fa-angle-double-left"></i>
                    <i data-dir="right" class="fas fa-bars"></i>
                </button>
            </li>
            <?php
            foreach ($subcategories as $option) {
            ?>
                <li class="subcategory" data-id="<?php echo $option->term_id; ?>"><a href="#<?php echo $option->slug; ?>"><?php echo $option->name; ?></a>
                <?php
            }
                ?>
                <!-- Add a "back to top" option -->
                <li class="subcategory" id="backToTop">Back to Top</li>
        </ul>
    </div>
    <?php
    // Now go through each subcategory and get all of its resources
    foreach ($subcategories as $section) {
    ?>
        <div class="section-container" data-tid="<?php echo $section->term_id; ?>" id="<?php echo $section->slug; ?>">
            <h4 class="section-title"><?php echo $section->name; ?></h4>
            <div class="row row-cols-1 row-cols-sm-4">
                <?php
                $args = array(
                    'post_type' => 'resources',
                    'order'    => 'ASC',
                    'cat' => $section->term_id
                );

                $the_query = new WP_Query($args);
                $posts = $the_query->posts;
                foreach ($posts as $resource) {
                ?>
                    <div class="col mb-4">
                        <a href="<?php echo get_field('resource_link', $resource->ID); ?>" class="card-link" target="_blank">
                            <div class="card resource-card">
                                <?php

                                $thumbnail_id = get_post_thumbnail_id($resource->ID);
                                $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                                ?>
                                <div class="card-meat">
                                    <div class="card-img-container">
                                        <img class="card-img" src="<?php echo get_the_post_thumbnail_url($resource->ID); ?>" alt="<?php echo $alt; ?>" />
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title resource-name"><?php echo $resource->post_title; ?></h5>

                                        <?php echo $resource->post_content; ?>

                                    </div>
                                </div>
                                <?php
                                if (strlen(get_field("author_source", $resource->ID)) > 1) {
                                ?>
                                    <div class="card-footer text-muted">
                                        <small> Author/Source: <?php echo get_field("author_source", $resource->ID); ?></small>
                                    </div>
                                <?php
                                }
                                if (get_the_tags($resource->ID)) {
                                ?>
                                    <div class="card-footer text-muted">
                                        <small class="tags">
                                            Tagged as:
                                            <?php
                                            $tagArray = get_the_tags($resource->ID);
                                            $tagNames = array();
                                            foreach ($tagArray as $tag) {
                                                array_push($tagNames, $tag->name);
                                            }
                                            echo implode(", ", $tagNames);
                                            ?></small>
                                    </div>
                                <?php
                                } ?>
                            </div>
                        </a>
                    </div>

                <?php
                }
                ?>
            </div>
        </div>
    <?php
    }

    ?>
</div>


<?php
get_footer();

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
    <!-- Instead of sticky side nav, sticky second top nav??? -->
    <div id="categoryNav">
        <h2 id="categoryTitle"><?php echo get_the_title($curr); ?></h2>
        <nav class="navbar navbar-expand-lg" id="categoryNavMenu">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#categoryNavMenuContent" aria-controls="categoryNavMenuContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="categoryNavMenuContent">
                <ul class="navbar-nav mr-auto">
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
                    ?>
                            <li>
                                <a href="#<?php echo $subcategory->slug; ?>" data-cid="<?php echo $subcategory->term_id; ?>" data-toggle="tooltip" title="Jump to <?php echo $subcategory->name; ?> section">
                                    <?php echo $subcategory->name; ?>
                                </a>
                            </li>
                    <?php
                        } else {
                            continue;
                        }
                    }
                    ?>
                </ul>
            </div>
        </nav>
    </div>
    <?php
    // Now go through each subcategory and get all of its resources
    foreach ($subcategories as $section) {
        // Add a lil div or something to use as an anchor
    ?>
        <div class="section-container" id="<?php echo $section->slug; ?>">

            <div class="row row-cols-1 row-cols-md-3">
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
                        <a href="<?php echo get_field('resource_link', $resource->ID); ?>" target="_blank">
                            <div class="card resource-card">
                                <?php

                                $thumbnail_id = get_post_thumbnail_id($resource->ID);
                                $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                                ?>
                                <img class="card-img-top" src="<?php echo get_the_post_thumbnail_url($resource->ID); ?>" alt="<?php echo $alt; ?>" />
                                <div class="card-body">
                                    <h5 class="card-title resource-name"><?php echo $resource->post_title; ?></h5>
                                    <p class="card-text">
                                        <?php echo $resource->post_content; ?>
                                    </p>
                                </div>
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

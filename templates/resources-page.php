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
    /**
     * If this page/category has any associated content (i.e. the reading tips on the Educational Resources page), show it at the top
     */
    echo "<h2 class='page-title'>$curr->post_title</h2>";
    echo $curr->post_content;


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

            <!-- Robust overflow test -->

            <style>
                /* .button {
                    position: absolute;
                    z-index: 5;
                    display: none;
                    cursor: pointer;
                    color: #555555;
                }

                .close {
                    display: none;
                }

                .open {
                    display: none;
                }

                .container {
                    width: 200px;
                    overflow: hidden;
                    border: 1px solid #cacaca;
                    border-radius: 5px;
                    font-size: 12px;
                    position: relative;
                    margin: auto;
                    padding: 10px 10px 0px 10px;
                    float: left;
                    margin: 5px;
                }

                .text_container {
                    height: 105px;
                    overflow: hidden;

                }

                .text {
                    text-overflow: ellipsis;
                } */
            </style>



            <!-- End test  -->

            <div class="row row-cols-1 row-cols-sm-4">
                <?php
                /**
                 * TO-DO: Order resources ignoring articles like "The", "An" etc.
                 */
                $args = array(
                    'post_type' => 'resources',
                    'order'    => 'ASC',
                    'orderby' => array(
                        'menu_order' => 'asc',
                        'title' => 'asc'
                    ),
                    'cat' => $section->term_id,
                    'posts_per_page' => -1
                );

                $the_query = new WP_Query($args);
                $posts = $the_query->posts;
                ?>
                <?php
                foreach ($posts as $resource) {
                ?>
                    <div class="col mb-4">

                        <div class="card resource-card">
                            <?php

                            $thumbnail_id = get_post_thumbnail_id($resource->ID);
                            $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                            ?>
                            <div class="card-meat">
                                <div class="card-img-container">

                                    <a href="<?php echo get_field('resource_link', $resource->ID); ?>" class="card-link" target="_blank">
                                        <img class="card-img" src="<?php echo get_the_post_thumbnail_url($resource->ID); ?>" alt="<?php echo $alt; ?>" />
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title resource-name">
                                        <a href="<?php echo get_field('resource_link', $resource->ID); ?>" class="card-link" target="_blank"><?php echo $resource->post_title; ?> <i class="fas fa-external-link-alt"></i></a>
                                    </h5>

                                    <div class="full-container">
                                        <div class="card-text-container">
                                            <div class="actual-text">
                                                <?php

                                                // TO-DO: IF THIS PARTICULAR RESOURCE HAS A TRIGGER WARNING, SHOW IT 

                                                // $tw = get_field("trigger_warnings", $resource->ID);
                                                // if (strlen(get_field("trigger_warnings", $resource->ID)) > 1) {
                                                //     echo "<p><strong>TW: $tw</strong></p>";
                                                // }
                                                echo $resource->post_content;
                                                ?>

                                            </div>

                                        </div>

                                    </div>
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

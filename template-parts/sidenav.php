<?php

/** TO-DO: Use wpquery or whatever to get all the subcategories of the current category page */
$allCategories = get_categories();
$currCategory = array_filter($allCategories, function ($c) {
    $curr = get_page(get_the_ID())->post_name;
    return $c->slug == $curr;
});
$cid = $currCategory[0]->term_id;
$page = get_page(get_the_ID());
echo $page->post_name;
?>

<div id="sideNav" data-pid="<?php echo get_the_ID(); ?>">
    <ul>
        <?php
        foreach ($allCategories as $subcategory) {
            // Only choose the subcategories of this current category page
            if ($subcategory->parent == $cid) {
        ?>
                <a href="#<?php echo $subcategory->slug; ?>">
                    <li><?php echo $subcategory->name; ?></li>
                </a>
        <?php
            }
        }
        ?>
    </ul>
</div>
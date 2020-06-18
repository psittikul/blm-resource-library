<?php

/** TO-DO: Use wpquery or whatever to get all the subcategories of the current category page */
$allCategories = get_categories();


?>

<div id="sideNav">

    <ul>
        <?php
        /**
         * TO-DO: More efficient way of doing this lol
         */
        $cid = 0;
        foreach ($allCategories as $category) {
            if ($category->slug == get_page(get_the_ID())->post_name) {
                $cid = $category->term_id;
            }
        }
        foreach ($allCategories as $subcategory) {
            if ($subcategory->parent == $cid) {
        ?>
                <a href="#<?php echo $subcategory->slug; ?>">
                    <li><?php echo $subcategory->name; ?></li>
                </a>
        <?php
            } else {
                continue;
            }
        }
        ?>
    </ul>
</div>
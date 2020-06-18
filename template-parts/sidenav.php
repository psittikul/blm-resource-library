<?php

/** TO-DO: Use wpquery or whatever to get all the subcategories of the current category page */
$allCategories = get_categories();


?>

<div id="sideNav">

    <ul>
        <?php
        $cid = 0;
        foreach ($allCategories as $category) {
            if ($category->slug == get_page(get_the_ID())->post_name) {
                $cid = $category->term_id;
            }
        }
        echo $cid;
        $subcategories = array();
        foreach ($allCategories as $subcategory) {
            if ($subcategory->parent == $cid) {
                array_push($subcategories, $subcategory);
            }
        }
        echo var_dump($subcategories);
        ?>
        <!-- <a href="#<?php echo $subcategory->slug; ?>" data-supposed="<?php echo $cid; ?>" data-pid="<?php echo $subcategory->parent; ?>" data-cid="<?php echo $subcategory->term_id; ?>">
                    <li><?php echo $subcategory->name; ?></li>
                </a> -->
        <?php        ?>
    </ul>
</div>
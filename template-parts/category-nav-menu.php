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
<?php
$categories = get_terms(
    array(
        'taxonomy' => 'category_link',
        'hide_empty' => false,
        'terms' => array('name', 'count'),
    )
);

if (!empty($categories)):
?>
    <div class="portal">
        <div class="container">
            <div class="row">
                <?php
                foreach ($categories as $category):
                    setup_postdata($category);
                    if ($category->count > 0):
                    ?>
                        <div class="col-lg-4 col-md-6 portal__col">
                            <?php
                            $args = array('category' => $category);
                            get_template_part('template-parts/single/category-item', '', $args);
                            ?>
                        </div>
                    <?php
                    endif;
                endforeach;
                wp_reset_postdata();
                ?>
            </div>
            <div class="portal__noResult">
                <p><?php _e('No search results found.', 'launchpad') ?></p>
            </div>
        </div>
    </div>
<?php endif; ?>


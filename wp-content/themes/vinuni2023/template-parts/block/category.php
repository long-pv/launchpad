<?php
// Get all categories
$categories = get_categories(
    array(
        'hide_empty' => 1,
        'parent' => 0,
    )
);

$cat_item_id = '';
$count_cat_item = 0;

if ($categories):
    $cat_current = $args['cat_current'] ?? null;
    ?>
    <div class="categoryBlock" data-title="<?php _e('Categories', 'clvinuni'); ?>">
        <div class="selecDropdownCate">
            <ul class="categoryBlock__list">
                <?php
                foreach ($categories as $cat):
                    $class_active = '';

                    if ($cat_current == $cat->term_id) {
                        $class_active = 'active';
                        $cat_item_id = 'catItem-' . $cat->term_id;
                    }
                    ?>
                    <li id="catItem-<?php echo $cat->term_id; ?>" class="categoryBlock__item" data-mh="categoryBlock__item">
                        <a class="categoryBlock__link <?php echo $class_active; ?>"
                            href="<?php echo get_category_link($cat->term_id); ?>">
                            <?php echo $cat->name; ?>
                        </a>

                        <?php
                        $child_cat = get_categories(
                            array(
                                'parent' => $cat->term_id
                            )
                        );

                        if ($child_cat):
                            ?>
                            <ul class="categoryBlock__childCat">
                                <?php
                                foreach ($child_cat as $child):
                                    ?>
                                    <li>
                                        <a href="<?php echo get_category_link($child->term_id); ?>">
                                            <?php echo $child->name; ?>
                                        </a>
                                    </li>
                                    <?php
                                endforeach;
                                ?>
                            </ul>
                            <?php
                        endif;
                        ?>
                    </li>
                    <?php
                    $count_cat_item++;
                endforeach;
                ?>

                <!-- Add post type global exchange news -->
                <?php
                $on_media = get_field('on_media_' . LANG, 'option') ?? null;
                if ($on_media):
                    $archive_class = '';
                    if ($on_media == get_the_ID()) {
                        $archive_class = 'active';
                        $cat_item_id = 'catItem-' . $on_media;
                    }
                    $archive_link = get_the_permalink($on_media);
                    ?>
                    <li id="catItem-<?php echo $on_media; ?>" class="categoryBlock__item" data-mh="categoryBlock__item">
                        <a class="categoryBlock__link <?php echo $archive_class; ?>" href="<?php echo $archive_link; ?>">
                            <?php echo get_the_title($on_media); ?>
                        </a>
                    </li>
                    <?php
                    $count_cat_item++;
                endif;
                ?>
            </ul>
        </div>
    </div>

    <script>
        var catItemCurrentId = '#<?php echo $cat_item_id ?: 'abcXyz'; ?>';
        var count_cat_item = '<?php echo $count_cat_item; ?>';
    </script>
<?php endif; ?>
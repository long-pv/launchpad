<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$block_content = $args['flexible']['block_content'] ?? '';
$category_id = $block_content['category'] ?? [];

if ($category_id):
    ?>
    <div class="whyWorking">
        <?php echo block_info($block_info); ?>
        <div class="row whyWorking__list">
            <?php
            foreach ($category_id as $item):
                $term = get_term($item, 'course_category'); // object
                $image = get_field('featured_image', $term);

                if ($image):
                    ?>
                    <div class="col-md-6">
                        <div class="whyWorking__item whyWorking--hover">
                            <div class="whyWorking__img"
                                style="background: linear-gradient(180deg, rgba(0, 0, 0, 0.00) 48.44%, rgba(0, 0, 0, 0.80) 100%), url(<?php echo $image; ?>) center/cover no-repeat, lightgray 50%;">
                            </div>
                            <div class="whyWorking__content">
                                <h3 class="h5 whyWorking__title wow fadeInUp" data-wow-duration="1s">
                                    <a href="<?php echo get_term_link($term); ?>">
                                        <?php echo $term->name; ?>
                                    </a>
                                </h3>
                            </div>

                            <a class="whyWorking__link" href="<?php echo get_term_link($term); ?>"></a>
                        </div>
                    </div>
                    <?php
                endif;
            endforeach;
            ?>
        </div>
    </div>
    <?php
endif;
?>
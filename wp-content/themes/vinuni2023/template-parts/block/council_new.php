<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$display_type_info = $args['flexible']['block_info']['display_type'] ?? '';
$leaders = $args['flexible']['block_content']['leaders'] ?? '';
$class_style = ($block_info['title'] || $block_info['description']) ? '' : ' sectionSlider--noBlockInfo';
$class_style = !is_page_template(array('page-article.php')) ? $class_style : '';

$data = load_people_data($leaders);

// Build UI
?>
<div class="testimonials">
    <div class="<?php echo get_container_class(); ?>">
        <div class="testimonials__inner sectionSlider <?php echo $class_style; ?>">
            <!-- Block info -->
            <?php echo block_info($block_info); ?>

            <!-- Block testimonials -->
            <?php if ($data && !is_page_template(array('page-article.php'))): ?>
                <div class="testimonials__slider">
                    <?php
                    foreach ($data as $item):
                        if ($item->title && $item->image):
                            $args['people'] = $item;
                            get_template_part('template-parts/single/leaders_new', null, $args);
                        endif;
                    endforeach;
                    ?>
                </div>
            <?php elseif ($data && is_page_template(array('page-article.php'))): ?>
                <div class="councilArticle">
                    <div class="row">
                        <?php
                        foreach ($data as $item):
                            if ($item->title && $item->image):
                                $args['people'] = $item;
                                ?>
                                <div class="col-md-6">
                                    <?php get_template_part('template-parts/single/leaders_new', null, $args); ?>
                                </div>
                                <?php
                            endif;
                        endforeach;
                        ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
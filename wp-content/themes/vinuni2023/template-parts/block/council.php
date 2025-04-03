<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$display_type_info = $args['flexible']['block_info']['display_type'] ?? '';
$leaders = $args['flexible']['block_content']['leaders'] ?? '';
$class_style = ($block_info['title'] || $block_info['description']) ? '' : ' sectionSlider--noBlockInfo';
$class_style = !is_page_template(array('page-article.php')) ? $class_style : '';

// Build UI
?>
<div class="testimonials">
    <div class="<?php echo get_container_class(); ?>">
        <div class="testimonials__inner sectionSlider <?php echo $class_style; ?>">
            <!-- Block info -->
            <?php echo block_info($block_info); ?>

            <!-- Block testimonials -->
            <?php if ($leaders && !is_page_template(array('page-article.php'))) : ?>
                <div class="testimonials__slider">
                    <?php
                    foreach ($leaders as $post) :
                        setup_postdata($post);
                        if (get_post_status($post) == 'publish' && get_the_title() && has_post_thumbnail()) :
                            get_template_part('template-parts/single/leaders');
                        endif;
                        wp_reset_postdata();
                    endforeach;
                    ?>
                </div>
            <?php elseif ($leaders && is_page_template(array('page-article.php'))) : ?>
                <div class="councilArticle">
                    <div class="row">
                        <?php
                        foreach ($leaders as $post) :
                            setup_postdata($post);
                            if (get_post_status($post) == 'publish' && get_the_title() && has_post_thumbnail()) :
                        ?>
                                <div class="col-md-6">
                                    <?php get_template_part('template-parts/single/leaders'); ?>
                                </div>
                        <?php
                            endif;
                            wp_reset_postdata();
                        endforeach;
                        ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
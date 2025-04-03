<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$display_type_info = $args['flexible']['block_info']['display_type'] ?? '';
$background = $args['flexible']['block_content']['background'] ?? '';
$testimonials = $args['flexible']['block_content']['testimonials'] ?? '';
$class_bg = ($background == 'yes') ? 'space slick--bg section__bgImg' : '';
$slick_bg = ($background == 'yes') ? '' : '';
$class_style = ($block_info['title'] || $block_info['description']) ? '' : ' sectionSlider--noBlockInfo';

// Build UI
?>
<div class="testimonials <?php echo $class_bg; ?>">
    <div class="container">
        <div class="testimonials__inner sectionSlider <?php echo $class_style; ?>">
            <!-- Block info -->
            <?php echo block_info($block_info); ?>

            <!-- Block testimonials -->
            <?php if ($testimonials): ?>
                <div class="testimonials__slider <?php echo $slick_bg; ?>">
                    <?php
                    foreach ($testimonials as $post):
                        setup_postdata($post);
                        if (get_post_status($post) == 'publish' && get_the_title() && has_post_thumbnail()):
                            get_template_part('template-parts/single/testimonials');
                        endif;
                        wp_reset_postdata();
                    endforeach;
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
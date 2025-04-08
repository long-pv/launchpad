<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$list = $args['flexible']['block_content']['list'] ?? '';
$class_style = ($block_info['title'] || $block_info['description']) ? '' : ' sectionSlider--noBlockInfo';
// Build UI
?>
<div class="testimonials service">
    <div class="container">
        <div class="testimonials__inner sectionSlider <?php echo $class_style; ?>">
            <!-- Block info -->
            <?php echo block_info($block_info); ?>

            <!-- Block testimonials -->
            <?php if ($list) : ?>
                <div class="service__slider">
                    <?php
                    foreach ($list as $item) :
                        if ($item['title'] && $item['image']) {
                            $args['item'] = $item;
                            get_template_part('template-parts/single/service', '', $args);
                        }
                    endforeach;
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
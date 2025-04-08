<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$list = $args['flexible']['block_content']['faculty_stories'] ?? null;
$display_type = $args['flexible']['block_content']['display_type'] ?? 'tabs';
$iframe_instagram = $args['flexible']['block_content']['iframe_instagram'] ?? null;
$class_style = ($block_info['title'] || $block_info['description']) ? '' : ' sectionSlider--noBlockInfo';
$faculty_stories_tabs = $args['flexible']['block_content']['faculty_stories_tabs'] ?? null;
?>
<div class="stories space section__bgImg slick--bg">
    <div class="container">
        <div class="stories__inner sectionSlider <?php echo $class_style; ?>">
            <!-- Block info -->
            <?php echo block_info($block_info); ?>

            <!-- Tablist -->
            <?php
            if ($display_type == 'tabs' && $faculty_stories_tabs):
                $args['list'] = $faculty_stories_tabs;
                get_template_part('template-parts/single/stories_new', null, $args);
            elseif ($display_type == 'slider' && $faculty_stories_tabs):
                $args['list'] = $faculty_stories_tabs;
                get_template_part('template-parts/single/stories_new_slider', null, $args);
            elseif ($display_type == 'iframe_instagram' && $iframe_instagram): ?>
                <div class="stories__iframe wow fadeInUp" data-wow-duration="1s">
                    <?php echo $iframe_instagram; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
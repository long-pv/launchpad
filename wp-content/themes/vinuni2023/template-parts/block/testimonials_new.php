<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$display_type_info = $args['flexible']['block_info']['display_type'] ?? '';
$background = $args['flexible']['block_content']['background'] ?? '';
$class_bg = ($background == 'yes') ? 'space slick--bg section__bgImg' : '';
$slick_bg = ($background == 'yes') ? '' : '';
$class_style = ($block_info['title'] || $block_info['description']) ? '' : ' sectionSlider--noBlockInfo';
$display_type = $args['flexible']['block_content']['display_type'] ?? null;

// Get array data of post type People
$list = [];

$list = $args['flexible']['block_content']['list'] ?? [];

// just get the id array
$data_api = array_map(function ($item) {
    return $item["people"];
}, $list);

$data = load_people_data($data_api);
// Build UI
?>
<div class="testimonials <?php echo $class_bg; ?>">
    <div class="container">
        <div class="testimonials__inner sectionSlider <?php echo $class_style; ?>">
            <!-- Block info -->
            <?php echo block_info($block_info); ?>

            <!-- Block testimonials -->
            <?php if ($list): ?>
                <div class="testimonials__slider <?php echo $slick_bg; ?>">
                    <?php
                    foreach ($list as $item):
                        if ($item['people'] && $data && $data[$item['people']]) {
                            $args['content'] = $item['quote'] ?? null;
                            $args['people'] = $data[$item['people']];
                            get_template_part('template-parts/single/testimonials_new', null, $args);
                        }
                    endforeach;
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
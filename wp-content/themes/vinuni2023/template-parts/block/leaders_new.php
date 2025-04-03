<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$leaders = $args['flexible']['block_content']['leaders'] ?? '';

$page_current_id = get_the_ID();
$data_api = array_map(function ($item) {
    return $item["people"];
}, $leaders);

$data = load_people_data($data_api);

// check attr
$target = '';
if (!is_main_site()) {
    $target = '_blank';
}
?>

<div class="leaders">
    <div class="leaders__heading sectionSlider">
        <div class="container">
            <?php echo block_info($block_info); ?>
        </div>
    </div>

    <?php if ($leaders): ?>
        <div class="leaders__slider sectionSlider">
            <?php
            foreach ($leaders as $item):
                $image = $item['image'] ?? null;
                $quote = $item['quote'] ?? null;
                $people = $item['people'] ?? null;

                if ($people && $image):
                    $item = $data[$people];

                    if ($item->title):
                        $class_post = 'cursor-default';
                        $url_post = $item->link ? $item->link : 'javascript:void(0);';
                        ?>
                        <div class="leaders__item">
                            <div class="leaders__itemInner">
                                <div class="leaders__bg section__bgImg">
                                    <div class="container">
                                        <div class="row no-gutters justify-content-end justify-content-lg-start">
                                            <div class="col-12 col-lg-6">
                                                <div class="row no-gutters">
                                                    <div class="col-12">
                                                        <div class="leaders__content">
                                                            <h3 class="leaders__title">
                                                                <?php echo $item->title; ?>
                                                            </h3>

                                                            <?php
                                                            $position = $item->position;
                                                            if ($position):
                                                                $position = implode('<br> ', $position);
                                                                ?>
                                                                <p class="leaders__desc">
                                                                    <?php echo $position; ?>
                                                                </p>
                                                                <?php
                                                            endif;
                                                            ?>

                                                            <?php if ($quote): ?>
                                                                <blockquote class="leaders__quote">
                                                                    <?php echo $quote ?>
                                                                </blockquote>
                                                            <?php endif; ?>

                                                            <?php if ($item->link): ?>
                                                                <?php echo custom_btn_link(['url' => $item->link, 'target' => $target], 'leaders__link') ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-9 col-lg-6 d-flex align-items-end leaders__imgInner">
                                                <div class="leaders__imgWrap">
                                                    <div class="leaders__img">
                                                        <img width="500" height="500" src="<?php echo $image; ?>"
                                                            alt="<?php echo $item->title; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endif;
                endif;
            endforeach;
            wp_reset_postdata();
            ?>
        </div>
    <?php endif; ?>
</div>
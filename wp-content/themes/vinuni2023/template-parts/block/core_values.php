<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$display_desc = $args['flexible']['block_content']['display_desc'] ?? '';
$title = $args['flexible']['block_content']['title'] ?? '';
$image = $args['flexible']['block_content']['image'] ?? '';
$core_values = $args['flexible']['block_content']['list'] ?? '';
$text_highlight_value = $core_values[0]['text_highlight'] ?? '';
$title_value = $core_values[0]['title'] ?? '';
$description_value = $core_values[0]['description'] ?? '';
$back_ground_img = ($display_desc == 'yes') ?
    'background: linear-gradient(180deg, rgba(0, 0, 0, 0.00) 0%, rgba(0, 0, 0, 0.80) 100%), url(' . $image . '), lightgray -68.145px -326.069px / 115.779% 216.653% no-repeat;'
    : 'background: url(' . $image . ');';
$class_core_value = $display_desc == 'yes' ? 'coreValue--desc' : '';
$check_image = $image ? '' : 'mx-auto';
?>

<div class="container">
    <?php echo block_info($block_info); ?>

    <?php if ($core_values): ?>
        <div class="coreValue <?php echo $class_core_value; ?>">
            <div class="row justify-content-lg-end">
                <div class="col-lg-8 <?php echo $check_image; ?>">
                    <div class="coreValue__inner">
                        <div class="coreValue__diamond">
                            <?php
                            foreach ($core_values as $key => $value):
                                if (($key + 1) == 6)
                                    break;
                                $first_text_hightlight = substr(trim($value['text_highlight']), 0, 1);
                                ?>
                                <div class="coreValue__item " data-index="<?php echo $key + 1; ?>">
                                    <span class="coreValue__patten"></span>
                                    <div class="coreValue__content line-1">
                                        <?php if ($value['text_highlight']): ?>
                                            <span class="coreValue__highlights wow fadeInUp" data-wow-duration="1s">
                                                <?php echo $first_text_hightlight; ?>
                                            </span>
                                        <?php endif; ?>

                                        <?php if ($value['title']): ?>
                                            <h3 class="coreValue__title line-2 wow fadeInUp" data-wow-duration="1s">
                                                <?php echo $value['title'] ?? ''; ?>
                                            </h3>
                                        <?php endif; ?>

                                        <?php if ($value['description'] && $display_desc == 'yes'): ?>
                                            <span class="coreValue__desc d-none">
                                                <?php echo $value['description'] ?? ''; ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="coreValue__diamond coreValue__diamond--highlights">
                            <div class="coreValue__item">
                                <span class="coreValue__patten"></span>
                                <?php if ($core_values[5]['title']): ?>
                                    <div class="coreValue__content wow fadeInUp" data-wow-duration="1s">
                                        <span class="coreValue__title line-4">
                                            <?php echo $core_values[5]['title']; ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- box image left hand side -->
            <?php if ($image): ?>
                <div class="coreValue__imgWrap">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="coreValue__imgInner">
                                <div class="coreValue__img" style="<?php echo $back_ground_img; ?>"></div>

                                <?php if ($display_desc == 'yes'): ?>
                                    <div class="coreValue__imgContentWrap coreValue__imgItem--1">
                                        <?php if ($title): ?>
                                            <div class="coreValue__imgTitle wow fadeInUp" data-wow-duration="1s">
                                                <?php echo $title; ?>
                                            </div>
                                        <?php endif; ?>

                                        <div class="coreValue__imgContent">
                                            <?php if ($core_values[0]['text_highlight'] && $core_values[0]['title']): ?>
                                                <div class="coreValue__imgHighlights d-inline-flex line-1 wow fadeInUp" data-wow-duration="1s">
                                                    <span class="coreValue__textHighlight">
                                                        <?php echo $core_values[0]['text_highlight']; ?>
                                                    </span>
                                                    <span class="coreValue__textTitle line-1">
                                                        <?php echo ': ' . $core_values[0]['title']; ?>
                                                    </span>
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($core_values[0]['description']): ?>
                                                <div class="coreValue__imgDesc line-2 wow fadeInUp" data-wow-duration="1s">
                                                    <?php echo $description_value; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
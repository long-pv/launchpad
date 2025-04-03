<?php
// Get values
// slider_bg : Slider background
// slider : Slider
// bg_img : Background image
// video : Video
// banner_news : News
$select_style = $args['flexible']['select_style'] ?? '';
$sliders = $args['flexible']['slider_bg'] ?? '';
$background_image = $args['flexible']['background_image'] ?? '';
$video = $args['flexible']['banner_video'] ?? '';
$banner_news = $args['flexible']['banner_news'] ?? [];
$class_wrapper = $select_style == 'slider_bg' ? 'bannerWrapper--bg' : '';
$class_banner = $select_style == 'slider_bg' ? 'banner--bg' : '';
$class_content = ($select_style == 'slider' || $select_style == 'banner_news') ? 'banner__content--slider' : '';
$color_theme = get_field('color_theme', 'option') ?? null;
$style_slider_bg = ($select_style == 'slider' || $select_style == 'banner_news') ? 'style="background-color: rgba(' . hexToRgb($color_theme) . ', 0.85);"' : '';
$class_col = $select_style == 'slider_bg' ? 'col-6' : 'col-lg-9';
$data_fade = $select_style == 'slider_bg' ? 'true' : 'false';
?>

<?php if ($select_style !== 'bg_img' && $select_style !== 'video') : ?>
    <div class="bannerWrapper <?php echo $class_wrapper; ?>">
        <div class="banner <?php echo $class_banner; ?> bannerSlider" data-fade="<?php echo $data_fade; ?>">
            <?php
            if ($select_style !== 'banner_news' && $sliders) :
                foreach ($sliders as $item) :
                    if ($item['background']) :
            ?>
                        <div class="banner__item banner__item--slider">
                            <img width="1440" height="400" class="banner__img" src="<?php echo $item['background']; ?>" alt="<?php echo $item['title']; ?>">
                            <div class="banner__inner">
                                <div class="container">
                                    <div class="row no-gutters banner__innerRow">
                                        <div class="<?php echo $class_col; ?>">
                                            <?php if ($item['title'] || ($select_style == 'slider' && $item['description']) || $item['link']) : ?>
                                                <div <?php echo $style_slider_bg; ?> class="banner__content <?php echo $class_content; ?>">
                                                    <?php if ($item['title']) : ?>
                                                        <div class="banner__title line-4">
                                                            <?php echo custom_title($item['title']); ?>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if ($select_style == 'slider' && $item['description']) : ?>
                                                        <p class="banner__desc line-3">
                                                            <?php echo $item['description']; ?>
                                                        </p>
                                                    <?php endif; ?>

                                                    <?php echo custom_btn_link($item['link'], 'banner__link', true); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endif;
                endforeach;
            else :
                if ($banner_news) :
                    foreach ($banner_news as $item) :
                        $newsitem = $item['news'] ?? null;
                        if ($item['banner_image']) :
                        ?>
                            <div class="banner__item banner__item--slider">
                                <img width="1440" height="400" class="banner__img" src="<?php echo $item['banner_image']; ?>" alt="<?php echo $newsitem ? $newsitem->post_title : ''; ?>">
                                <div class="banner__inner">
                                    <div class="container">
                                        <div class="row no-gutters banner__innerRow">
                                            <div class="<?php echo $class_col; ?>">
                                                <?php if ($newsitem) :
                                                    $newsitemlink = [
                                                        'url' => get_permalink($newsitem->ID),
                                                        'target' => '_self',
                                                        'title' => ''
                                                    ];
                                                ?>
                                                    <div <?php echo $style_slider_bg; ?> class="banner__content <?php echo $class_content; ?>">
                                                        <div class="banner__title line-4">
                                                            <?php echo custom_title($newsitem->post_title); ?>
                                                        </div>

                                                        <?php echo custom_btn_link($newsitemlink, 'banner__link', true); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            <?php
                        endif;
                    endforeach;
                endif;
            endif;
            ?>
        </div>
    </div>
<?php elseif ($select_style == 'video' && $video) : ?>
    <div class="bannerVideo">
        <div class="bannerVideo__wrap">
            <video muted loop autoplay playsinline>
                <source src="<?php echo $video; ?>" type="video/mp4">
            </video>
        </div>
    </div>
<?php elseif ($select_style == 'bg_img') : ?>
    <?php if ($background_image) : ?>
        <img width="1000" height="400" class="banner__imgSingle" src="<?php echo $background_image; ?>" alt="banner">
    <?php endif; ?>
<?php endif; ?>
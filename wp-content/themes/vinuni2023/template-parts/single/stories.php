<?php
$display_detail = get_field('display_details', get_the_ID()) ?? 'yes';
$link_page = get_field('link_page', get_the_ID()) ?? [];
$link = [
    'url'    => ($display_detail == 'yes') ? get_permalink() : ($link_page['url'] ?? ''),
    'target' => '_self',
];
?>

<div class="storiesItem">
    <div class="row">
        <div class="col-lg-6">
            <div class="storiesItem__content">
                <h3 class="storiesItem__title wow fadeInUp" data-wow-duration="1s">
                    <?php the_title(); ?>
                </h3>

                <?php if (get_field('position')): ?>
                    <div class="storiesItem__position wow fadeInUp" data-wow-duration="1s">
                        <?php echo get_field('position'); ?>
                    </div>
                <?php endif; ?>

                <?php if (get_field('content')): ?>
                    <blockquote class="storiesItem__quote wow fadeInUp"  data-wow-duration="1s">
                        <?php echo get_field('content'); ?>
                    </blockquote>
                <?php endif; ?>

                <?php
                if ($link && !empty($link['url'])) :
                    echo custom_btn_link($link, 'storiesItem__link');
                endif;
                ?>
            </div>
        </div>
        <div class="col-lg-6 mt-4 mt-lg-0">
            <?php
            $group_iframe = get_field('group_iframe') ?? null;
            if (isset($group_iframe['show_iframe']) && $group_iframe['show_iframe'] == 'youtube' && $group_iframe['iframe_youtube']):
                $attr = 'src="' . $group_iframe['iframe_youtube'] . '?controls=0&autoplay=0&mute=1&playsinline=1&loop=1"';
                ?>
                <div class="storiesItem__video">
                    <iframe <?php echo $attr; ?>></iframe>
                </div>
            <?php elseif (has_post_thumbnail()): ?>
                <div class="row no-gutters justify-content-center">
                    <div class="col-md-6 col-lg-12">
                        <div class="imgGroup imgGroup--noEffect storiesItem__img">
                            <img width="300" height="300" src="<?php echo get_the_post_thumbnail_url(); ?>"
                                alt="<?php the_title(); ?>">
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
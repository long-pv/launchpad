<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package launch-pad
 */

// header template
get_header();
?>
<div class="container_xxx">
    <div class="page_wrap">
        <div class="page_inner">
            <div class="container">
                <?php
                $banner = get_field('banner') ?? '';
                if ($banner['image']):
                    ?>
                    <div class="banner" style="background-image: url('<?php echo $banner['image']; ?>');">
                        <div class="banner__content">
                            <div class="banner__social">
                                <?php if ($banner['social_network']['facebook']): ?>
                                    <a target="_blank" href="<?php echo $banner['social_network']['facebook']; ?>"
                                        class="banner__social-icon banner__social-icon--facebook"></a>
                                <?php endif; ?>
                                <?php if ($banner['social_network']['youtube']): ?>
                                    <a target="_blank" href="<?php echo $banner['social_network']['youtube']; ?>"
                                        class="banner__social-icon banner__social-icon--youtube"></a>
                                <?php endif; ?>
                                <?php if ($banner['social_network']['telegram']): ?>
                                    <a target="_blank" href="<?php echo $banner['social_network']['telegram']; ?>"
                                        class="banner__social-icon banner__social-icon--telegram"></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php
                $title_block = get_field('title_block') ?: get_the_title();
                ?>
                <h2 class="sec_title">
                    <?php echo $title_block; ?>
                </h2>

                <div class="page_body">
                    <div class="page_scroll">
                        <?php
                        get_template_part('template-parts/content-flexible');
                        ?>
                    </div>
                </div>
            </div>

            <div class="page_bottom">
                <div class="container">
                    <div class="inner">
                        <a href="javascript:void(0);" class="logo">
                            <?php $logo_url = get_template_directory_uri() . '/assets/images/logo_vin.svg'; ?>
                            <img src="<?php echo $logo_url; ?>" alt="logo">
                        </a>

                        <?php
                        $copyright = get_field('copyright', 'option') ?? '';
                        if ($copyright) {
                            ?>
                            <div class="copyright">
                                <?php echo $copyright; ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function ($) {
        adjustTabBodyHeight();

        $(window).on('resize', function () {
            adjustTabBodyHeight();
        });

        function adjustTabBodyHeight() {
            var windowWidth = $(window).width();

            if (windowWidth >= 1200) {
                var windowHeight = $(window).height();
                var headerHeight = $('.banner').outerHeight(true) || 0;
                var titleHeight = $('.sec_title').outerHeight(true) || 0;
                var otherPadding = 180; // tuỳ chỉnh theo giao diện
                var usedHeight = headerHeight + titleHeight + otherPadding;
                var availableHeight = windowHeight - usedHeight;

                $('.page_scroll').css({
                    'max-height': availableHeight + 'px',
                    'min-height': availableHeight + 'px',
                    'overflow-y': 'auto',
                    'overflow-x': 'hidden',
                });
            } else {
                // Reset lại để không giới hạn chiều cao khi nhỏ hơn 1200
                $('.page_scroll').css({
                    'max-height': 'none',
                    'min-height': 'none',
                    'overflow-y': 'visible',
                    'overflow-x': 'visible',
                });
            }
        }
    });
</script>

<?php
// footer template
get_footer();

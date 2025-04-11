<?php
/**
 * Template Name: Student Club
 * The template for displaying all pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package launch-pad
 */

get_header();
?>

<div class="container_xxx">
    <div class="page_wrap">
        <div class="page_inner">
            <div class="container">
                <h2 class="sec_title">Quick links</h2>
                <div class="page_body">
                    <div class="page_scroll">
                        <?php
                        $terms = get_terms([
                            'taxonomy' => 'clubs_category',
                            'hide_empty' => true,
                        ]);
                        ?>

                        <?php if (!empty($terms) && !is_wp_error($terms)): ?>
                            <div class="accordion" id="clubsAccordion">
                                <?php foreach ($terms as $index => $term): ?>
                                    <?php
                                    $clubs = new WP_Query([
                                        'post_type' => 'clubs',
                                        'posts_per_page' => -1,
                                        'tax_query' => [
                                            [
                                                'taxonomy' => 'clubs_category',
                                                'field' => 'term_id',
                                                'terms' => $term->term_id,
                                            ],
                                        ],
                                    ]);
                                    ?>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading-<?php echo esc_attr($term->term_id); ?>">
                                            <button class="accordion-button <?php echo $index !== 0 ? 'collapsed' : ''; ?>"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse-<?php echo esc_attr($term->term_id); ?>"
                                                aria-expanded="<?php echo $index === 0 ? 'true' : 'false'; ?>"
                                                aria-controls="collapse-<?php echo esc_attr($term->term_id); ?>">
                                                <?php echo esc_html($term->name); ?>
                                            </button>
                                        </h2>

                                        <div id="collapse-<?php echo esc_attr($term->term_id); ?>"
                                            class="accordion-collapse collapse <?php echo $index === 0 ? 'show' : ''; ?>"
                                            aria-labelledby="heading-<?php echo esc_attr($term->term_id); ?>"
                                            data-bs-parent="#clubsAccordion">
                                            <div class="accordion-body">
                                                <div class="row gallery">
                                                    <?php if ($clubs->have_posts()): ?>
                                                        <?php while ($clubs->have_posts()):
                                                            $clubs->the_post(); ?>
                                                            <?php $image_url = get_the_post_thumbnail_url(get_the_ID(), 'medium_large'); ?>

                                                            <div class="col-lg-4 mb-4 gallery__item">
                                                                <div class="gallery__image-wrapper">
                                                                    <?php if ($image_url): ?>
                                                                        <img src="<?php echo esc_url($image_url); ?>"
                                                                            alt="<?php the_title_attribute(); ?>" class="gallery__image">
                                                                    <?php else: ?>
                                                                        <div class="gallery__placeholder bg-secondary text-white text-center d-flex align-items-center justify-content-center"
                                                                            style="height: 200px;">
                                                                            No image
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <p class="text-center mt-2 gallery__title"><?php the_title(); ?></p>
                                                            </div>
                                                        <?php endwhile;
                                                        wp_reset_postdata(); ?>
                                                    <?php else: ?>
                                                        <p class="text-muted">No clubs found in this category.</p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="page_bottom">
                <div class="container">
                    <div class="inner">
                        <a href="javascript:void(0);" class="logo">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo_vin.svg"
                                alt="logo">
                        </a>

                        <?php
                        $copyright = get_field('copyright', 'option');
                        if ($copyright):
                            ?>
                            <div class="copyright">
                                <?php echo $copyright; ?>
                            </div>
                        <?php endif; ?>
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
                var otherPadding = 180;
                var usedHeight = headerHeight + titleHeight + otherPadding;
                var availableHeight = windowHeight - usedHeight;

                $('.page_scroll').css({
                    'max-height': availableHeight + 'px',
                    'min-height': availableHeight + 'px',
                    'overflow-y': 'auto',
                    'overflow-x': 'hidden',
                });
            } else {
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

<?php get_footer(); ?>
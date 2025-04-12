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

<div class="container_xx">
    <div class="page_wrap">
        <div class="page_inner">
            <div class="container">
                <?php
                $title_block = get_field('title_block') ?: get_the_title();
                ?>
                <h2 class="sec_title">
                    <?php echo $title_block; ?>
                
                    <?php $class_page_mark = (isset($_COOKIE['bookmarked_pages']) && in_array(get_the_ID(), json_decode(stripslashes($_COOKIE['bookmarked_pages']), true) ?? [])) ? 'active' : ''; ?>
                    <div class="page_mark <?php echo $class_page_mark; ?>" data-id="<?php echo get_the_ID(); ?>"></div>
                </h2>

                <div class="page_body">
                    <div class="page_scroll d-block">
                        <?php
                        $data = get_field('heading') ?? '';
                        if($data) {
                        ?>
                            <div class="block_heading block_heading_page_clubs">
                                <div class="row">
                                    <?php if ($data['image']): ?>
                                        <div class="col-12 col-md-auto">
                                            <img class="block_heading_img" src="<?php echo $data['image']; ?>" alt="<?php echo $data['title']; ?>">
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-12 col-md">
                                        <div class="content">
                                            <?php if ($data['title']): ?>
                                                <div class="title">
                                                    <?php echo $data['title']; ?>
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($data['description']): ?>
                                                <div class="desc">
                                                    <?php echo $data['description']; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="list_post__list">
                            <?php
                            if (have_posts()):
                                while (have_posts()):
                                    the_post();
                                    ?>
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
                                                            <div class="row club_row">
                                                                <?php if ($clubs->have_posts()): ?>
                                                                    <?php while ($clubs->have_posts()):
                                                                        $clubs->the_post(); ?>
                                                                        <?php $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>

                                                                        <div class="col-12 col-md-4 col-lg-3">
                                                                            <a href="<?php echo get_permalink(); ?>" class="handbook">
                                                                                <div class="handbook__image">
                                                                                    <img src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>">
                                                                                </div>
                                                                                <h3 class="handbook__title">
                                                                                    <?php the_title(); ?>
                                                                                </h3>
                                                                            </a>
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
                                    <?php
                                endwhile;
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php get_template_part('template-parts/page_bottom'); ?>
        </div>
    </div>
</div>
<?php
get_footer();

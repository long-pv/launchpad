<?php
/**
 *
 * Template name: Launch Pad
 *
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package launchpad
 */

get_header();
?>
<script type="text/javascript" src="//www.trumba.com/scripts/spuds.js"></script>
<?php
get_template_part('template-parts/content-flexible');
?>
<section class="boxContent">
    <div class="container">
        <?php
        $response = wp_remote_get('https://vinuni.edu.vn/research/wp-json/wp/v2/posts?per_page=1&categories=3');
        if (is_wp_error($response)) {
            echo 'Không thể lấy dữ liệu.';
            return;
        }
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);
        ?>
        <div class="row boxContent__row">
            <?php if (! empty($data) && is_array($data)) :
                $data = $data[0];
                $featured_media_href = '';
                if (isset($data['_links']['wp:featuredmedia'][0]['href'])) {
                    $featured_media_href = $data['_links']['wp:featuredmedia'][0]['href'];
                }
                $image_url = '';
                if ($featured_media_href) {
                    $media_response = wp_remote_get($featured_media_href);

                    if (! is_wp_error($media_response)) {
                        $media_body = wp_remote_retrieve_body($media_response);
                        $media_data = json_decode($media_body, true);

                        if (isset($media_data['source_url'])) {
                            $image_url = esc_url($media_data['source_url']);
                        }
                    }
                }

            ?>
                <div class="col-lg-4">
                    <h3 class="boxContent__title">
                        <?php echo get_field('student_research_title') ?: __('Student Research', 'launchpad');; ?>
                    </h3>
                    <div class="newsItem">
                        <div class="newsItem__image imgGroup">
                            <img src="<?php echo $image_url; ?>" alt="<?php echo $data['title']['rendered'] ?>">
                            <a href="<?php echo $data['link'] ?>" target="_blank"></a>
                        </div>
                        <div class="newsItem__content">
                            <h4 class="newsItem__title h6">
                                <a href="<?php echo $data['link'] ?>" class="line-2" target="_blank"><?php echo $data['title']['rendered'] ?></a>
                            </h4>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-lg-4">
                <h3 class="boxContent__title">
                    <?php echo get_field('events_title') ?: __('Events', 'launchpad'); ?>
                </h3>
                <div class="boxEvents">
                    <script type="text/javascript">
                        $Trumba.addSpud({
                            webName: "vinuni",
                            spudType: "upcomingvcrawler",
                            teaserBase: "https://vinuni.trumba.com"
                        });
                    </script>
                </div>
            </div>
            <?php
            $box_images = get_field('box_images') ?? '';
            if ($box_images):
                foreach ($box_images as $boxitem) :
            ?>
                    <div class="col-lg-4">
                        <div class="boxImages">
                            <?php echo $boxitem['title'] ? '<h3 class="boxContent__title">' . $boxitem['title'] . '</h3>' : '' ?>
                            <?php if ($boxitem['type'] == 'only_image'):  ?>
                                <div class="boxImages__item imgGroup">
                                    <img src="<?php echo $boxitem['image']; ?>" alt="<?php echo $boxitem['title']; ?>">
                                    <?php echo $boxitem['link'] ? '<a href="' . $boxitem['link']['url'] . '" target="' . ($boxitem['link']['target'] ?: '_self') . '"></a>' : '' ?>
                                </div>
                                <?php else:
                                if ($boxitem['list']):
                                ?>
                                    <div class="boxImages__Grid">
                                        <?php
                                        foreach ($boxitem['list'] as $item):
                                        ?>
                                            <div class="boxImages__item imgGroup">
                                                <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>">
                                                <?php echo $item['link'] ? '<a href="' . $item['link']['url'] . '" target="' . ($item['link']['target'] ?: '_self') . '"></a>' : '' ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                            <?php
                                endif;
                            endif; ?>
                        </div>
                    </div>
            <?php endforeach;
            endif; ?>
            <div class="col-lg-4">
                <?php
                if (is_active_sidebar('custom-sidebar-weather')) {
                    dynamic_sidebar('custom-sidebar-weather');
                }
                ?>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();

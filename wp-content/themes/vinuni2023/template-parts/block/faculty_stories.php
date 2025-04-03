<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$list = $args['flexible']['block_content']['faculty_stories'] ?? null;
$display_type = $args['flexible']['block_content']['display_type'] ?? 'tabs';
$iframe_instagram = $args['flexible']['block_content']['iframe_instagram'] ?? null;
$class_style = ($block_info['title'] || $block_info['description']) ? '' : ' sectionSlider--noBlockInfo';
?>
<div class="stories space section__bgImg slick--bg">
    <div class="container">
        <div class="stories__inner sectionSlider <?php echo $class_style; ?>">
            <!-- Block info -->
            <?php echo block_info($block_info); ?>

            <!-- Tablist -->
            <?php
            if ($display_type == 'tabs' && $list):
                $arr_post = [];
                // Filter posts by category
                foreach ($list as $post) {
                    if ($post && $post->post_status == 'publish') {
                        $terms = get_the_terms($post->ID, 'faculty_stories_category');

                        if ($terms) {
                            foreach ($terms as $term) {
                                if (!array_key_exists($term->term_id, $arr_post)) {
                                    $arr_post[$term->term_id]['post'] = $post;
                                    $arr_post[$term->term_id]['cat'] = $term;
                                    break;
                                }
                            }
                        }
                    }
                }

                $count_arr = count($arr_post);

                if ($count_arr > 0):
                    ?>
                    <div class="stories__tabList">
                        <div class="selecDropdown">
                            <ul class="nav nav-tabs stories__tabSlider" role="tablist"
                                data-slide="<?php echo ($count_arr < 4) ? $count_arr : 4; ?>">
                                <?php
                                $index = 1;
                                $html_content = '';
                                foreach ($arr_post as $key => $item):
                                    $attr = 'class="nav-link ' . (($index == 1) ? 'active' : '') . '" data-toggle="tab" href="#tabs-' . $key . '" role="tab"';
                                    ?>
                                    <li class="nav-item stories__tabItem">
                                        <a data-mh="stories__tabItem" <?php echo $attr; ?>>
                                            <?php echo $item['cat']->name; ?>
                                        </a>
                                    </li>
                                    <?php
                                    $index++;
                                endforeach;
                                ?>
                            </ul>
                        </div>

                        <div class="tab-content stories__tabContent">
                            <?php
                            $index = 1;
                            foreach ($arr_post as $key => $item):
                                $post = $item['post'];
                                setup_postdata($post);
                                $attr = 'class="tab-pane ' . (($index == 1) ? 'active' : '') . '" id="tabs-' . $key . '" role="tabpanel"';
                                ?>
                                <div <?php echo $attr; ?>>
                                    <?php get_template_part('template-parts/single/stories'); ?>
                                </div>
                                <?php
                                $index++;
                            endforeach;
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php elseif ($display_type == 'slider' && $list): ?>
                <div class="stories__slider">
                    <?php
                    foreach ($list as $post):
                        if ($post && $post->post_status == 'publish' && $post->post_title):
                            ?>
                            <div>
                                <?php get_template_part('template-parts/single/stories'); ?>
                            </div>
                            <?php
                        endif;
                    endforeach;
                    ?>
                </div>
            <?php elseif ($display_type == 'iframe_instagram' && $iframe_instagram): ?>
                <div class="stories__iframe wow fadeInUp" data-wow-duration="1s">
                    <?php echo $iframe_instagram; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
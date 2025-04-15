<?php

/**
 *  * Template Name: Home
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
<div class="container_xx">
    <div class="page_wrap">
        <div class="page_inner">
            <?php
            $banner = get_field('banner') ?? '';
            var_dump($banner['social_network']);
            if ($banner['image']):
                ?>
                <div class="banner" style="background-image: url('<?php echo $banner['image']; ?>');">
                    <?php if (array_filter($banner['social_network'])): ?>
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
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="container">
                <?php
                $title_block = get_field('title_block') ?: get_the_title();
                ?>
                <h1 class="sec_title">
                    <?php echo $title_block; ?>
                </h1>

                <?php
                $quick_links = get_field('quick_links') ?? [];
                if ($quick_links):

                    ?>
                    <div class="tabs_home">
                        <div class="tabs_home_mb">
                            <select name="tabs_title">
                                <?php
                                foreach ($quick_links as $key => $item):
                                    ?>
                                    <option value="nav-<?php echo $key; ?>-tab"
                                        data-url="<?php echo ($item['display_type'] == '2' && $item['external_link']) ? $item['external_link'] : ''; ?>">
                                        <?php echo $item['title']; ?>
                                    </option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div>

                        <div class="nav row tabs_home_pc" id="nav-tab" role="tablist">
                            <?php
                            foreach ($quick_links as $key => $item):
                                ?>
                                <button class="col-lg-4 nav-link <?php echo $key == 0 ? 'active' : ''; ?>"
                                    id="nav-<?php echo $key; ?>-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-<?php echo $key; ?>" type="button" role="tab"
                                    aria-controls="nav-<?php echo $key; ?>"
                                    aria-selected="<?php echo $key == 0 ? 'true' : 'false'; ?>">
                                    <?php
                                    if ($item['display_type'] == '2') {
                                        ?>
                                        <a target="_blank" href="<?php echo $item['external_link'] ?? '#'; ?>">
                                            <?php echo $item['title']; ?>
                                        </a>
                                        <?php
                                    } else {
                                        echo $item['title'];
                                    }
                                    ?>
                                </button>
                                <?php
                            endforeach;
                            ?>
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            <?php
                            foreach ($quick_links as $key => $item):
                                ?>
                                <div class="tab-pane fade <?php echo $key == 0 ? 'active show' : ''; ?>"
                                    id="nav-<?php echo $key; ?>" role="tabpanel" aria-labelledby="nav-<?php echo $key; ?>-tab">
                                    <?php
                                    if ($item['display_type'] == '1') {
                                        ?>
                                        <div class="tab_body editor">
                                            <div class="tab_scroll">
                                                <?php echo $item['static_content']; ?>
                                            </div>
                                        </div>
                                        <?php
                                    } elseif ($item['display_type'] == '0') {
                                        ?>
                                        <div class="tab_body">
                                            <div class="tab_scroll">
                                                <div class="row">
                                                    <?php
                                                    foreach ($item['list_handbook'] as $key => $item_2) {
                                                        ?>
                                                        <div class="col-6 col-lg-3">
                                                            <a href="<?php echo $item_2['url'] ?: 'javascript:void(0);' ?>"
                                                                class="handbook">
                                                                <div class="handbook__image">
                                                                    <img src="<?php echo $item_2['image'] ?? '' ?>"
                                                                        alt="International Student Handbook">
                                                                </div>
                                                                <h3 class="handbook__title">
                                                                    <?php echo $item_2['title'] ?? '' ?>
                                                                </h3>
                                                            </a>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                            endforeach;
                            ?>
                        </div>
                    </div>
                    <?php
                endif;
                ?>
            </div>

            <?php get_template_part('template-parts/page_bottom'); ?>
        </div>
    </div>
</div>

<?php
// footer template
get_footer();

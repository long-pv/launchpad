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
<?php
$page_main = get_field('page_main');
?>

<!-- CARD CLUB -->
<?php
if (!empty($page_main)):
    foreach ($page_main as $layout):
        if ($layout['acf_fc_layout'] === 'card_club'):

            // Lấy dữ liệu từ ACF
            $image_id = $layout['card_image'] ?? '';
            $image_url = wp_get_attachment_image_url($image_id, 'full');
            $description = $layout['card_description'] ?? '';
            $title = $layout['card_title'] ?? 'Contact information';
            $phone = $layout['card_phone'] ?? '';
            $email = $layout['card_email'] ?? '';
            $facebook = $layout['card_facebook'] ?? '';
?>
            <!-- Card Club -->
            <section class="secSpace">
                <div class="container">
                    <div class="card_club__inner">
                        <div class="card_club">
                            <div class="row">
                                <div class="col-4">
                                    <div class="card_club__image-wrapper">
                                        <?php if ($image_url): ?>
                                            <img src="<?php echo esc_url($image_url); ?>" alt="Vinista Club Logo"
                                                class="card_club__image" />
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="card_club__content">
                                        <?php if ($description): ?>
                                            <p class="card_club__description">
                                                <?php echo esc_html($description); ?>
                                            </p>
                                        <?php endif; ?>
                                        <div class="card_club__contact">
                                            <h3 class="card_club__contact_title"><?php echo esc_html($title); ?></h3>
                                            <ul class="card_club__contact_list">
                                                <?php if ($phone): ?>
                                                    <li>
                                                        <span class="card_club__contact_list--desc">Phone:</span>
                                                        <span
                                                            class="card_club__contact_list--phone"><?php echo esc_html($phone); ?></span>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if ($email): ?>
                                                    <li>
                                                        <span class="card_club__contact_list--desc">Email:</span>
                                                        <span
                                                            class="card_club__contact_list--mail"><?php echo esc_html($email); ?></span>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if ($facebook): ?>
                                                    <li>
                                                        <span class="card_club__contact_list--desc">Facebook:</span>
                                                        <a href="<?php echo esc_url($facebook); ?>"
                                                            class="card_club__contact_list--facebook"><?php echo esc_html($facebook); ?></a>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
<?php
        endif;
    endforeach;
endif;
?>

<!-- GALLERY -->


<!--  -->
<div class="container_xxx">
    <div class="page_wrap">
        <div class="page_inner">
            <?php
            get_template_part('template-parts/content-flexible');
            ?>
        </div>
    </div>
</div>

<?php
// footer template
get_footer();

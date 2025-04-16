<?php
// Check user login
$current_user = wp_get_current_user();
$hasUser = $current_user->exists();

if (!empty($args['category'])):
    $category = $args['category'];

    $linkItems = get_posts(
        array(
            'post_type' => 'link',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'category_link',
                    'field' => 'id',
                    'terms' => $category->term_id,
                ),
            ),
        )
    );
    ?>
    <div class="portal__item" data-mh="categoryItem">
        <div class="portal__titleCategory">
            <?php _e($category->name ?? '', 'launchpad'); ?> <span class="portal__countItem">(<?php echo count($linkItems); ?>)</span>
        </div>
        <ul class="portal__listItem">
            <?php
            foreach ($linkItems as $item):
                setup_postdata($item);
                $isLockLink = get_field('need_login', $item->ID) ?? false;
                $linkId = $item->ID;
                $redirectUrl = (!$isLockLink || $hasUser) ? esc_url($item->url) : '#';

                ?>
                <li class="link_count">
                    <img width="24" height="24" class="portal__icon" alt="<?php echo $isLockLink ? 'Lock link icon' : 'External link icon'; ?>"
                         src="<?php echo get_template_directory_uri() . ($isLockLink ? '/assets/images/icon/lock-link-icon.svg' : '/assets/images/icon/external-link-icon.svg'); ?>">

                    <?php if ($isLockLink && !$hasUser): ?>
                        <span id="link_count__<?php echo esc_attr($linkId); ?>" class="portal__link"
                           onclick="window.wpo365.pintraRedirect.toMsOnline('', location.href, '', '', false, document.getElementById('selectedTenant') ? document.getElementById('selectedTenant').value : null); return false;">
                            <?php echo $item->post_title ?? ''; ?>
                        </span>
                    <?php else: ?>
                        <a id="link_count__<?php echo esc_attr($linkId); ?>" class="portal__link"
                           href="<?php echo $redirectUrl; ?>"
                           target="_blank">
                            <?php echo $item->post_title ?? ''; ?>
                        </a>
                    <?php endif; ?>
                </li>
            <?php
            endforeach;
            wp_reset_postdata();
            ?>
        </ul>
        <?php if ($linkItems && count($linkItems) > 5): ?>
            <div class="portal__view">
                <span class="portal__view--more"><?php _e('View More', 'launchpad'); ?></span>
                <span class="portal__view--less"><?php _e('View Less', 'launchpad'); ?></span>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>
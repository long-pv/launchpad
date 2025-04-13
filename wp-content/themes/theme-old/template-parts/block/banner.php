<?php
$banners = $args['flexible']['banner'] ?? [];
$classSearch = empty($banners) ? 'banner--none' : '';
?>
<div class="banner <?php echo $classSearch; ?>">
    <?php if (!empty($banners)): ?>
        <div class="bannerSlider">
            <?php foreach ($banners as $banner): ?>
                <div class="banner__item banner__item--slider">
                    <?php if ($banner['image']): ?>
                        <img width="1440" height="400" class="banner__img" src="<?php echo $banner['image'] ?>" alt="<?php echo $banner['title'] ?? 'Banner'; ?>">
                    <?php else: ?>
                        <img width="1440" height="400" class="banner__img" src="<?php echo get_template_directory_uri() . '/assets/images/image-default.png'; ?>" alt="Banner">
                    <?php endif; ?>
                    <div class="banner__inner">
                        <div class="container">
                            <div class="banner__innerRow">
                                <div class="banner__content">
                                    <?php if ($banner['title']): ?>
                                        <div class="banner__title line-2">
                                            <?php echo $banner['title']; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Box search -->
    <div class="banner__boxSearch">
        <form method="get" action="" role="search">
            <input type="text" class="banner__searchInput" aria-label="search"
                   aria-describedby="search-addon" name="s" placeholder="<?php _e('Keyword', 'launchpad'); ?>">
            <input type="text" class="d-none" name="q">
            <span class="banner__searchBtn"><?php _e('Search', 'launchpad'); ?></span>
            <span class="banner__clearBtn">×</span>
        </form>
    </div>
    <!-- /End box search -->
</div>
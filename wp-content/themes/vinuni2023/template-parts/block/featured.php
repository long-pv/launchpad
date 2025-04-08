<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$list_featured = $args['flexible']['block_content']['list'] ?? '';
$key_arr = ['icon', 'title', 'description'];
?>
<div class="<?php echo get_container_class() ?>">
    <?php echo block_info($block_info); ?>

    <?php if ($list_featured && custom_count_array($list_featured, $key_arr, false) > 0): ?>
        <div class="featured">
            <div class="row featured__gutters">
                <?php
                foreach ($list_featured as $item):
                    if ($item['icon'] || $item['title'] || $item['description']):
                ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="featured__item">
                            <div class="featured__icon" data-mh="featured__icon">
                                <?php if ($item['icon']): ?>
                                    <img width=64 height=64 src="<?php echo $item['icon']; ?>" alt="<?php echo $item['title']; ?>">
                                <?php endif; ?>
                            </div>
                            <div class="featured__title" data-mh="featured__title">
                                <?php
                                if ($item['title']):
                                    echo $item['title'];
                                endif;
                                ?>
                            </div>
                            <div class="featured__desc" data-mh="featured__desc">
                                <?php
                                if ($item['description']):
                                    echo $item['description'];
                                endif;
                                ?>
                            </div>
                            <?php if ($item['link']): ?>
                                <div class="featured__btn">
                                    <a href="<?php echo $item['link']['url'] ?: 'javascript:void(0);'; ?>" class="btnCTA"
                                        target="<?php echo $item['link']['target'] ?: '_self'; ?>" data-mh="featured__btn">
                                        <?php echo $item['link']['title'] ?: __('See more', 'clvinuni'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php
                    endif;
                endforeach;
                ?>
            </div>
        </div>
    <?php endif; ?>
</div>

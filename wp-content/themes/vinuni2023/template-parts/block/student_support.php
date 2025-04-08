<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$contact_info = $args['flexible']['block_content']['contact_info'] ?? [];
?>
<div class="studentSupport">
    <div class="<?php echo get_container_class(); ?>">
        <?php echo block_info($block_info); ?>

        <?php if ($contact_info): ?>
        <div class="studentSupport__inner">
            <?php foreach ($contact_info as $key_item => $item): ?>
            <div class="studentSupport__item wow fadeInUp" data-wow-duration="1s">
                <div class="studentSupport__img">
                    <?php if ($item['icon']): ?>
                    <img width="24" height="24" src="<?php echo $item['icon']; ?>"
                        alt="<?php echo $item['title'] ?: 'Icon-' . ($key_item + 1); ?>">
                    <?php endif; ?>
                </div>
                <div class="studentSupport__content">
                    <?php if ($item['content']): ?>
                    <div class="editor">
                        <?php echo $item['content']; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>
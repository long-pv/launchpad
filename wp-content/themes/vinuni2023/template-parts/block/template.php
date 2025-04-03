<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$background = $args['flexible']['block_content']['background'] ?? '';
$content = $args['flexible']['block_content']['content'] ?? '';
$class_background = $background == "yes" ? 'template--bg space section--bg' : '';

// Build UI
?>
<div class="template <?php echo $class_background; ?>">
    <div class="container">
        <?php echo block_info($block_info); ?>

        <?php if ($content): ?>
            <div class="template__content wow fadeInUp"  data-wow-duration="1s">
                <?php echo custom_editor($content); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
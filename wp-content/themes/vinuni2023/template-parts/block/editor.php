<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$content_editor = $args['flexible']['block_content']['content_editor'];

// Build UI
?>
<div class="<?php echo get_container_class() ?>">
    <!-- Block info -->
    <?php echo block_info($block_info); ?>
    <!-- Block editor -->
    <div class="editor">
        <?php echo $content_editor; ?>
    </div>
</div>
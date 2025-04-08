<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$form = $args['flexible']['block_content']['contact_form'] ?? '';

?>
<div class="sectionForm">
    <div class="container">
        <?php echo block_info($block_info); ?>

        <?php if ($form): ?>
            <div class="row">
                <div class="col-lg-8">
                    <?php echo do_shortcode("[contact-form-7 id=\"$form\" html_class=\"sectionForm__form\"]"); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
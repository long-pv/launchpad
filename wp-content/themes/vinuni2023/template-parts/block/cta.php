<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$title = $args['flexible']['block_content']['title'] ?? '';
$content = $args['flexible']['block_content']['content'] ?? '';
$button_cta = $args['flexible']['block_content']['button_cta'] ?? [];

// Build UI
?>
<div class="container">
    <div class="cta space section__bgImg--left">
        <div class="row">
            <div class="col-lg-6">
                <?php if ($title) : ?>
                    <div class="wow fadeInUp" data-wow-duration="1s">
                        <?php echo custom_editor($title, 'cta__title'); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-6">
                <?php if ($content) : ?>
                    <div class="wow fadeInUp" data-wow-duration="1s">
                        <?php echo custom_editor($content, 'cta__content'); ?>
                    </div>
                <?php endif; ?>
                <?php if ($button_cta) : ?>
                    <div class="cta__btnWrap">
                        <?php
                        foreach ($button_cta as $button) :
                            echo custom_btn_link($button['link'], 'btnCTA');
                        endforeach;
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
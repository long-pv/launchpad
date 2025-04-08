<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$button_list = $args['flexible']['block_content']['list'] ?? [];
?>

<div class="buttonCta">
    <div class="container">
        <?php echo block_info($block_info); ?>

        <?php if ($button_list): ?>
            <div class="row justify-content-center buttonCta__gutters">
                <?php
                $count = 0;
                $html = '';

                foreach ($button_list as $button):
                    if ($button['link']):
                        $html .= '<div class="CheckCount wow fadeInUp" data-wow-duration="1s">' . custom_btn_link($button['link'], 'btnCTA') . '</div>';
                        $count++;
                    endif;
                endforeach;

                $colClass = 'col-md-6 ';
                $colClass .= $count == 3 ? 'col-lg-4' : ($count == 4 ? 'col-lg-3' : '');
                echo str_replace('CheckCount', $colClass, $html);
                ?>
            </div>
        <?php endif; ?>
    </div>
</div>
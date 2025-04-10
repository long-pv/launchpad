<?php
$data = $args['flexible'];
$tab_items = $data['tab_item'];
?>

<?php if (!empty($tab_items)): ?>
    <nav>
        <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
            <?php foreach ($tab_items as $index => $item):
                $is_active = $index === 0 ? 'active' : '';
                $tab_id = 'tab-' . $index;
                ?>
                <button class="nav-link <?php echo $is_active; ?>" id="<?php echo $tab_id; ?>-tab" data-bs-toggle="tab"
                    data-bs-target="#<?php echo $tab_id; ?>" type="button" role="tab" aria-controls="<?php echo $tab_id; ?>"
                    aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>">
                    <?php echo esc_html($item['tab_link']); ?>
                </button>
            <?php endforeach; ?>
        </div>
    </nav>

    <div class="tab-content p-3" id="nav-tabContent">
        <?php foreach ($tab_items as $index => $item):
            $is_active = $index === 0 ? 'show active' : '';
            $tab_id = 'tab-' . $index;
            ?>
            <div class="tab-pane fade <?php echo $is_active; ?>" id="<?php echo $tab_id; ?>" role="tabpanel"
                aria-labelledby="<?php echo $tab_id; ?>-tab">
                <?php if (!empty($item['tab_title'])): ?>
                    <h3 class="tab-content__title"><?php echo $item['tab_title']; ?></h3>
                <?php endif; ?>

                <?php if (!empty($item['tab_content'])): ?>
                    <p><?php echo wp_kses_post($item['tab_content']); ?></p>
                <?php else: ?>
                    <p><em>No content available for this tab.</em></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
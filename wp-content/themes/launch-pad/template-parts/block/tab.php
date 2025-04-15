<?php
$data = $args['flexible'];
$tab_items = $data['tab_item'];
?>

<?php if (!empty($tab_items)): ?>
    <nav class="block_tab">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <?php foreach ($tab_items as $index => $item):
                $is_active = $index === 0 ? 'active' : '';
                $tab_id = 'tab-' . $index;
                ?>
                <button class="nav-link <?php echo $is_active; ?>" id="<?php echo $tab_id; ?>-tab" data-bs-toggle="tab"
                    data-bs-target="#<?php echo $tab_id; ?>" type="button" role="tab" aria-controls="<?php echo $tab_id; ?>"
                    aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>">
                    <?php echo $item['tab_title']; ?>
                </button>
            <?php endforeach; ?>
        </div>
    </nav>

    <div class="tab-content block_tab_content" id="nav-tabContent">
        <?php foreach ($tab_items as $index => $item):
            $is_active = $index === 0 ? 'show active' : '';
            $tab_id = 'tab-' . $index;
            ?>
            <div class="tab-pane fade <?php echo $is_active; ?>" id="<?php echo $tab_id; ?>" role="tabpanel"
                aria-labelledby="<?php echo $tab_id; ?>-tab">
                <?php if (!empty($item['tab_content'])): ?>
                    <div class="tab_content">
                        <div class="editor">
                            <?php echo $item['tab_content']; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
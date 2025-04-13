<?php
$data = $args['flexible'];
$accordion_item = $data['accordion_item'];
$description = $data['description'] ?? [];
$accordion_index = 0;
?>
<div class="accordion" id="accordionExample">
    <div class="editor mb-3">
        <?php echo $description; ?>
    </div>
    <?php foreach ($accordion_item as $item):
        $header = $item['accordion_header'] ?? '';
        $content = $item['accordion_content'] ?? '';
        $is_first = ($accordion_index === 0);
        $collapse_id = 'collapse' . $accordion_index;
        $heading_id = 'heading' . $accordion_index;
        ?>
        <div class="accordion-item">
            <h2 class="accordion-header" id="<?php echo esc_attr($heading_id); ?>">
                <button class="accordion-button <?php echo $is_first ? '' : 'collapsed'; ?>" type="button"
                    data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr($collapse_id); ?>"
                    aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>"
                    aria-controls="<?php echo esc_attr($collapse_id); ?>">
                    <?php echo esc_html($header); ?>
                </button>
            </h2>
            <div id="<?php echo esc_attr($collapse_id); ?>"
                class="accordion-collapse collapse <?php echo $is_first ? 'show' : ''; ?>"
                aria-labelledby="<?php echo esc_attr($heading_id); ?>" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php echo wp_kses_post($content); ?>
                </div>
            </div>
        </div>
        <?php $accordion_index++;
    endforeach; ?>
</div>
<?php
$data = $args['flexible'];
$gallery = $data['gallery'];
?>

<?php
if (!empty($gallery)): ?>
    <div class="row gallery__row">
        <?php foreach ($gallery as $image): ?>
            <div class="col-lg-6 gallery__item">
                <div class="gallery__image-wrapper">
                    <img src="<?php echo esc_url($image['sizes']['medium_large']); ?>"
                        alt="<?php echo esc_attr($image['alt']); ?>" class="gallery__image">
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
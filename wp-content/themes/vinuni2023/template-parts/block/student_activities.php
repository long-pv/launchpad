<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$background = $args['flexible']['block_content']['background'] ?? [];
$background_image = $args['flexible']['block_content']['background_image'] ?? [];
$display_type = $args['flexible']['block_content']['display_type'] ?? [];
$list = $args['flexible']['block_content']['list'] ?? [];
$count = 0;
$style_bg = '';

if ($background == 'yes' && $background_image) {
    $style_bg = 'background: linear-gradient(0deg, rgba(26, 64, 121, 0.60) 0%, rgba(26, 64, 121, 0.60) 100%), url(' . $background_image . ') 50% / cover no-repeat; var(--primary)';
}

// Check if the function displayGallery doesn't exist before declaring it
if (!function_exists('displayGallery')) {
    function displayGallery($item_key, $item) {
        $gallery = '<div data-index="' . $item_key . '" class="studentActivity__galleryList studentActivity__galleryList--' . $item_key . '">';

        if (count($item) > 0) {
            foreach ($item as $key => $gallery_item):
                $gallery .= '<a data-fancybox="gallery-' . $item_key . '" href="' . $gallery_item . '">';
                $gallery .= '<img src="' . $gallery_item . '" alt="gallery-' . $item_key . '-' . $key . '" />';
                $gallery .= '</a>';
            endforeach;
        }

        $gallery .= '</div>';

        return $gallery;
    }
}
?>
<div class="studentActivity">
    <div class="studentActivity__inner <?php echo $background == 'yes' ? 'section--bg space' : ''; ?>"
        style="<?php echo $style_bg; ?>">
        <div class="container">
            <?php echo block_info($block_info); ?>
        </div>

        <?php if ($list): ?>
            <div class="studentActivity__list">
                <div class="studentActivity__slider">
                    <?php
                    $countArr = custom_count_array($list, ['image']);
                    $single_opened = false;
                    $activity_gallery = '';

                    foreach ($list as $key_item => $item):
                        $class_image_first = ($count % 5 == 0 && $countArr > 0) ? 'studentActivity__imgGroup--first' : '';
                        $check_hover_cursor = ($display_type == 'image' || $display_type == 'gallery' && $item['gallery']) ? 'cursor-pointer' : 'cursor-default';
                        $data_index = ($display_type == 'gallery' && $item['gallery']) ? 'data-index="' . $key_item . '"' : '';
                        $class_item_bg = ($display_type == 'image' && $item['title']) ? ('studentActivity__itemContent--bg') : '';

                        if ($item['image']):
                            if ($count % 5 == 0):
                                if ($single_opened): ?>
                                    </div>
                                <?php endif; ?>
                                <div class="studentActivity__bgImage studentActivity__bgImage--single">
                                    <?php $single_opened = true; ?>
                            <?php elseif ($count % 5 == 1):
                                if ($single_opened): ?>
                                    </div>
                                <?php endif; ?>
                                <div class="studentActivity__bgImage studentActivity__bgImage--many">
                                    <?php $single_opened = false; ?>
                            <?php endif; ?>

                            <div class="studentActivity__item" <?php echo $data_index; ?>>
                                <div class="imgGroup imgGroup--noEffect studentActivity__imgGroup <?php echo $count % 5 == 0 ? 'h-100' : ''; ?>">
                                    <img class="<?php echo $check_hover_cursor; ?>"
                                        src="<?php echo $item['image']; ?>" alt="<?php echo 'Image-' . ($key_item + 1); ?>">
                                    <?php if ($display_type == 'image' && $item['title']): ?>
                                        <div class="studentActivity__itemContent <?php echo $class_item_bg . ' ' . $check_hover_cursor; ?> ">
                                            <h3 class="h5 studentActivity__title wow fadeInUp" data-wow-duration="1s">
                                                <?php echo $item['title']; ?>
                                            </h3>
                                        </div>
                                    <?php endif ?>
                                    <?php
                                        if ($display_type == 'gallery' && $item['gallery']):
                                            $activity_gallery .= displayGallery($key_item, $item['gallery']);
                                        endif;
                                    ?>
                                </div>
                            </div>

                            <?php if ($count % 5 == 4): ?>
                                </div>
                            <?php endif; ?>

                    <?php
                            $count++;
                        endif;
                    endforeach;

                    if ($single_opened): ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php
            if ($display_type == 'gallery' && $activity_gallery) {
                echo $activity_gallery;
            }
        endif;
        ?>
    </div>
</div>
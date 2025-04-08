<?php
$block_content = $args['flexible']['block_content'] ?? [];
$label = $block_content['label'] ?? '';
$featured_image = $block_content['featured_image'] ?? '';
$type_video = $block_content['type_video'] ?? '';
$upload_video = $block_content['upload_video'] ?? '';
$iframe_video = $block_content['iframe_video'] ?? '';
$valid_video_condition = $type_video == 'upload' && $upload_video;
$valid_iframe_condition = $type_video == 'iframe' && $iframe_video;
$background_image = $featured_image ? 'style="background-image: url(' . $featured_image . ');"' : '';
?>
<?php if ($featured_image): ?>
    <div class="videoBlock">
        <div class="videoBlock__videoWrap" <?php echo $background_image; ?>>
            <div class="videoBlock__overlay"></div>

            <div class="container">
                <div class="videoBlock__videoAction">
                    <?php if ($valid_video_condition || $valid_iframe_condition): ?>
                        <button class="videoBlock__playAction" data-toggle="modal" data-src="<?php echo $valid_video_condition ? $upload_video : $iframe_video; ?>" data-target="#videoUrl">
                            <img class="videoBlock__playButton" src="<?php echo get_template_directory_uri(); ?>/assets/images/home/video-play.png" alt="Video play">
                        </button>
                    <?php endif; ?>

                    <?php if ($label): ?>
                        <h2 class="h4 videoBlock__title">
                            <?php echo $label; ?>
                        </h2>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php if ($valid_video_condition || $valid_iframe_condition): ?>
        <div class="modal modal-video fade" id="videoUrl" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="close videoBlock__btnClose" data-dismiss="modal" aria-label="Close">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 18L18 6" stroke="#333333" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M18 18L6 6" stroke="#333333" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>

                    <div class="modal-body p-0">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always" allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php endif; ?>

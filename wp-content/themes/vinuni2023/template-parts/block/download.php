<?php
$block_info = $args['flexible']['block_info'] ?? [];
$downloads = $args['flexible']['block_content']['downloads'] ?? [];
$colClassDownload = (count($downloads) <= 2) ? 'col-md-6' : 'col-md-6 col-lg-4';
if($downloads):
?>
<div class="secDownload">
    <div class="container">
        <div class="row">
            <?php foreach ($downloads as $item) :
                $file = $item['file'];
                if ($file) :
            ?>
                    <div class="<?php echo $colClassDownload; ?>">
                        <div class="secDownload__item wow fadeInUp" data-wow-duration="1s">
                            <div class="secDownload__icon"></div>
                            <div class="secDownload__wrap">
                                <h3 class="secDownload__title"><?php echo $item['title'] ?: __('Download', 'clvinuni'); ?></h3>
                                <a href="<?php echo $file['url'] ?>" class="secDownload__link" download><?php echo $file['filename']; ?></a>
                            </div>
                        </div>
                    </div>
            <?php endif;
            endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>
<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$block_content = $args['flexible']['block_content'] ?? [];
$featured_image = $block_content['featured_image'] ?: '';
$list_collaborators = $block_content['list'] ?: '';
?>

<?php if ($featured_image && $list_collaborators): ?>
<div class="collaborators">
    <div class="container">
        <div class="collaborators__inner">
            <?php echo block_info($block_info); ?>
            <div class="collaborators__imgFeatured">
                <img src="<?php echo $featured_image; ?>" alt="Featured image">
            </div>
            <div class="collaborators__list">
                <?php
                foreach ($list_collaborators as $key => $collaborator):
                    $class_item = 'collaborators__item--';
                    $class_item .= ($key == 0) ? 'left' : 'right';
                ?>
                    <div class="collaborators__item <?php echo $class_item; ?>">
                        <div class="collaborators__itemImg">
                            <div class="collaborators__itemImgInner">
                                <?php if ($collaborator['logo']): ?>
                                    <img src="<?php echo $collaborator['logo']; ?>" alt="collaborators" class="wow fadeInUp" data-wow-duration="1s">
                                <?php endif; ?>
                            </div>
                        </div>

                        <ul class="collaborators__itemList">
                            <?php
                            if ($collaborator['link_list']):
                                foreach ($collaborator['link_list'] as $key_link => $link):
                                // Get values
                                $target_link = ($link && $link['link']['target']) ? $link['link']['target'] : '';
                            ?>
                            <?php if ($link && $link['link']['url'] && $link['link']['title']): ?>
                            <li class="collaborators__itemChild collaborators__itemChild--<?php echo $key_link; ?> wow fadeInUp" data-wow-duration="1s">
                                <a class="collaborators__itemLink"
                                    href="<?php echo $link['link']['url']; ?>"
                                    target="<?php echo $target_link; ?>">
                                    <?php echo $link['link']['title']; ?>
                                </a>
                            </li>
                            <?php endif; ?>

                            <?php
                            endforeach;
                            endif;
                            ?>
                        </ul>

                        <img class="collaborators__layerLeft" src="<?php echo get_template_directory_uri(); ?>/assets/images/layer_2.png" alt="">
			            <img class="collaborators__layerRight" src="<?php echo get_template_directory_uri(); ?>/assets/images/layer_3.png" alt="">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$list = $args['flexible']['block_content']['list'] ?? '';
?>
<div class="strategicCollaborators">
    <div class="container">
        <?php echo block_info($block_info); ?>
    </div>

    <?php if ($list): ?>
        <div class="strategicCollaborators__inner">
            <div class="strategicCollaborators__relative">
                <div class="container">
                    <div class="row strategicCollaborators__list">
                        <?php
                        foreach($list as $collaborator):
                            $bg_img = $collaborator['background_image'] ?? '';
                            $logo_img = $collaborator['logo_image'] ?? '';
                            $content = $collaborator['content'] ?? '';
                        ?>
                            <div class="col-lg-6">
                                <div class="strategicCollaborators__item">
                                    <?php if ($bg_img): ?>
                                        <div class="strategicCollaborators__bgImgInner">
                                            <img src="<?php echo $bg_img; ?>" alt="Background Strategic Collaborators">
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($logo_img || $content): ?>
                                    <div class="strategicCollaborators__contentInner <?php echo $bg_img ? 'strategicCollaborators__contentInner--top' : '' ?>">
                                        <a class="strategicCollaborators__imgInner" data-mh="strategicCollaborators__imgInner">
                                            <img alt="Logo Strategic Collaborators" src="<?php echo esc_url($logo_img); ?>" />
                                        </a>
                                        <div class="strategicCollaborators__content" data-mh="strategicCollaborators__content">
                                            <div class="editor">
                                                <?php echo $content; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- <hr> -->
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php
$program_group = $args['program_group'] ?? [];
$display_featured_image = $program_group['display_featured_image'] ?? '';
$featured_image = $program_group['featured_image'] ?? '';
$programs_list = $program_group['list'] ?? '';
$class_col_list = ($display_featured_image == 'yes') ? 'col-lg-6' : 'col-12';
$class_col_item = ($display_featured_image == 'yes') ? 'col-12' : 'col-lg-6';
?>
<div class="row">
    <?php if ($display_featured_image == 'yes' && $featured_image) : ?>
        <div class="col-lg-6">
            <div class="programs__featuredImage">
                <img width="300" height="300" class="w-100 h-100" src="<?php echo $featured_image; ?>" alt="Featured Image">
            </div>
        </div>
    <?php
    endif;
    if ($programs_list) :
    ?>
        <div class="<?php echo $class_col_list; ?>">
            <div class="row">
                <?php
                foreach ($programs_list as $program) :
                    if ($program['link'] && $program['link']['title'] && $program['link']['url']) :
                ?>
                        <div class="<?php echo $class_col_item; ?>">
                            <a class="programs__link" href="<?php echo $program['link']['url']; ?>" style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.30) 0%, rgba(0, 0, 0, 0.30) 100%), url(<?php echo $program['background_image']; ?>) center/cover no-repeat, lightgray 50%;" target="<?php echo $program['link']['target']; ?>">
                                <span class="programs__title">
                                    <?php echo $program['link']['title']; ?>
                                </span>
                            </a>
                        </div>
                <?php
                    endif;
                endforeach;
                ?>
            </div>
        </div>
    <?php endif; ?>
</div>